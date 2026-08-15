<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        return Inertia::render('Admin/Settings/Index', [
            'settings' => $settings
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            // Xử lý nếu là file upload (như logo, favicon)
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/settings'), $filename);
                
                $oldSetting = Setting::where('key', $key)->first();
                if ($oldSetting && $oldSetting->value && file_exists(public_path($oldSetting->value))) {
                    unlink(public_path($oldSetting->value));
                }

                Setting::updateOrCreate(['key' => $key], ['value' => 'uploads/settings/' . $filename, 'type' => 'image']);
            } elseif ($value !== null) {
                $oldSetting = Setting::where('key', $key)->first();
                $type = $oldSetting ? $oldSetting->type : 'text';
                Setting::updateOrCreate(['key' => $key], ['value' => $value, 'type' => $type]);
            }
        }

        return redirect()->back()->with('success', 'Cập nhật cấu hình thành công!');
    }
}
