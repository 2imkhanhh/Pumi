@extends('client.layouts.master')

@section('content')
    <div id="carouselBanner" class="carousel slide" data-bs-ride="carousel" data-aos="super-zoom-in" data-aos-duration="1200">
        @php
            $banners = [];
            if (!empty($settings['home_banners'])) {
                $banners = json_decode($settings['home_banners'], true) ?? [];
            } else {
                if (!empty($settings['home_banner_1'])) {
                    $banners[] = [
                        'img' => $settings['home_banner_1'],
                        'link' => $settings['home_banner_1_link'] ?? '#',
                    ];
                }
                if (!empty($settings['home_banner_2'])) {
                    $banners[] = [
                        'img' => $settings['home_banner_2'],
                        'link' => $settings['home_banner_2_link'] ?? '#',
                    ];
                }
                if (!empty($settings['home_banner_3'])) {
                    $banners[] = [
                        'img' => $settings['home_banner_3'],
                        'link' => $settings['home_banner_3_link'] ?? '#',
                    ];
                }
            }
            if (empty($banners)) {
                $banners[] = ['img' => 'assets/images/upload/banner/img_68dcb2fd1d474.jpg', 'link' => '#'];
                $banners[] = ['img' => 'assets/images/upload/banner/img_68ddf4eb12021.jpg', 'link' => '#'];
            }
        @endphp
        <div class="carousel-indicators">
            @foreach ($banners as $index => $banner)
                <button type="button" data-bs-target="#carouselBanner" data-bs-slide-to="{{ $index }}"
                    class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}"
                    aria-label="banner {{ $index + 1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner">
            @foreach ($banners as $index => $banner)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="ci-inner">
                        <div class="img">
                            <a href="{{ $banner['link'] }}"><img src="{{ asset($banner['img']) }}" class="d-block w-100"
                                    alt="banner {{ $index + 1 }}"></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselBanner" data-bs-slide="prev">
            <img src="{{ asset('assets/images/left-banner.png') }}" alt="" />
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselBanner" data-bs-slide="next">
            <img src="{{ asset('assets/images/right-banner.png') }}" alt="" />
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <section id="about-us">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center gy-4">
                <div class="col-md-5" data-aos="super-slide-right">
                    <h2 class="title">{{ $settings['home_welcome_title'] ?? 'Pumi Việt Nam' }}</h2>
                    <div class="desc">{{ $settings['home_welcome_subtitle'] ?? 'Xin Chào!' }}</div>
                </div>
                <div class="col-md-6 offset-lg-1" data-aos="super-slide-left" data-aos-delay="200">
                    <div class="content">
                        {!! $settings['home_welcome_content'] ??
                            '<p>Pumi Việt Nam thực sự vinh hạnh và trân quý bởi sự tin tưởng lựa chọn sản phẩm, dịch vụ của quý khách hàng!<br><br>Website này là toàn bộ thông tin chi tiết về Pumi, về sứ mệnh cũng như tâm huyết công hiến của đội ngũ nhân sự chúng mình. Hy vọng bạn sẽ đón nhận chúng mình một cách thoải mái và cởi mở nhất nhé!<br><br>Pumi luôn lắng nghe và cố gắng nỗ lực cải thiện mỗi ngày để đem lại sự hài lòng cho bạn!</p>' !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="video-home" data-aos="super-zoom-in" data-aos-duration="1000">
        <video width="100%" height="680" autoplay loop playsinline controls style="background-color: #000;">
            <source
                src="{{ !empty($settings['home_video']) ? asset($settings['home_video']) : asset('assets/images/TVC.mp4') }}"
                type="video/mp4">
            Trình duyệt của bạn không hỗ trợ thẻ video.
        </video>
    </section>

    <section id="about-us-home" class="about-us-home">
        <div class="warp">
            <div class="about-us-text" data-aos="super-fade-up" data-aos-duration="1000">
                <h2 class="title">{{ $settings['home_about_title'] ?? 'PUMI VIỆT NAM' }}</h2>
                <h3 class="desc">{{ $settings['home_about_subtitle'] ?? 'TỰ HÀO TINH HOA THẢO MỘC VIỆT' }}</h3>
                <div class="content">
                    <p>{!! $settings['home_about_content'] ??
                        'Mang trong mình sứ mệnh tạo ra những sản phẩm chất lượng từ những nguồn nguyên liệu dược liệu quý của Việt Nam.<br>Cam kết sự phát triển nông nghiệp dược liệu bền vững đối với người nông dân địa phương.' !!}</p>
                </div>
                <div class="mt-5"><a href="{{ url('/ve-pumi') }}" class="btn-themes">Xem thêm <img
                            src="{{ asset('assets/images/right-arrow.svg') }}" /></a></div>
            </div>
        </div>
    </section>

    <section class="banner-pro-home" data-aos="super-zoom-in">
        <a href="{{ url('/san-pham') }}"><img
                src="{{ asset($settings['home_middle_banner'] ?? 'assets/images/upload/banner/img_68da94b145c2f.png') }}"
                alt="" class="w-100" /></a>
    </section>

    <section id="products-home" class="">
        <div id="top-products-home"></div>
        <div class="warp">
            <div class="container">
                @foreach ($products as $index => $product)
                    <div class="box-products-home">
                        <div class="row d-flex justify-content-between align-items-center gy-4">
                            <div class="col-md-5 {{ $index % 2 != 0 ? 'order-md-last mt-4 mt-md-0' : '' }}"
                                data-aos="{{ $index % 2 == 0 ? 'super-slide-right' : 'super-slide-left' }}">
                                <div class="img"><img src="{{ asset($product->image) }}" alt="{{ $product->name }}" />
                                </div>
                            </div>
                            <div class="col-md-6 offset-lg-1 {{ $index % 2 != 0 ? 'order-md-first mt-3 mt-md-0' : '' }}"
                                data-aos="{{ $index % 2 == 0 ? 'super-slide-left' : 'super-slide-right' }}"
                                data-aos-delay="200">
                                <div class="info">
                                    <h3 class="title">{{ $product->name }}</h3>
                                    <div class="desc">{{ $product->short_description }}</div>
                                    <div class="content">{!! $product->description !!}</div>
                                    <div class="more"><a class="btn-themes"
                                            href="{{ url('/san-pham/' . $product->slug) }}">Xem thêm <img
                                                src="{{ asset('assets/images/right-arrow.svg') }}" alt="" /></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="mt-5 text-center view-all" data-aos="super-fade-up"><a href="{{ url('/san-pham') }}"
                        class="btn-themes">Xem thêm <img src="{{ asset('assets/images/right-arrow-blue.svg') }}" /></a>
                </div>
            </div>
        </div>
    </section>

    <section id="partner" class="partner">
        <div id="box_partner" class=" ">
            <header class="section-header text-center" data-aos="super-zoom-in">
                <h2>{{ $settings['home_partner_title'] ?? 'Đối tác của chúng tôi' }}</h2>
                <p>{{ $settings['home_partner_subtitle'] ?? 'Pumi tự hào đồng hành cùng các nhà thuốc, cửa hàng mẹ và bé, hệ thống phân phối trên toàn quốc để đưa sản phẩm thảo mộc Việt đến gần hơn với mọi gia đình.' }}
                </p>
            </header>
            <div class="swiper featureSwiper" data-aos="super-fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                    @foreach ($partners as $partner)
                        <div class="swiper-slide d-flex align-items-center justify-content-center">
                            <div class="box-item d-flex align-items-center justify-content-center">
                                <img src="{{ isset($partner['img']) ? asset($partner['img']) : '' }}" alt="Partner"
                                    class="img-fluid" />
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next-01"><i class="fa-regular fa-chevron-right"></i></div>
                <div class="swiper-button-prev-01"><i class="fa-regular fa-chevron-left"></i></div>
            </div>
        </div>
    </section>

    <section id="news-home" class="news-home">
        <div class="container">
            <header class="section-header d-flex align-items-center justify-content-between" data-aos="super-zoom-in">
                <h2>Tin tức</h2>
                <div><a href="{{ url('/tin-tuc') }}" class="btn-themes">Tất cả bài viết <img
                            src="{{ asset('assets/images/right-arrow.svg') }}" /></a></div>
            </header>
            <div class="row gy-4">
                @foreach ($posts as $post)
                    <div class="col-xl-3 col-md-6 col-12" data-aos="super-fade-up"
                        data-aos-delay="{{ 100 * ($loop->index + 1) }}">
                        <article>
                            <a href="{{ url('/tin-tuc/' . $post->slug) }}">
                                <div class="img"><img src="{{ asset($post->image) }}" alt="{{ $post->title }}" />
                                </div>
                                <div class="description">
                                    <p class="post-date">
                                        <time>Pumi |
                                            {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d.m.y') : now()->format('d.m.y') }}</time>
                                    </p>
                                    <h2 class="title">{{ $post->title }}</h2>
                                    <div class="desc">{{ $post->excerpt }}</div>
                                </div>
                            </a>
                        </article>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="contact" class="pt-0">
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-7" data-aos="super-slide-right">
                    <div id="panel_contact">
                        <form class="form-horizontal ajaxform" action="{{ url('/lien-he') }}" name="frmContact"
                            id="frmContact" method="post">
                            @csrf
                            <div class="form-group required mt-2">
                                <input type="text" name="fullname" value="" placeholder="Họ và tên"
                                    maxlength="256" required />
                            </div>
                            <div class="form-group required mt-2">
                                <input type="email" name="email" value="" placeholder="Email" maxlength="256"
                                    required />
                            </div>
                            <div class="form-group required mt-2">
                                <input type="text" name="content" value=""
                                    placeholder="Chúng tôi có thể giúp gì cho bạn?" maxlength="256" required />
                            </div>
                            <div class="mt-2 text-center">
                                <button type="submit" id="btnContact" name="btnContact">Gửi</button>
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
                <div class="col-md-5" data-aos="super-slide-left" data-aos-delay="200"><img
                        src="{{ asset('assets/images/right-contact.png') }}" class="img-fluid" alt="Contact" /></div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('assets/js/pages/home.js?v=1.1') }}"></script>
@endpush
