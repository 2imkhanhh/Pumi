<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::orderBy('id', 'desc')->paginate(15);
        return Inertia::render('Admin/Partners/Index', [
            'partners' => $partners
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = $request->only(['name', 'link']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/partners'), $filename);
            $data['image'] = 'uploads/partners/' . $filename;
        }

        Partner::create($data);

        return redirect()->back()->with('success', 'Thêm đối tác thành công!');
    }

    public function update(Request $request, Partner $partner)
    {
        $request->validate([
            'name' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $data = $request->only(['name', 'link']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/partners'), $filename);
            $data['image'] = 'uploads/partners/' . $filename;

            // Xóa ảnh cũ
            if ($partner->image && file_exists(public_path($partner->image))) {
                unlink(public_path($partner->image));
            }
        }

        $partner->update($data);

        return redirect()->back()->with('success', 'Cập nhật đối tác thành công!');
    }

    public function destroy(Partner $partner)
    {
        // Xóa ảnh
        if ($partner->image && file_exists(public_path($partner->image))) {
            unlink(public_path($partner->image));
        }
        $partner->delete();

        return redirect()->back()->with('success', 'Xóa đối tác thành công!');
    }
}
