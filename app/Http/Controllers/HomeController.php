<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Partner;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->where('is_featured', true)->latest()->get();
        if ($products->isEmpty()) {
            $products = Product::where('is_active', true)->latest()->limit(4)->get();
        }
        $partners = Partner::limit(10)->get();
        $posts = Post::where('type', 'news')->latest('published_at')->limit(4)->get();

        return view('client.pages.home', compact('products', 'partners', 'posts'));
    }

    public function about()
    {
        return view('client.pages.about');
    }

    public function partners()
    {
        $partners = Partner::all();
        return view('client.pages.partners', compact('partners'));
    }

    public function products()
    {
        $products = \App\Models\Product::orderBy('id', 'asc')->paginate(12);
        return view('client.pages.products', compact('products'));
    }

    public function posts()
    {
        $posts = \App\Models\Post::where('type', 'news')->latest('published_at')->paginate(12);
        return view('client.pages.posts', compact('posts'));
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
        return view('client.pages.contact');
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

        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ, chúng tôi sẽ phản hồi sớm nhất!');
    }

    public function productDetail($slug)
    {
        $product = \App\Models\Product::where('slug', $slug)->firstOrFail();
        $relatedProducts = \App\Models\Product::where('id', '!=', $product->id)
                                              ->where('id', '!=', $product->id)
                                              ->latest()
                                              ->limit(10)
                                              ->get();
        return view('client.pages.product_detail', compact('product', 'relatedProducts'));
    }

    public function postDetail($slug)
    {
        $post = \App\Models\Post::where('slug', $slug)->where('type', 'news')->firstOrFail();
        return view('client.pages.post_detail', compact('post'));
    }

    public function search(\Illuminate\Http\Request $request)
    {
        $products = \App\Models\Product::with('category')->get()->map(function($p) {
            return [
                'name' => $p->name,
                'cat' => $p->category ? $p->category->name : 'Khác',
                'href' => route('product.detail', $p->slug),
                'img' => asset($p->image),
                'desc' => $p->short_description
            ];
        });
        return view('client.pages.search', compact('products'));
    }
}
