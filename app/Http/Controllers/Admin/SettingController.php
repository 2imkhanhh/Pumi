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

        if (isset($data['home_banners'])) {
            $homeBanners = [];
            foreach ($data['home_banners'] as $banner) {
                $bannerData = ['link' => $banner['link'] ?? '#'];
                
                if (isset($banner['image']) && $banner['image'] instanceof \Illuminate\Http\UploadedFile) {
                    $file = $banner['image'];
                    $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/settings'), $filename);
                    $bannerData['img'] = 'uploads/settings/' . $filename;
                } elseif (isset($banner['old_image'])) {
                    $bannerData['img'] = $banner['old_image'];
                }

                if (isset($bannerData['img'])) {
                    $homeBanners[] = $bannerData;
                }
            }
            
            Setting::updateOrCreate(['key' => 'home_banners'], ['value' => json_encode($homeBanners), 'type' => 'json']);
            unset($data['home_banners']);
        }

        $jsonFields = ['home_partners', 'ingredient_partners', 'hospital_partners', 'media_partners', 'contact_stores'];
        foreach ($jsonFields as $field) {
            if (isset($data[$field])) {
                $items = [];
                foreach ($data[$field] as $item) {
                    $itemData = [];
                    if (isset($item['name'])) $itemData['name'] = $item['name'];
                    if (isset($item['description'])) $itemData['description'] = $item['description'];
                    if (isset($item['address'])) $itemData['address'] = $item['address'];
                    if (isset($item['phone'])) $itemData['phone'] = $item['phone'];

                    if (isset($item['image']) && $item['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $file = $item['image'];
                        $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path('uploads/settings'), $filename);
                        $itemData['img'] = 'uploads/settings/' . $filename;
                    } elseif (isset($item['old_image'])) {
                        $itemData['img'] = $item['old_image'];
                    }

                    if (isset($itemData['img']) || $field === 'contact_stores') {
                        $items[] = $itemData;
                    }
                }
                Setting::updateOrCreate(['key' => $field], ['value' => json_encode($items), 'type' => 'json']);
                unset($data[$field]);
            } else if ($request->exists($field)) {
                // If it exists in request but is empty (e.g. user deleted all items)
                Setting::updateOrCreate(['key' => $field], ['value' => json_encode([]), 'type' => 'json']);
                unset($data[$field]);
            }
        }

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
