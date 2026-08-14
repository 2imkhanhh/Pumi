<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Partner;
use App\Models\Post;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Settings
        $settings = [
            ['key' => 'logo', 'value' => 'assets/images/upload/banner/img_68da82f29e290.png', 'type' => 'image'],
            ['key' => 'footer_logo', 'value' => 'assets/images/blogo.png', 'type' => 'image'],
            ['key' => 'company_name', 'value' => 'PUMI VIỆT NAM - TỰ HÀO TINH HOA THẢO MỘC VIỆT', 'type' => 'text'],
            ['key' => 'address', 'value' => '309a Lê Duẩn, Tổ 1, Phường Chiềng Sinh, Thành phố Sơn La.', 'type' => 'text'],
            ['key' => 'phone', 'value' => '0986.127.635', 'type' => 'text'],
            ['key' => 'email', 'value' => 'congtycophanpumivietnam@gmail.com', 'type' => 'text'],
            ['key' => 'website', 'value' => 'www.pumi.vn', 'type' => 'text'],
            ['key' => 'home_video', 'value' => 'https://drive.google.com/file/d/1ygio8NpLpmg3oKUo3ct_8PebKu096Y-m/preview?autoplay=1&mute=1', 'type' => 'text'],
            ['key' => 'home_about_title', 'value' => 'PUMI VIỆT NAM', 'type' => 'text'],
            ['key' => 'home_about_subtitle', 'value' => 'TỰ HÀO TINH HOA THẢO MỘC VIỆT', 'type' => 'text'],
            ['key' => 'home_about_content', 'value' => 'Mang trong mình sứ mệnh tạo ra những sản phẩm chất lượng từ những nguồn nguyên liệu dược liệu quý của Việt Nam.<br>Cam kết sự phát triển nông nghiệp dược liệu bền vững đối với người nông dân địa phương.', 'type' => 'longtext'],
            ['key' => 'home_middle_banner', 'value' => 'assets/images/upload/banner/img_68da94b145c2f.png', 'type' => 'image'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(['key' => $setting['key']], $setting);
        }

        // Categories
        $catProduct = Category::create(['name' => 'Sản phẩm Pumi', 'slug' => Str::slug('Sản phẩm Pumi'), 'type' => 'product']);
        $catNews = Category::create(['name' => 'Tin tức', 'slug' => Str::slug('Tin tức'), 'type' => 'post']);

        // Products
        Product::create([
            'category_id' => $catProduct->id,
            'name' => 'Nước tắm thảo dược',
            'slug' => Str::slug('Nước tắm thảo dược'),
            'image' => 'assets/images/upload/product/img_68da996a88715.png',
            'short_description' => 'Hương mùa xuân & Vương Quốc Hạnh Phúc',
            'description' => 'Chiết xuất từ thảo dược thiên nhiên lành tính, dịu nhẹ cho làn da nhạy cảm của bé, hỗ trợ ngừa rôm sảy, mẩn ngứa và mang lại giấc ngủ ngon mỗi ngày.',
            'price' => null
        ]);

        Product::create([
            'category_id' => $catProduct->id,
            'name' => 'Dung dịch vệ sinh cho bé',
            'slug' => Str::slug('Dung dịch vệ sinh cho bé'),
            'image' => 'assets/images/upload/product/img_68ddda7c9a06e.png',
            'short_description' => 'Hương mùa xuân & Vương Quốc Hạnh Phúc',
            'description' => 'Độ pH dịu nhẹ, chiết xuất thảo mộc lành tính giúp làm sạch nhẹ nhàng vùng kín của bé, hỗ trợ phòng ngừa hăm, ngứa và viêm nhiễm thường gặp.',
            'price' => null
        ]);

        // Partners
        Partner::create(['image' => 'assets/images/upload/adv/thumbs/img_68dcb504c261e.png']);
        Partner::create(['image' => 'assets/images/upload/adv/thumbs/img_68dcb50c43d27.png']);
        Partner::create(['image' => 'assets/images/upload/adv/thumbs/img_68dcb513f333e.png']);
        Partner::create(['image' => 'assets/images/upload/adv/thumbs/img_68dcb51adde95.png']);
        Partner::create(['image' => 'assets/images/upload/adv/thumbs/img_68dcb5228fd91.png']);

        // Posts
        Post::create([
            'category_id' => $catNews->id,
            'title' => '3 lý do mẹ Việt tin chọn sản phẩm thảo mộc thuần Việt cho con',
            'slug' => Str::slug('3 lý do mẹ Việt tin chọn sản phẩm thảo mộc thuần Việt cho con'),
            'image' => 'assets/images/upload/post/thumbs/img_68da9a546ef34.jpg',
            'excerpt' => 'Ngày càng nhiều gia đình Việt ưu tiên sản phẩm nội địa từ dược liệu quê hương cho con nhỏ...',
            'published_at' => now(),
        ]);

        Post::create([
            'category_id' => $catNews->id,
            'title' => 'Chăm sóc da bé bị hăm tã, rôm sảy bằng nguyên liệu thảo mộc',
            'slug' => Str::slug('Chăm sóc da bé bị hăm tã, rôm sảy bằng nguyên liệu thảo mộc'),
            'image' => 'assets/images/upload/post/thumbs/img_68da9a546ef34.jpg',
            'excerpt' => 'Hăm tã và rôm sảy là nỗi ám ảnh của nhiều mẹ bỉm sữa, thảo mộc thiên nhiên có thể là giải pháp dịu nhẹ...',
            'published_at' => now(),
        ]);
        
        Post::create([
            'category_id' => $catNews->id,
            'title' => 'Hướng dẫn tắm cho trẻ sơ sinh đúng cách tại nhà',
            'slug' => Str::slug('Hướng dẫn tắm cho trẻ sơ sinh đúng cách tại nhà'),
            'image' => 'assets/images/upload/post/thumbs/img_68da9a546ef34.jpg',
            'excerpt' => 'Tắm cho trẻ sơ sinh tưởng đơn giản nhưng cần đúng trình tự để bé an toàn và thoải mái nhất...',
            'published_at' => now(),
        ]);
        
        Post::create([
            'category_id' => $catNews->id,
            'title' => 'Sự khác biệt giữa mỹ phẩm thảo dược và hóa mỹ phẩm thông thường cho bé',
            'slug' => Str::slug('Sự khác biệt giữa mỹ phẩm thảo dược và hóa mỹ phẩm thông thường cho bé'),
            'image' => 'assets/images/upload/post/thumbs/img_68da9a546ef34.jpg',
            'excerpt' => 'Không phải cứ có chữ \'thảo dược\' trên bao bì là an toàn tuyệt đối, mẹ cần hiểu rõ sự khác biệt...',
            'published_at' => now(),
        ]);
    }
}
