<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PostCategory;
use Inertia\Inertia;
use Illuminate\Support\Str;

class PostCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        
        $query = PostCategory::query();
        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }
        
        $categories = $query->orderBy('name', 'asc')->paginate(10)->withQueryString();
        
        return Inertia::render('Admin/PostCategories/Index', [
            'categories' => $categories,
            'filters' => ['search' => $search]
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:post_categories,slug',
            'is_active' => 'boolean',
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['name']);
        }
        
        if (!isset($validated['is_active'])) {
            $validated['is_active'] = true;
        }

        PostCategory::create($validated);

        return redirect()->back()->with('message', 'Đã thêm danh mục thành công');
    }

    public function update(Request $request, PostCategory $post_category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:post_categories,slug,' . $post_category->id,
            'is_active' => 'boolean',
        ]);

        $post_category->update($validated);

        return redirect()->back()->with('message', 'Cập nhật danh mục thành công');
    }

    public function destroy(PostCategory $post_category)
    {
        $post_category->delete();
        return redirect()->back()->with('message', 'Đã xóa danh mục');
    }
}
