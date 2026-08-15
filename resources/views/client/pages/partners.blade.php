@extends('client.layouts.master')
@section('title', 'Đối tác - Pumi Việt Nam')
@section('content')
<main id="main">

        <section id="banner" class="banner-bgs d-flex align-items-end" style="background-image: url('{{ asset($settings['partners_banner'] ?? 'assets/images/upload/banner/img_68de36354dbd9.png') }}')">
            <div class="container">
                <h2>Đối tác</h2>
            </div>
        </section>

        <section id="partners-page">
            <div class="container">
                <div id="panel_partner">
                    <header class="section-header swidth text-center">
                        <h2>{{ $settings['partners_ingredient_title'] ?? 'Đối tác nguyên liệu' }}</h2>
                        <div class="desc"></div>
                    </header>
                    
                    <div class="row mt-5 d-flex justify-content-center align-items-center">
                        <div class="col-md-6 order-1 order-lg-1">
                            <div class="w-100">
                                 <h2 class="title">{{ $settings['partners_ingredient_1_title'] ?? 'Đối tác ABC' }}</h2>
                                 <div class="text">
                                     {!! $settings['partners_ingredient_1_content'] ?? '<p>hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>' !!}
                                 </div>
                            </div>
                        </div>
                        <div class="col-md-6 order-0 order-lg-0">
                            <div class="img_st">
                                <img src="{{ asset($settings['partners_ingredient_1_image'] ?? 'assets/images/upload/document/img_68de34175aa5b.jpg') }}" alt="{{ $settings['partners_ingredient_1_title'] ?? 'Đối tác ABC' }}" class="img-fluid"/>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5 d-flex justify-content-center align-items-center">
                        <div class="col-md-6 order-1 order-lg-0">
                            <div class="w-100">
                                 <h2 class="title">{{ $settings['partners_ingredient_2_title'] ?? 'Đối tác ABC' }}</h2>
                                 <div class="text">
                                     {!! $settings['partners_ingredient_2_content'] ?? '<p>hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>' !!}
                                 </div>
                            </div>
                        </div>
                        <div class="col-md-6 order-0 order-lg-1">
                            <div class="img_st">
                                <img src="{{ asset($settings['partners_ingredient_2_image'] ?? 'assets/images/upload/document/img_68de342d7222d.jpg') }}" alt="{{ $settings['partners_ingredient_2_title'] ?? 'Đối tác ABC' }}" class="img-fluid"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="panel_partner">
                    <header class="section-header swidth text-center">
                        <h2>{{ $settings['partners_hospital_title'] ?? 'Đối tác bệnh viện' }}</h2>
                        <div class="desc">
                            {!! $settings['partners_hospital_desc'] ?? 'hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum...' !!}
                        </div>
                    </header>
                    @foreach($partners as $partner)
                        <div class="img">
                            <div class="inner">
                                <img src="{{ asset($partner->image) }}" alt="{{ $partner->name ?? 'Hospital Partner' }}" class="img-fluid"/>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div id="panel_partner">
                    <header class="section-header swidth text-center">
                        <h2>{{ $settings['partners_media_title'] ?? 'Đối tác truyền thông' }}</h2>
                        <div class="desc">
                            {!! $settings['partners_media_desc'] ?? 'hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum...' !!}
                        </div>
                    </header>
                    @foreach($partners as $partner)
                        <div class="img">
                            <div class="inner">
                                <img src="{{ asset($partner->image) }}" alt="{{ $partner->name ?? 'Media Partner' }}" class="img-fluid"/>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
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
                    <div class="col-md-5">
                        <img src="{{ asset('assets/images/right-contact.png') }}" class="img-fluid" alt="Contact"/>
                    </div>
                </div>
            </div>
        </section>
    
</main>
@endsection
