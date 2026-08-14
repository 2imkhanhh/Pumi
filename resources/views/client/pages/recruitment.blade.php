@extends('client.layouts.master')
@section('title', 'recruiment.html')
@section('content')
<main id="main">

        <section id="banner" class="banner-bgs d-flex align-items-end" style="background-image: url('assets/images/upload/banner/img_68dde2e81b6f1.png')">
            <div class="container">
            <h2>Tuyển dụng</h2>
            </div>
       </section><section id="news" class="news">
       <div class="container"><div id="news-list" class="news-list row gy-4 mt-4">
            <div class="col-xl-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="100">
             <a href="recruiment/lorem-ipsum-dolor-sit-amet-consectetuer-ipsum-46.html">
                   <div class="inner">
                       <article>
                           <div class="imgbox"><img src="{{ asset('assets/') }}/images/upload/post/img_68da9a546ef34.jpg" alt="Tuyển Nhân viên Kinh doanh - Phát triển kênh Đại lý/Nhà thuốc"/></div>
                           <div class="date">Pumi  |   29.09.25</div>
                           <h2 class="title">Tuyển Nhân viên Kinh doanh - Phát triển kênh Đại lý/Nhà thuốc</h2>
                           <div class="desc">Pumi Việt Nam tuyển Nhân viên kinh doanh phát triển hệ thống đại lý, nhà thuốc, cửa hàng mẹ và bé...</div>
                       </article>
                   </div>
                   </a>
               </div><!-- End item -->
               
            <div class="col-xl-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="100">
             <a href="recruiment/lorem-ipsum-dolor-sit-amet-consectetuer-ipsum-47.html">
                   <div class="inner">
                       <article>
                           <div class="imgbox"><img src="{{ asset('assets/') }}/images/upload/post/img_68da9a546ef34.jpg" alt="Tuyển Nhân viên Marketing Online"/></div>
                           <div class="date">Pumi  |   29.09.25</div>
                           <h2 class="title">Tuyển Nhân viên Marketing Online</h2>
                           <div class="desc">Xây dựng và triển khai nội dung, chiến dịch quảng cáo cho thương hiệu thảo mộc Pumi trên các nền tảng số...</div>
                       </article>
                   </div>
                   </a>
               </div><!-- End item -->
               
            <div class="col-xl-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="100">
             <a href="recruiment/lorem-ipsum-dolor-sit-amet-consectetuer-ipsum-48.html">
                   <div class="inner">
                       <article>
                           <div class="imgbox"><img src="{{ asset('assets/') }}/images/upload/post/img_68da9a546ef34.jpg" alt="Tuyển Nhân viên Vận hành Kho - Đóng gói Sản phẩm"/></div>
                           <div class="date">Pumi  |   29.09.25</div>
                           <h2 class="title">Tuyển Nhân viên Vận hành Kho - Đóng gói Sản phẩm</h2>
                           <div class="desc">Đảm bảo hàng hóa xuất nhập kho chính xác, đóng gói sản phẩm thảo dược Pumi đúng quy trình chất lượng...</div>
                       </article>
                   </div>
                   </a>
               </div><!-- End item -->
               
            <div class="col-xl-3 col-md-6 col-12" data-aos="fade-up" data-aos-delay="100">
             <a href="recruiment/lorem-ipsum-dolor-sit-amet-consectetuer-ipsum-49.html">
                   <div class="inner">
                       <article>
                           <div class="imgbox"><img src="{{ asset('assets/') }}/images/upload/post/img_68da9a546ef34.jpg" alt="Tuyển Nhân viên Chăm sóc Khách hàng"/></div>
                           <div class="date">Pumi  |   29.09.25</div>
                           <h2 class="title">Tuyển Nhân viên Chăm sóc Khách hàng</h2>
                           <div class="desc">Tiếp nhận và tư vấn cho khách hàng về sản phẩm thảo dược Pumi qua điện thoại, mạng xã hội và website...</div>
                       </article>
                   </div>
                   </a>
               </div><!-- End item -->
               </div>
        </div>
    </section><section id="contact">
            <div class="container">
            <div class="row">
	<div class="col-md-7">
	            <div id="panel_contact">
                    <form class="form-horizontal ajaxform" action="https://pumi.vn/send-contact.html" name="frmContact" id="frmContact" method="post">
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
                        <a href="#"><img src="{{ asset('assets/') }}/images/facebook.svg" alt=""></a>
                        <a href="#"><img src="{{ asset('assets/') }}/images/tiktok.svg" alt=""></a>
                        <a href="#"><img src="{{ asset('assets/') }}/images/instagram.svg" alt=""></a>
                        <a href="#"><img src="{{ asset('assets/') }}/images/web.svg" alt=""></a>
                    </div>
                </div>
</div>
	<div class="col-md-5"><img src="{{ asset('assets/') }}/images/right-contact.png" class="img-fluid" alt="Contact"/></div>
</div>
                
            </div></section>
    
</main>
@endsection
