<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Post;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->where('is_featured', true)->latest()->get();
        if ($products->isEmpty()) {
            $products = Product::where('is_active', true)->latest()->limit(4)->get();
        }
        
        $homePartnersJson = Setting::where('key', 'home_partners')->value('value');
        $partners = $homePartnersJson ? json_decode($homePartnersJson, true) : [];

        $posts = Post::where('type', 'news')->latest('published_at')->limit(4)->get();

        return view('client.pages.home', compact('products', 'partners', 'posts'));
    }

    public function about()
    {
        return view('client.pages.about');
    }

    public function partners()
    {
        $hospitalPartnersJson = Setting::where('key', 'hospital_partners')->value('value');
        $hospitalPartners = $hospitalPartnersJson ? json_decode($hospitalPartnersJson, true) : [];

        $mediaPartnersJson = Setting::where('key', 'media_partners')->value('value');
        $mediaPartners = $mediaPartnersJson ? json_decode($mediaPartnersJson, true) : [];

        $ingredientPartnersJson = Setting::where('key', 'ingredient_partners')->value('value');
        $ingredientPartners = $ingredientPartnersJson ? json_decode($ingredientPartnersJson, true) : [];
        
        return view('client.pages.partners', compact('hospitalPartners', 'mediaPartners', 'ingredientPartners'));
    }

    public function products()
    {
        $products = \App\Models\Product::orderBy('id', 'asc')->paginate(12);
        return view('client.pages.products', compact('products'));
    }

    public function posts(\Illuminate\Http\Request $request)
    {
        $query = \App\Models\Post::with('category')->where('type', 'news');
        
        if ($request->has('category')) {
            $categorySlug = $request->query('category');
            $query->whereHas('category', function($q) use ($categorySlug) {
                $q->where('slug', $categorySlug);
            });
        }
        
        $posts = $query->latest('published_at')->paginate(12);
        $categories = \App\Models\PostCategory::where('is_active', true)->orderBy('name', 'asc')->get();
        
        return view('client.pages.posts', compact('posts', 'categories'));
    }

    public function recruitment()
    {
        $recruitments = \App\Models\Post::where('type', 'recruitment')->latest('published_at')->paginate(12);
        return view('client.pages.recruitment', compact('recruitments'));
    }

    public function recruitmentDetail($slug)
    {
        $post = \App\Models\Post::where('slug', $slug)->where('type', 'recruitment')->firstOrFail();
        $relatedPosts = \App\Models\Post::where('type', 'recruitment')->where('id', '!=', $post->id)->latest('published_at')->limit(5)->get();
        return view('client.pages.recruitment_detail', compact('post', 'relatedPosts'));
    }

    public function contact()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return view('client.pages.contact', compact('settings'));
    }

    public function submitContact(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'content' => 'required|string|max:1000'
        ]);

        \App\Models\Contact::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'content' => $request->content,
            'status' => 'pending'
        ]);

        if ($request->ajax()) {
            return response()->json(['type' => 'success', 'message' => 'Cảm ơn bạn đã liên hệ, chúng tôi sẽ phản hồi sớm nhất!']);
        }

        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ, chúng tôi sẽ phản hồi sớm nhất!');
    }

    public function productDetail($slug)
    {
        $product = \App\Models\Product::where('slug', $slug)->firstOrFail();
        $reviews = \App\Models\ProductReview::where('product_id', $product->id)
                                            ->where('is_approved', true)
                                            ->latest()
                                            ->get();
        $relatedProducts = \App\Models\Product::where('id', '!=', $product->id)
                                              ->latest()
                                              ->limit(10)
                                              ->get();
        return view('client.pages.product_detail', compact('product', 'reviews', 'relatedProducts'));
    }

    public function postDetail($slug)
    {
        $post = \App\Models\Post::with('category')->where('slug', $slug)->where('type', 'news')->firstOrFail();
        $query = \App\Models\Post::where('type', 'news')->where('id', '!=', $post->id);
        if ($post->category_id) {
            $query->where('category_id', $post->category_id);
        }
        $relatedPosts = $query->latest('published_at')->limit(4)->get();
        return view('client.pages.post_detail', compact('post', 'relatedPosts'));
    }

    public function search(\Illuminate\Http\Request $request)
    {
        $products = \App\Models\Product::get()->map(function($p) {
            return [
                'name' => $p->name,
                'cat' => 'Sản phẩm Pumi',
                'href' => route('product.detail', $p->slug),
                'img' => asset($p->image),
                'desc' => $p->short_description
            ];
        });
        return view('client.pages.search', compact('products'));
    }

    public function storeReview(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'note' => 'required|string|max:1000'
        ]);

        \App\Models\ProductReview::create([
            'product_id' => $request->product_id,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'rating' => $request->rating,
            'note' => $request->note,
            'is_approved' => false
        ]);

        if ($request->ajax()) {
            return response()->json(['type' => 'success', 'message' => 'Cảm ơn bạn đã đánh giá. Đánh giá của bạn đang chờ kiểm duyệt.']);
        }

        return redirect()->back()->with('success', 'Cảm ơn bạn đã đánh giá. Đánh giá của bạn đang chờ kiểm duyệt.');
    }
}
