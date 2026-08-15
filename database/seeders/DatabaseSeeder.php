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
            
            // Homepage Carousel Banners
            ['key' => 'home_banner_1', 'value' => 'assets/images/upload/banner/img_68dcb2fd1d474.jpg', 'type' => 'image'],
            ['key' => 'home_banner_1_link', 'value' => '#', 'type' => 'text'],
            ['key' => 'home_banner_2', 'value' => 'assets/images/upload/banner/img_68ddf4eb12021.jpg', 'type' => 'image'],
            ['key' => 'home_banner_2_link', 'value' => '#', 'type' => 'text'],
            ['key' => 'home_banner_3', 'value' => '', 'type' => 'image'],
            ['key' => 'home_banner_3_link', 'value' => '#', 'type' => 'text'],
            
            // Homepage Welcome Section
            ['key' => 'home_welcome_title', 'value' => 'Pumi Việt Nam', 'type' => 'text'],
            ['key' => 'home_welcome_subtitle', 'value' => 'Xin Chào!', 'type' => 'text'],
            ['key' => 'home_welcome_content', 'value' => 'Pumi Việt Nam thực sự vinh hạnh và trân quý bởi sự tin tưởng lựa chọn sản phẩm, dịch vụ của quý khách hàng!<br><br>Website này là toàn bộ thông tin chi tiết về Pumi, về sứ mệnh cũng như tâm huyết công hiến của đội ngũ nhân sự chúng mình. Hy vọng bạn sẽ đón nhận chúng mình một cách thoải mái và cởi mở nhất nhé!<br><br>Pumi luôn lắng nghe và cố gắng nỗ lực cải thiện mỗi ngày để đem lại sự hài lòng cho bạn!', 'type' => 'longtext'],
            
            // About Page Settings
            ['key' => 'about_banner', 'value' => 'assets/images/upload/banner/img_68dcba9ec7a66.jpg', 'type' => 'image'],
            ['key' => 'about_welcome_title', 'value' => 'Pumi Việt Nam', 'type' => 'text'],
            ['key' => 'about_welcome_subtitle', 'value' => 'Xin Chào!', 'type' => 'text'],
            ['key' => 'about_welcome_content', 'value' => 'Ra đời từ năm 2024, Pumi Việt Nam là Thương hiệu được khởi nguồn từ tình yêu thương vô điều kiện của người mẹ dành cho đứa con mới chào đời của mình. Chính từ tình yêu ấy, chúng tôi thấu hiểu sâu sắc những băn khoăn, lo lắng của các mẹ khi lựa chọn sản phẩm giữa muôn vàn thương hiệu trên thị trường. Với PUMI, mỗi sản phẩm không chỉ đơn thuần là sự kết hợp giữa các thành phần thiên nhiên lành tính và dược liệu chất lượng cao – mà còn là cam kết về sự trung thực, an toàn và đồng hành lâu dài cùng mẹ và bé.<br>Pumi Việt Nam mang trên mình sứ mệnh tạo ra những sản phẩm chất lượng từ những nguồn nguyên liệu dược liệu quý của Việt Nam.<br>Cam kết sự phát triển nông nghiệp dược liệu bền vững đối với người nông dân địa phương.', 'type' => 'longtext'],
            ['key' => 'about_welcome_image', 'value' => 'assets/images/upload/post/img_68dcbf27e5e6b.png', 'type' => 'image'],
            ['key' => 'about_story_title', 'value' => 'Câu chuyện về nguyên liệu', 'type' => 'text'],
            ['key' => 'about_story_subtitle', 'value' => 'Sức sáng tạo của người Việt', 'type' => 'text'],
            ['key' => 'about_story_content', 'value' => '<strong>“Pumi - gợi nhớ hành trình làm mẹ đầy ý nghĩa”</strong><br>Có những câu chuyện được kể bằng lời, bằng hình ảnh… Nhưng hãy để PUMI kể câu chuyện làm mẹ – một hành trình thiêng liêng và đầy cảm xúc – qua những tầng hương tinh tế. Mỗi mùi hương là một nhịp cầu kết nối không gian, thời gian, con người và những ký ức yêu thương – như một bản giao hưởng nhẹ nhàng của tình mẫu tử lan tỏa trong từng hơi thở cuộc sống.', 'type' => 'longtext'],
            ['key' => 'about_story_image', 'value' => 'assets/images/upload/post/img_68dd39cfa8028.jpg', 'type' => 'image'],
            ['key' => 'about_message_title', 'value' => 'Thông điệp thương hiệu', 'type' => 'text'],
            ['key' => 'about_message_subtitle', 'value' => 'Mùi hương ghi dấu ấn và truyền tải cảm xúc', 'type' => 'text'],
            ['key' => 'about_message_content', 'value' => 'Ngưng đánh giá mùi hương bằng thời gian mà hãy cảm nhận mùi hương đó bằng cảm xúc.', 'type' => 'longtext'],
            ['key' => 'about_message_image', 'value' => 'assets/images/upload/post/img_68dceb15e4f8a.jpg', 'type' => 'image'],
            ['key' => 'about_herb_title', 'value' => 'Ứng dụng thảo dược Việt', 'type' => 'text'],
            ['key' => 'about_herb_content', 'value' => 'Pumi Việt Nam là sản phẩm được làm bởi sự sáng tạo kết hợp độc đáo giữa thảo mộc Việt để tạo nên sản phẩm an toàn lành tính cho mẹ và bé.<br>Ví dụ như: Mước đắng (Khổ Qua), Trà Xanh, Trầu Không, Bồ kết, ...', 'type' => 'longtext'],
            ['key' => 'about_herb_image', 'value' => 'assets/images/upload/post/img_68dd3d257b3bd.jpg', 'type' => 'image'],
            ['key' => 'about_cgmp_title', 'value' => 'Sản phẩm được sản xuất bởi nhà máy đạt chuẩn CGMP', 'type' => 'text'],
            ['key' => 'about_cgmp_image', 'value' => 'assets/images/upload/post/img_68dcec89e184d.png', 'type' => 'image'],
            ['key' => 'about_mission_title', 'value' => 'Sứ mệnh', 'type' => 'text'],
            ['key' => 'about_mission_content', 'value' => 'Pumi Việt Nam mang tên mình sứ mệnh tạo ra những sản phẩm chất lượng từ những nguồn nguyên liệu dược liệu quý của Việt Nam.<br>Cam kết sự phát triển nông nghiệp dược liệu bền vững đối với người nông dân địa phương.', 'type' => 'longtext'],
            ['key' => 'about_mission_image', 'value' => 'assets/images/upload/post/img_68dcee5d266bc.png', 'type' => 'image'],
            ['key' => 'about_vision_title', 'value' => 'Tầm nhìn', 'type' => 'text'],
            ['key' => 'about_vision_content', 'value' => 'PUMI VIỆT NAM - TỰ HÀO TINH HOA THẢO MỘC VIỆT<br>Pumi Việt Nam với sự ham học hỏi, cố gắng nỗ lực sáng tạo làm việc mỗi ngày để trở thành một thương hiệu hoá mỹ phẩm chăm sóc mẹ bé uy tín hàng đầu được các mẹ trên thế giới yêu thích.', 'type' => 'longtext'],
            ['key' => 'about_vision_image', 'value' => 'assets/images/upload/post/img_68dcee7658967.png', 'type' => 'image'],
            ['key' => 'about_core_1_title', 'value' => 'Sáng tạo', 'type' => 'text'],
            ['key' => 'about_core_1_content', 'value' => 'Mỗi ngày đội ngũ nhân sự của Pumi không ngừng tìm tỏi, học hỏi, nghiên cứu, áp dụng linh hoạt các kiến thức, sáng tạo để phát triển sản phẩm an toàn, lành tính đến người tiêu dùng.', 'type' => 'longtext'],
            ['key' => 'about_core_1_image', 'value' => 'assets/images/upload/post/img_68dcf70175dfc.png', 'type' => 'image'],
            ['key' => 'about_core_2_title', 'value' => 'Tử Tế', 'type' => 'text'],
            ['key' => 'about_core_2_content', 'value' => 'Kinh doanh “Tử Tế” chính là chìa khoá phát triển bền vững mà mỗi nhân sự Pumi đều hướng đến. Trung thực tạo dựng niềm tin và uy tín với các đối tác và khách hàng.', 'type' => 'longtext'],
            ['key' => 'about_core_2_image', 'value' => 'assets/images/upload/post/img_68dcf7482ed5b.png', 'type' => 'image'],
            ['key' => 'about_core_3_title', 'value' => 'Châm ngôn kinh doanh', 'type' => 'text'],
            ['key' => 'about_core_3_content', 'value' => '“Khởi nguồn từ yêu thương” - Giống như tình yêu của người mẹ vô điều kiện dành cho người con, Pumi luôn đặt mình vào vai người mẹ với niềm tin yêu để giải quyết nỗi đau của mẹ và bé.', 'type' => 'longtext'],
            ['key' => 'about_core_3_image', 'value' => 'assets/images/upload/post/img_68dcf75dc45f7.png', 'type' => 'image'],
            ['key' => 'about_leader_1_name', 'value' => 'Mrs. TRỊNH THỊ PHƯƠNG ANH', 'type' => 'text'],
            ['key' => 'about_leader_1_role', 'value' => 'Founder & Chairman<br>Người sáng lập kiêm chủ tịch', 'type' => 'text'],
            ['key' => 'about_leader_1_image', 'value' => 'assets/images/upload/post/img_68dcfb2780576.png', 'type' => 'image'],
            ['key' => 'about_leader_2_name', 'value' => 'Mrs. TRỊNH THANH LAM', 'type' => 'text'],
            ['key' => 'about_leader_2_role', 'value' => 'Chief Executive Officer (CEO)<br>Giám đốc điều hành', 'type' => 'text'],
            ['key' => 'about_leader_2_image', 'value' => 'assets/images/upload/post/img_68dcfb46663e9.png', 'type' => 'image'],
            ['key' => 'about_culture_title', 'value' => 'Văn hoá công ty', 'type' => 'text'],
            ['key' => 'about_culture_content', 'value' => 'SÁNG TẠO là khởi nguồn<br>TRUNG THỰC chìa khoá kết nối cá nhân, tập thể, đối tác và khách hàng<br>ĐOÀN KẾT chính là sức mạnh chuyển hoá', 'type' => 'longtext'],
            ['key' => 'about_activity_title', 'value' => 'LĨNH VỰC HOẠT ĐỘNG', 'type' => 'text'],
            ['key' => 'about_activity_subtitle', 'value' => 'FIELD OF ACTIVITY', 'type' => 'text'],
            ['key' => 'about_activity_content', 'value' => 'Việt Nam với tiềm năng phát triển dược liệu. Trong số các loài thực vật bậc cao đã được biết ở Việt Nam, có 5.117 loài cây dược liệu đã được ghi nhận, trong đó khoảng 200 loài đã được khai thác thương mại. Nhiều loài có giá trị cao, là dược liệu quý được thế giới công nhận như sâm Ngọc Linh, thông đỏ, hoa hoè, trinh nữ hoàng cung, giảo cổ lam…<br><br>Với lịch sử lâu đời về sử dụng cây dược liệu trong thực tiễn y tế và sự phát triển của khoa học công nghệ, cây dược liệu ở Việt Nam là một kho tàng vô giá để tạo ra các sản phẩm thuốc chữa bệnh, thực phẩm thực dưỡng, đồ uống, hoá mỹ phẩm…<br><br>Có thể nói, tiềm năng phát triển ngành dược liệu ở Việt Nam rất lớn. Hầu hết các loài cây dược liệu đều sinh trưởng bên trong rừng phòng hộ, dưới tán rừng với sứ mệnh cùng nông dân phát triển bền vững Pumi và đội ngũ nghiên cứu sản xuất các sản phẩm hoá phẩm, mỹ phẩm chăm sóc da cho mẹ bé từ nguyên liệu thiên nhiên hữu cơ Việt Nam (Đặc biệt các vùng Tây Bắc).', 'type' => 'longtext'],
            ['key' => 'about_activity_image', 'value' => 'assets/images/upload/post/img_68dcfbd44b353.png', 'type' => 'image'],

            // Homepage Partners section text
            ['key' => 'home_partner_title', 'value' => 'Đối tác của chúng tôi', 'type' => 'text'],
            ['key' => 'home_partner_subtitle', 'value' => 'Pumi tự hào đồng hành cùng các nhà thuốc, cửa hàng mẹ và bé, hệ thống phân phối trên toàn quốc để đưa sản phẩm thảo mộc Việt đến gần hơn với mọi gia đình.', 'type' => 'text'],

            // Partners Page settings
            ['key' => 'partners_banner', 'value' => 'assets/images/upload/banner/img_68de36354dbd9.png', 'type' => 'image'],
            ['key' => 'partners_ingredient_title', 'value' => 'Đối tác nguyên liệu', 'type' => 'text'],
            ['key' => 'partners_ingredient_1_title', 'value' => 'Đối tác ABC', 'type' => 'text'],
            ['key' => 'partners_ingredient_1_content', 'value' => '<p>hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.<br>hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>', 'type' => 'longtext'],
            ['key' => 'partners_ingredient_1_image', 'value' => 'assets/images/upload/document/img_68de34175aa5b.jpg', 'type' => 'image'],
            ['key' => 'partners_ingredient_2_title', 'value' => 'Đối tác ABC', 'type' => 'text'],
            ['key' => 'partners_ingredient_2_content', 'value' => '<p>hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.<br>hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>', 'type' => 'longtext'],
            ['key' => 'partners_ingredient_2_image', 'value' => 'assets/images/upload/document/img_68de342d7222d.jpg', 'type' => 'image'],
            ['key' => 'partners_hospital_title', 'value' => 'Đối tác bệnh viện', 'type' => 'text'],
            ['key' => 'partners_hospital_desc', 'value' => 'hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.', 'type' => 'longtext'],
            ['key' => 'partners_media_title', 'value' => 'Đối tác truyền thông', 'type' => 'text'],
            ['key' => 'partners_media_desc', 'value' => 'hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.', 'type' => 'longtext'],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(['key' => $setting['key']], $setting);
        }

        // Categories
        $catProduct = Category::firstOrCreate(['slug' => Str::slug('Sản phẩm Pumi')], ['name' => 'Sản phẩm Pumi', 'type' => 'product']);
        $catNews = Category::firstOrCreate(['slug' => Str::slug('Tin tức')], ['name' => 'Tin tức', 'type' => 'post']);

        // Products
        Product::firstOrCreate([
            'slug' => Str::slug('Nước tắm thảo dược')
        ], [
            'category_id' => $catProduct->id,
            'name' => 'Nước tắm thảo dược',
            'image' => 'assets/images/upload/product/img_68da996a88715.png',
            'short_description' => 'Hương mùa xuân & Vương Quốc Hạnh Phúc',
            'description' => 'Chiết xuất từ thảo dược thiên nhiên lành tính, dịu nhẹ cho làn da nhạy cảm của bé, hỗ trợ ngừa rôm sảy, mẩn ngứa và mang lại giấc ngủ ngon mỗi ngày.',
            'price' => null
        ]);

        Product::firstOrCreate([
            'slug' => Str::slug('Dung dịch vệ sinh cho bé')
        ], [
            'category_id' => $catProduct->id,
            'name' => 'Dung dịch vệ sinh cho bé',
            'image' => 'assets/images/upload/product/img_68ddda7c9a06e.png',
            'short_description' => 'Hương mùa xuân & Vương Quốc Hạnh Phúc',
            'description' => 'Độ pH dịu nhẹ, chiết xuất thảo mộc lành tính giúp làm sạch nhẹ nhàng vùng kín của bé, hỗ trợ phòng ngừa hăm, ngứa và viêm nhiễm thường gặp.',
            'price' => null
        ]);

        // Partners
        Partner::firstOrCreate(['image' => 'assets/images/upload/adv/thumbs/img_68dcb504c261e.png']);
        Partner::firstOrCreate(['image' => 'assets/images/upload/adv/thumbs/img_68dcb50c43d27.png']);
        Partner::firstOrCreate(['image' => 'assets/images/upload/adv/thumbs/img_68dcb513f333e.png']);
        Partner::firstOrCreate(['image' => 'assets/images/upload/adv/thumbs/img_68dcb51adde95.png']);
        Partner::firstOrCreate(['image' => 'assets/images/upload/adv/thumbs/img_68dcb5228fd91.png']);

        // Posts
        Post::firstOrCreate([
            'slug' => Str::slug('3 lý do mẹ Việt tin chọn sản phẩm thảo mộc thuần Việt cho con')
        ], [
            'category_id' => $catNews->id,
            'title' => '3 lý do mẹ Việt tin chọn sản phẩm thảo mộc thuần Việt cho con',
            'image' => 'assets/images/upload/post/thumbs/img_68da9a546ef34.jpg',
            'excerpt' => 'Ngày càng nhiều gia đình Việt ưu tiên sản phẩm nội địa từ dược liệu quê hương cho con nhỏ...',
            'published_at' => now(),
        ]);

        Post::firstOrCreate([
            'slug' => Str::slug('Chăm sóc da bé bị hăm tã, rôm sảy bằng nguyên liệu thảo mộc')
        ], [
            'category_id' => $catNews->id,
            'title' => 'Chăm sóc da bé bị hăm tã, rôm sảy bằng nguyên liệu thảo mộc',
            'image' => 'assets/images/upload/post/thumbs/img_68da9a546ef34.jpg',
            'excerpt' => 'Hăm tã và rôm sảy là nỗi ám ảnh của nhiều mẹ bỉm sữa, thảo mộc thiên nhiên có thể là giải pháp dịu nhẹ...',
            'published_at' => now(),
        ]);
        
        Post::firstOrCreate([
            'slug' => Str::slug('Hướng dẫn tắm cho trẻ sơ sinh đúng cách tại nhà')
        ], [
            'category_id' => $catNews->id,
            'title' => 'Hướng dẫn tắm cho trẻ sơ sinh đúng cách tại nhà',
            'image' => 'assets/images/upload/post/thumbs/img_68da9a546ef34.jpg',
            'excerpt' => 'Tắm cho trẻ sơ sinh tưởng đơn giản nhưng cần đúng trình tự để bé an toàn và thoải mái nhất...',
            'published_at' => now(),
        ]);
        
        Post::firstOrCreate([
            'slug' => Str::slug('Sự khác biệt giữa mỹ phẩm thảo dược và hóa mỹ phẩm thông thường cho bé')
        ], [
            'category_id' => $catNews->id,
            'title' => 'Sự khác biệt giữa mỹ phẩm thảo dược và hóa mỹ phẩm thông thường cho bé',
            'image' => 'assets/images/upload/post/thumbs/img_68da9a546ef34.jpg',
            'excerpt' => 'Không phải cứ có chữ \'thảo dược\' trên bao bì là an toàn tuyệt đối, mẹ cần hiểu rõ sự khác biệt...',
            'published_at' => now(),
        ]);
    }
}
