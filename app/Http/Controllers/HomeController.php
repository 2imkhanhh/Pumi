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
        $products = Product::limit(4)->get();
        $partners = Partner::limit(10)->get();
        $posts = Post::latest('published_at')->limit(4)->get();

        return view('client.pages.home', compact('products', 'partners', 'posts'));
    }

    public function about()
    {
        return view('client.pages.about');
    }

    public function partners()
    {
        return view('client.pages.partners');
    }

    public function products()
    {
        $products = \App\Models\Product::orderBy('id', 'asc')->paginate(12);
        return view('client.pages.products', compact('products'));
    }

    public function posts()
    {
        $posts = \App\Models\Post::latest('published_at')->paginate(12);
        return view('client.pages.posts', compact('posts'));
    }

    public function recruitment()
    {
        return view('client.pages.recruitment');
    }

    public function contact()
    {
        return view('client.pages.contact');
    }

    public function productDetail($slug)
    {
        $product = \App\Models\Product::where('slug', $slug)->firstOrFail();
        return view('client.pages.product_detail', compact('product'));
    }

    public function postDetail($slug)
    {
        $post = \App\Models\Post::where('slug', $slug)->firstOrFail();
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
