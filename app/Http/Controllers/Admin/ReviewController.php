<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReview;
use Inertia\Inertia;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = ProductReview::with('product')->latest()->paginate(15);
        return Inertia::render('Admin/Reviews/Index', [
            'reviews' => $reviews
        ]);
    }

    public function update(Request $request, ProductReview $review)
    {
        $validated = $request->validate([
            'is_approved' => 'required|boolean'
        ]);

        $review->update($validated);

        return redirect()->back()->with('message', 'Đã cập nhật trạng thái đánh giá');
    }

    public function destroy(ProductReview $review)
    {
        $review->delete();
        return redirect()->back()->with('message', 'Đã xóa đánh giá');
    }
}
