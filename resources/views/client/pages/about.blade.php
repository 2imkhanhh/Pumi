@extends('client.layouts.master')
@section('title', 'Về Pumi - Khởi nguồn từ yêu thương')
@section('content')
<main id="main">

        <section id="banner" class="banner-about banner-bg d-flex align-items-center" style="background-image: url('{{ asset($settings['about_banner'] ?? 'assets/images/upload/banner/img_68dcba9ec7a66.jpg') }}')" data-aos="fade-down" data-aos-duration="1200">
            <div class="container">
                <header class="section-header text-center">
                    <h2>Về Pumi</h2>
                </header>
            </div>
        </section>
        
        <section id="about-us-page">
            <div class="container">
                <div id="panel-about-us">
                    <div id="box-about-us" data-aos="fade-right">
                        <h2 class="title">{{ $settings['about_welcome_title'] ?? 'Pumi Việt Nam' }}</h2>
                        <div class="desc">{{ $settings['about_welcome_subtitle'] ?? 'Xin Chào!' }}</div>
                        <div class="content">
                            {!! $settings['about_welcome_content'] ?? '<p>Ra đời từ năm 2024, Pumi Việt Nam là Thương hiệu được khởi nguồn từ tình yêu thương vô điều kiện của người mẹ dành cho đứa con mới chào đời của mình. Chính từ tình yêu ấy, chúng tôi thấu hiểu sâu sắc những băn khoăn, lo lắng của các mẹ khi lựa chọn sản phẩm giữa muôn vàn thương hiệu trên thị trường. Với PUMI, mỗi sản phẩm không chỉ đơn thuần là sự kết hợp giữa các thành phần thiên nhiên lành tính và dược liệu chất lượng cao – mà còn là cam kết về sự trung thực, an toàn và đồng hành lâu dài cùng mẹ và bé.<br>Pumi Việt Nam mang trên mình sứ mệnh tạo ra những sản phẩm chất lượng từ những nguồn nguyên liệu dược liệu quý của Việt Nam.<br>Cam kết sự phát triển nông nghiệp dược liệu bền vững đối với người nông dân địa phương.</p>' !!}
                        </div>
                    </div>
                    <div class="img" data-aos="fade-left" data-aos-delay="200">
                        <img src="{{ asset($settings['about_welcome_image'] ?? 'assets/images/upload/post/img_68dcbf27e5e6b.png') }}" alt="{{ $settings['about_welcome_title'] ?? 'Pumi Việt Nam' }}"/>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="about-1" class="aboutus-section mt-5">
            <div class="container-fluid">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-md-6 p-0" data-aos="super-slide-right">
                        <div class="img">
                            <img src="{{ asset($settings['about_story_image'] ?? 'assets/images/upload/post/img_68dd39cfa8028.jpg') }}" alt="{{ $settings['about_story_title'] ?? 'Câu chuyện về nguyên liệu' }}" class="img-fluid"/>
                        </div>
                    </div>
                    <div class="col-md-6 p-0" data-aos="super-slide-left" data-aos-delay="200">
                        <div class="info">
                            <h2 class="title">{{ $settings['about_story_title'] ?? 'Câu chuyện về nguyên liệu' }}</h2>
                            <div class="desc">{{ $settings['about_story_subtitle'] ?? 'Sức sáng tạo của người Việt' }}</div>
                            <div class="content">
                                {!! $settings['about_story_content'] ?? '<p><strong>“Pumi - gợi nhớ hành trình làm mẹ đầy ý nghĩa”</strong><br>Có những câu chuyện được kể bằng lời, bằng hình ảnh… Nhưng hãy để PUMI kể câu chuyện làm mẹ – một hành trình thiêng liêng và đầy cảm xúc – qua những tầng hương tinh tế. Mỗi mùi hương là một nhịp cầu kết nối không gian, thời gian, con người và những ký ức yêu thương – như một bản giao hưởng nhẹ nhàng của tình mẫu tử lan tỏa trong từng hơi thở cuộc sống.</p>' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="about-2" class="aboutus-section">
            <div class="container-fluid">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col-md-6 p-lg-0" data-aos="super-slide-right">
                        <div class="info">
                            <h2 class="title">{{ $settings['about_message_title'] ?? 'Thông điệp thương hiệu' }}</h2>
                            <div class="desc">{{ $settings['about_message_subtitle'] ?? 'Mùi hương ghi dấu ấn và truyền tải cảm xúc' }}</div>
                            <div class="content">
                                <div><img src="{{ asset('assets/images/about-left-comma.png') }}" alt=""/></div>
                                <div class="my-2">
                                    {!! $settings['about_message_content'] ?? '<p><strong>Ngưng đánh giá mùi hương bằng thời gian mà hãy cảm nhận mùi hương đó bằng cảm xúc.</strong></p>' !!}
                                </div>
                                <div class="text-end"><img src="{{ asset('assets/images/about-right-comma.png') }}" alt=""/></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 p-lg-0" data-aos="super-slide-left" data-aos-delay="200">
                        <div class="img">
                            <img src="{{ asset($settings['about_message_image'] ?? 'assets/images/upload/post/img_68dceb15e4f8a.jpg') }}" alt="{{ $settings['about_message_title'] ?? 'Thông điệp thương hiệu' }}" class="img-fluid"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="about-3" class="mt-5 mt-lg-0">
            <div class="warp">
                <div class="img" data-aos="super-slide-right">
                    <img src="{{ asset($settings['about_herb_image'] ?? 'assets/images/upload/post/img_68dd3d257b3bd.jpg') }}" alt="{{ $settings['about_herb_title'] ?? 'Ứng dụng thảo dược Việt' }}"/>
                </div>
                <div class="info" data-aos="super-slide-left" data-aos-delay="200">
                    <h2 class="title">{{ $settings['about_herb_title'] ?? 'Ứng dụng thảo dược Việt' }}</h2>
                    <div class="content">
                        {!! $settings['about_herb_content'] ?? '<p>Pumi Việt Nam là sản phẩm được làm bởi sự sáng tạo kết hợp độc đáo giữa thảo mộc Việt để tạo nên sản phẩm an toàn lành tính cho mẹ và bé.<br>Ví dụ như: Mước đắng (Khổ Qua), Trà Xanh, Trầu Không, Bồ kết, ...</p>' !!}
                    </div>
                </div>
            </div>
        </section>
        
        <section id="about-4" class="mt-5">
            <div class="text-center">
                <h2 class="title" data-aos="super-fade-up">{{ $settings['about_cgmp_title'] ?? 'Sản phẩm được sản xuất bởi nhà máy đạt chuẩn CGMP' }}</h2>
                <div class="img" data-aos="super-zoom-in" data-aos-delay="200">
                    <img src="{{ asset($settings['about_cgmp_image'] ?? 'assets/images/upload/post/img_68dcec89e184d.png') }}" alt="{{ $settings['about_cgmp_title'] ?? 'CGMP' }}" class="img-fluid"/>
                </div>
            </div>
        </section> 
        
        <section id="about-us-mission" class="about-us-mission mt-5">
            <div class="container">
                <div class="row d-flex align-items-center justify-content-center mt-3 mt-lg-0 gy-4">
                    <div class="col-lg-4" data-aos="super-slide-right">
                        <img src="{{ asset('assets/images/view-mission.png') }}" alt="Tầm nhìn, sứ mệnh" class="img-fluid zoomImage"/>
                    </div>
                    <div class="col-lg-8">
                        <div class="p-lg-5">
                            <header class="section-header " data-aos="super-zoom-in">
                                <h2>Tầm nhìn, sứ mệnh</h2>
                                <h3>Mission, Vision</h3>
                            </header>
                            <div class="row">
                                <div class="col-lg-6" data-aos="super-zoom-in" data-aos-delay="100">
                                    <div class="img">
                                        <img src="{{ asset($settings['about_mission_image'] ?? 'assets/images/upload/post/img_68dcee5d266bc.png') }}" alt="{{ $settings['about_mission_title'] ?? 'Sứ mệnh' }}" class="zoomImage"/>
                                    </div>
                                    <h4 class="mt-4">{{ $settings['about_mission_title'] ?? 'Sứ mệnh' }}</h4>
                                    <div class="content">
                                        {!! $settings['about_mission_content'] ?? '<p>Pumi Việt Nam mang tên mình sứ mệnh tạo ra những sản phẩm chất lượng từ những nguồn nguyên liệu dược liệu quý của Việt Nam.<br>Cam kết sự phát triển nông nghiệp dược liệu bền vững đối với người nông dân địa phương.</p>' !!}
                                    </div>
                                </div>
                                <div class="col-lg-6" data-aos="super-zoom-in" data-aos-delay="300">
                                    <div class="img">
                                        <img src="{{ asset($settings['about_vision_image'] ?? 'assets/images/upload/post/img_68dcee7658967.png') }}" alt="{{ $settings['about_vision_title'] ?? 'Tầm nhìn' }}"/>
                                    </div>
                                    <h4 class="mt-4">{{ $settings['about_vision_title'] ?? 'Tầm nhìn' }}</h4>
                                    <div class="content">
                                        {!! $settings['about_vision_content'] ?? '<p>PUMI VIỆT NAM - TỰ HÀO TINH HOA THẢO MỘC VIỆT<br>Pumi Việt Nam với sự ham học hỏi, cố gắng nỗ lực sáng tạo làm việc mỗi ngày để trở thành một thương hiệu hoá mỹ phẩm chăm sóc mẹ bé uy tín hàng đầu được các mẹ trên thế giới yêu thích.</p>' !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>  
        
        <section id="core-values" class="core-values">
            <div class="container">
                <header class="section-header text-center swidth" data-aos="super-zoom-in">
                    <h2>Giá Trị Cốt Lõi</h2>
                    <h3>Core values</h3>
                </header>
                <div class="row d-flex align-items-center justify-content-center mt-3">
                    <div class="col-lg-4 text-center mt-3 mt-lg-0" data-aos="super-flip" data-aos-delay="100">
                        <div class="box-values">
                            <div class="img">
                                <img src="{{ asset($settings['about_core_1_image'] ?? 'assets/images/upload/post/img_68dcf70175dfc.png') }}" alt="{{ $settings['about_core_1_title'] ?? 'Sáng tạo' }}"/>
                            </div>
                            <h4 class="title">{{ $settings['about_core_1_title'] ?? 'Sáng tạo' }}</h4>
                            <div class="content">
                                {!! $settings['about_core_1_content'] ?? '<p>Mỗi ngày đội ngũ nhân sự của Pumi không ngừng tìm tỏi, học hỏi, nghiên cứu, áp dụng linh hoạt các kiến thức, sáng tạo để phát triển sản phẩm an toàn, lành tính đến người tiêu dùng.</p>' !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-3 mt-lg-0" data-aos="super-flip" data-aos-delay="300">
                        <div class="box-values text-center">
                            <div class="img">
                                <img src="{{ asset($settings['about_core_2_image'] ?? 'assets/images/upload/post/img_68dcf7482ed5b.png') }}" alt="{{ $settings['about_core_2_title'] ?? 'Tử Tế' }}"/>
                            </div>
                            <h4 class="title">{{ $settings['about_core_2_title'] ?? 'Tử Tế' }}</h4>
                            <div class="content">
                                {!! $settings['about_core_2_content'] ?? '<p>Kinh doanh “Tử Tế” chính là chìa khoá phát triển bền vững mà mỗi nhân sự Pumi đều hướng đến. Trung thực tạo dựng niềm tin và uy tín với các đối tác và khách hàng.</p>' !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center mt-3 mt-lg-0" data-aos="super-flip" data-aos-delay="500">
                        <div class="box-values">
                            <div class="img">
                                <img src="{{ asset($settings['about_core_3_image'] ?? 'assets/images/upload/post/img_68dcf75dc45f7.png') }}" alt="{{ $settings['about_core_3_title'] ?? 'Châm ngôn kinh doanh' }}"/>
                            </div>
                            <h4 class="title">{{ $settings['about_core_3_title'] ?? 'Châm ngôn kinh doanh' }}</h4>
                            <div class="content">
                                {!! $settings['about_core_3_content'] ?? '<p>“Khởi nguồn từ yêu thương” - Giống như tình yêu của người mẹ vô điều kiện dành cho người con, Pumi luôn đặt mình vào vai người mẹ với niềm tin yêu để giải quyết nỗi đau của mẹ và bé.</p>' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="aboutus-company">
            <div class="container">
                <header class="section-header text-center swidth" data-aos="super-zoom-in">
                    <h2>NGƯỜI ĐỨNG ĐẦU</h2>
                    <h3>Executive Board</h3>
                </header>
                <div class="row mt-3">
                    <div class="col-md-6" data-aos="super-slide-right" data-aos-delay="100">
                        <div class="d-lg-flex align-items-end">
                            <div class="flex-shrink-0">
                                <img src="{{ asset($settings['about_leader_1_image'] ?? 'assets/images/upload/post/img_68dcfb2780576.png') }}" alt="{{ $settings['about_leader_1_name'] ?? 'Mrs. TRỊNH THỊ PHƯƠNG ANH' }}"/>
                            </div>
                            <div class="flex-grow-1 mt-3 mt-lg-0 ms-lg-3">
                                <h4 class="title">{{ $settings['about_leader_1_name'] ?? 'Mrs. TRỊNH THỊ PHƯƠNG ANH' }}</h4>
                                <div class="content">
                                    {!! $settings['about_leader_1_role'] ?? '<p><strong>Founder &amp; Chairman</strong>&nbsp;<br><strong>Người sáng lập kiêm chủ tịch</strong></p>' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" data-aos="super-slide-left" data-aos-delay="300">
                        <div class="d-lg-flex align-items-end">
                            <div class="flex-shrink-0">
                                <img src="{{ asset($settings['about_leader_2_image'] ?? 'assets/images/upload/post/img_68dcfb46663e9.png') }}" alt="{{ $settings['about_leader_2_name'] ?? 'Mrs. TRỊNH THANH LAM' }}"/>
                            </div>
                            <div class="flex-grow-1 mt-3 mt-lg-0 ms-lg-3">
                                <h4 class="title">{{ $settings['about_leader_2_name'] ?? 'Mrs. TRỊNH THANH LAM' }}</h4>
                                <div class="content">
                                    {!! $settings['about_leader_2_role'] ?? '<p><strong>Chief Executive Officer (CEO)</strong>&nbsp;<br><strong>Giám đốc điều hành</strong></p>' !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="culture" data-aos="super-zoom-in" data-aos-duration="1000">
                    <header class="section-header text-center" data-aos="super-zoom-in">
                        <h2>{{ $settings['about_culture_title'] ?? 'Văn hoá công ty' }}</h2>
                    </header>
                    <div class="text-start"><img src="{{ asset('assets/images/about-left-comma.png') }}" alt=""/></div>
                    <div class="content my-2">
                        {!! $settings['about_culture_content'] ?? '<p><strong>SÁNG TẠO</strong> là khởi nguồn&nbsp;<br><strong>TRUNG THỰC</strong> chìa khoá kết nối cá nhân, tập thể, đối tác và khách hàng&nbsp;<br><strong>ĐOÀN KẾT</strong> chính là sức mạnh chuyển hoá</p>' !!}
                    </div>
                    <div class="text-end"><img src="{{ asset('assets/images/about-right-comma.png') }}" alt=""/></div>
                </div>
            </div>
        </section>
        
        <section id="about-activity" class="mt-5">
            <div class="container">
                <div class="row d-lg-flex align-items-lg-end">
                    <div class="col-md-7" data-aos="super-slide-right">
                        <header class="section-header">
                            <h2>{{ $settings['about_activity_title'] ?? 'LĨNH VỰC HOẠT ĐỘNG' }}</h2>
                            <h3>{{ $settings['about_activity_subtitle'] ?? 'FIELD OF ACTIVITY' }}</h3>
                        </header>
                        <div class="content">
                            {!! $settings['about_activity_content'] ?? '<p>Việt Nam với tiềm năng phát triển dược liệu. Trong số các loài thực vật bậc cao đã được biết ở Việt Nam, có 5.117 loài cây dược liệu đã được ghi nhận, trong đó khoảng 200 loài đã được khai thác thương mại. Nhiều loài có giá trị cao, là dược liệu quý được thế giới công nhận như sâm Ngọc Linh, thông đỏ, hoa hoè, trinh nữ hoàng cung, giảo cổ lam…<br><br>Với lịch sử lâu đời về sử dụng cây dược liệu trong thực tiễn y tế và sự phát triển của khoa học công nghệ, cây dược liệu ở Việt Nam là một kho tàng vô giá để tạo ra các sản phẩm thuốc chữa bệnh, thực phẩm thực dưỡng, đồ uống, hoá mỹ phẩm…<br><br>Có thể nói, tiềm năng phát triển ngành dược liệu ở Việt Nam rất lớn. Hầu hết các loài cây dược liệu đều sinh trưởng bên trong rừng phòng hộ, dưới tán rừng với sứ mệnh cùng nông dân phát triển bền vững Pumi và đội ngũ nghiên cứu sản xuất các sản phẩm hoá phẩm, mỹ phẩm chăm sóc da cho mẹ bé từ nguyên liệu thiên nhiên hữu cơ Việt Nam (Đặc biệt các vùng Tây Bắc).</p>' !!}
                        </div>
                    </div>
                    <div class="col-md-5" data-aos="super-slide-left" data-aos-delay="200">
                        <div class="img">
                            <img src="{{ asset($settings['about_activity_image'] ?? 'assets/images/upload/post/img_68dcfbd44b353.png') }}" alt="{{ $settings['about_activity_title'] ?? 'Lĩnh vực hoạt động' }}" class="img-fluid"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="contact">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-md-7" data-aos="super-slide-right">
                        <div id="panel_contact">
                            <form class="form-horizontal ajaxform" action="{{ route('contact.submit') }}" name="frmContact" id="frmContact" method="post">
                                @csrf
                                <div class="form-group required mt-2">
                                    <input type="text" name="fullname" value="" placeholder="Họ và tên" maxlength="256" required />
                                </div>
                                <div class="form-group required mt-2">
                                    <input type="text" name="email" value="" placeholder="Email"  maxlength="256" required />
                                </div>
                                <div class="form-group required mt-2">
                                    <input type="text" name="content" value="" placeholder="Chúng tôi có thể giúp gì cho bạn?" maxlength="256" required />
                                </div>
                                <div class="mt-2 text-center">
                                    <button type="submit" id="btnContact" name="btnContact" >Gửi</button>
                                </div>
                            </form>
                            <div id="follow_on">
                            <a href="{{ $settings['facebook'] ?? '#' }}" target="_blank"><img src="{{ asset('assets/images/facebook.svg') }}" alt=""></a>
                            <a href="{{ $settings['tiktok'] ?? '#' }}" target="_blank"><img src="{{ asset('assets/images/instagram.svg') }}" alt=""></a>
                            <a href="{{ $settings['shopee'] ?? '#' }}" target="_blank"><img src="{{ asset('assets/images/shopee.svg') }}" alt=""></a>
                            <a href="{{ $settings['website'] ?? '#' }}" target="_blank"><img src="{{ asset('assets/images/web.svg') }}" alt=""></a>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-5" data-aos="super-slide-left" data-aos-delay="200">
                        <img src="{{ asset('assets/images/right-contact.png') }}" class="img-fluid" alt="Contact"/>
                    </div>
                </div>
            </div>
        </section>
    
</main>
@endsection
