@extends('client.layouts.master')
@section('title', $post->title)
@section('content')
<main id="main">

        <section id="banner" class="banner-blog d-flex align-items-end" style="background-image: url('{{ asset('assets/images/upload/banner/img_68dde2e81b6f1.png') }}')" data-aos="super-zoom-in" data-aos-duration="1200"><div class="container"><nav class="breadcrumb-pu"><a href="{{ route('home') }}">Trang chủ</a><span class="sep">/</span><a href="{{ route('recruitment') }}">Tuyển dụng</a><span class="sep">/</span><span class="current">{{ $post->title }}</span></nav></div></section><section id="detail-post" class="mt-5"><div class="container"><div class="row">
        <div class="col-lg-8" data-aos="super-slide-right">
            <article class="post-article job-article">
                <span class="post-tag">Tuyển dụng</span>
                <h1>{{ $post->title }}</h1>
                <div class="post-meta">
                    <span><i class="fa-regular fa-calendar"></i> Đăng ngày {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d.m.y') : '' }}</span>
                    <span><i class="fa-solid fa-location-dot"></i> {{ $post->location ?? 'Thành phố Sơn La' }}</span>
                    <span><i class="fa-regular fa-clock"></i> Hạn nộp: {{ $post->deadline ? \Carbon\Carbon::parse($post->deadline)->format('d.m.y') : '31.12.25' }}</span>
                </div>
                <div class="job-highlight">
                    <ul>
                        <li><i class="fa-solid fa-briefcase"></i> {{ $post->job_type ?? 'Toàn thời gian' }}</li>
                        <li><i class="fa-solid fa-location-dot"></i> {{ $post->location ?? 'Thành phố Sơn La' }}</li>
                        <li><i class="fa-solid fa-sack-dollar"></i> {{ $post->salary ?? 'Thỏa thuận + thưởng' }}</li>
                        <li><i class="fa-solid fa-calendar-check"></i> Hạn nộp: {{ $post->deadline ? \Carbon\Carbon::parse($post->deadline)->format('d.m.y') : '31.12.25' }}</li>
                    </ul>
                </div>
                <div class="post-detail">{!! $post->content !!}</div>
                <div class="job-apply-cta">
                    <h3>Quan tâm đến vị trí này?</h3>
                    <p>Gửi CV ngay để trở thành một phần của đội ngũ Pumi Việt Nam.</p>
                    <a class="btn-themes" href="mailto:congtycophanpumivietnam@gmail.com?subject=Ung%20tuyen%3A%20{{ urlencode($post->title) }}">Ứng tuyển ngay <img src="{{ asset('assets/images/right-arrow.svg') }}" /></a>
                </div>
            </article>
        </div>
        <div class="col-lg-4" data-aos="super-slide-left" data-aos-delay="200">
            <aside class="post-sidebar">
                <div class="sidebar-box">
                    <h4>Tìm kiếm sản phẩm</h4>
                    <form class="sidebar-search" action="{{ route('search') }}" method="get">
                        <input type="text" name="keyword" placeholder="Tìm sản phẩm Pumi...">
                        <button type="submit" aria-label="Tìm kiếm"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
                <div class="sidebar-box">
                    <h4>Vị trí đang tuyển khác</h4>
                    <ul class="related-list">
                        @foreach($relatedPosts as $related)
                        <li><a href="{{ route('recruitment.detail', $related->slug) }}"><div class="thumb"><img src="{{ $related->image ? asset($related->image) : asset('assets/images/no-image.jpg') }}" alt="{{ $related->title }}"></div><div><span class="rl-title">{{ $related->title }}</span><span class="rl-date">{{ $related->published_at ? \Carbon\Carbon::parse($related->published_at)->format('d.m.y') : '' }}</span></div></a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="sidebar-box sidebar-cta">
                    <h4>Cần hỗ trợ ứng tuyển?</h4>
                    <p>Liên hệ trực tiếp bộ phận nhân sự Pumi Việt Nam.</p>
                    <a class="btn-themes" href="tel:0986.127.635">Gọi 0986.127.635</a>
                </div>
            </aside>
        </div>
    </div></div></section><section id="contact">
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
                            <input type="email" name="email" value="" placeholder="Email"  maxlength="256" required />
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
                        <a href="{{ $settings['tiktok'] ?? '#' }}" target="_blank"><img src="{{ asset('assets/images/tiktok.svg') }}" alt=""></a>
                        <a href="{{ $settings['instagram'] ?? '#' }}" target="_blank"><img src="{{ asset('assets/images/instagram.svg') }}" alt=""></a>
                        <a href="{{ $settings['website'] ?? '#' }}" target="_blank"><img src="{{ asset('assets/images/web.svg') }}" alt=""></a>
                    </div>
                </div>
            </div>
            <div class="col-md-5" data-aos="super-slide-left" data-aos-delay="200"><img src="{{ asset('assets/images/right-contact.png') }}" class="img-fluid" alt="Contact"/></div>
        </div>
                
            </div></section>
    
</main>
@endsection
