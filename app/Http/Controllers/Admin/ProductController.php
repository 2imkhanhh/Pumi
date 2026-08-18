<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $products = $query->orderBy('id', 'asc')->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/Products/Index', [
            'products' => $products,
            'filters' => $request->only(['search'])
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
            'featured_image' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'use_1' => 'nullable|string',
            'use_2' => 'nullable|string',
            'use_3' => 'nullable|string',
            'usage_guide' => 'nullable|string',
            'notice' => 'nullable|string',
            'preservation' => 'nullable|string',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $gallery = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('products', 'public');
                $gallery[] = 'storage/' . $path;
            }
        }
        $validated['gallery'] = $gallery;
        $validated['image'] = $request->input('featured_image', $gallery[0] ?? null);

        unset($validated['images']);
        unset($validated['featured_image']);

        Product::create($validated);

        return redirect()->back()->with('message', 'Đã thêm sản phẩm thành công');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $product->id,
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
            'existing_gallery' => 'nullable|array',
            'featured_image' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
            'use_1' => 'nullable|string',
            'use_2' => 'nullable|string',
            'use_3' => 'nullable|string',
            'usage_guide' => 'nullable|string',
            'notice' => 'nullable|string',
            'preservation' => 'nullable|string',
        ]);

        $gallery = $request->input('existing_gallery', []);
        
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $path = $file->store('products', 'public');
                $gallery[] = 'storage/' . $path;
            }
        }
        
        $validated['gallery'] = $gallery;
        $validated['image'] = $request->input('featured_image', $gallery[0] ?? null);

        unset($validated['images']);
        unset($validated['existing_gallery']);
        unset($validated['featured_image']);

        $product->update($validated);

        return redirect()->back()->with('message', 'Cập nhật sản phẩm thành công');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('message', 'Đã xóa sản phẩm');
    }
}
