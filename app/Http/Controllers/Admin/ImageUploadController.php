<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:5120', // Giới hạn 5MB
        ]);

        if ($request->hasFile('image')) {
            // Lưu ảnh vào thư mục posts/content
            $path = $request->file('image')->store('posts/content', 'public');
            
            // Trả về URL của ảnh
            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['error' => 'No image uploaded'], 400);
    }
}
