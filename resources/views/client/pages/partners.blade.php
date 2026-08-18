@extends('client.layouts.master')
@section('title', 'Đối tác - Pumi Việt Nam')
@section('content')
<main id="main">

        <section id="banner" class="banner-bgs d-flex align-items-end" style="background-image: url('{{ asset($settings['partners_banner'] ?? 'assets/images/upload/banner/img_68de36354dbd9.png') }}')" data-aos="super-zoom-in" data-aos-duration="1200">
            <div class="container">
                <h2>Đối tác</h2>
            </div>
        </section>

        <section id="partners-page">
            <div class="container">
                <div id="panel_partner">
                    <header class="section-header swidth text-center mt-4">
                        <h2>{{ $settings['partners_ingredient_title'] ?? 'Đối tác nguyên liệu' }}</h2>
                        <div class="desc"></div>
                    </header>
                    
                    @foreach($ingredientPartners as $partner)
                    <div class="row {{ $loop->first ? 'mt-2' : 'mt-5' }} d-flex justify-content-center align-items-center">
                        <div class="col-md-6 order-1 {{ $loop->iteration % 2 == 0 ? 'order-lg-0' : 'order-lg-1' }}" data-aos="{{ $loop->iteration % 2 == 0 ? 'super-slide-right' : 'super-slide-left' }}" data-aos-delay="200">
                            <div class="w-100">
                                 <h2 class="title">{{ $partner['name'] ?? '' }}</h2>
                                 <div class="text">
                                     {!! nl2br(e($partner['description'] ?? '')) !!}
                                 </div>
                            </div>
                        </div>
                        <div class="col-md-6 order-0 {{ $loop->iteration % 2 == 0 ? 'order-lg-1' : 'order-lg-0' }}" data-aos="{{ $loop->iteration % 2 == 0 ? 'super-slide-left' : 'super-slide-right' }}">
                            <div class="img_st">
                                <img src="{{ isset($partner['img']) ? asset($partner['img']) : '' }}" alt="{{ $partner['name'] ?? 'Partner' }}" class="img-fluid"/>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div id="panel_partner">
                    <header class="section-header swidth text-center" data-aos="super-zoom-in">
                        <h2>{{ $settings['partners_hospital_title'] ?? 'Đối tác bệnh viện' }}</h2>
                        <div class="desc">
                            {!! $settings['partners_hospital_desc'] ?? 'hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum...' !!}
                        </div>
                    </header>
                    <div class="d-flex flex-wrap justify-content-center w-100">
                        @foreach($hospitalPartners as $partner)
                            <div class="img" data-aos="super-zoom-in" data-aos-delay="{{ 50 * ($loop->iteration % 6) }}">
                                <div class="inner">
                                    <img src="{{ isset($partner['img']) ? asset($partner['img']) : '' }}" alt="Hospital Partner" class="img-fluid"/>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div id="panel_partner">
                    <header class="section-header swidth text-center" data-aos="super-zoom-in">
                        <h2>{{ $settings['partners_media_title'] ?? 'Đối tác truyền thông' }}</h2>
                        <div class="desc">
                            {!! $settings['partners_media_desc'] ?? 'hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum...' !!}
                        </div>
                    </header>
                    <div class="d-flex flex-wrap justify-content-center w-100">
                        @foreach($mediaPartners as $partner)
                            <div class="img" data-aos="super-zoom-in" data-aos-delay="{{ 50 * ($loop->iteration % 6) }}">
                                <div class="inner">
                                    <img src="{{ isset($partner['img']) ? asset($partner['img']) : '' }}" alt="Media Partner" class="img-fluid"/>
                                </div>
                            </div>
                        @endforeach
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
                                <a href="{{ $settings['tiktok'] ?? '#' }}" target="_blank"><img src="{{ asset('assets/images/tiktok.svg') }}" alt=""></a>
                                <a href="{{ $settings['instagram'] ?? '#' }}" target="_blank"><img src="{{ asset('assets/images/instagram.svg') }}" alt=""></a>
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
