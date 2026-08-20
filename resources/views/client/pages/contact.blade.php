@extends('client.layouts.master')
@section('title', 'Liên hệ')
@section('content')
<main id="main">

        <section id="banner" class="banner-bgs d-flex align-items-end" style="background-image: url('assets/images/upload/banner/img_68de2f0ed6f42.png')" data-aos="super-zoom-in" data-aos-duration="1200">
            <div class="container">
            <h2>Liên hệ</h2>
            <        </section><div data-aos="super-zoom-in" data-aos-duration="1000">@if(!empty($settings['map_iframe'])){!! $settings['map_iframe'] !!}@else<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14869.83984618334!2d103.94579688090464!3d21.29283412983767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3132f54a6750e6d5%3A0xb634d44a48777b7e!2zWGUgTcOheSAtIFhlIMSQaeG7h24gLSBYZSDEkOG6oXAgTWluaCBDaMOidQ!5e0!3m2!1sen!2s!4v1759391662747!5m2!1sen!2s" height="450" style="border:0; width: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>@endif</div>
        
        @php
            $contactStores = !empty($settings['contact_stores']) ? json_decode($settings['contact_stores'], true) : [];
        @endphp
        
        @if(count($contactStores) > 0)
        <section id="contact-shop" class="mt-5"><div class="container"><h2 class="title-section" data-aos="super-zoom-in">Hệ thống cửa hàng</h2><div class="row d-flex align-items-center justify-content-center mt-5">
            @foreach($contactStores as $index => $store)
            <div class="col-md-6 mb-3" data-aos="super-zoom-in" data-aos-delay="{{ 100 + (($index % 6) * 100) }}">
                <div class="info">
                    <h2 class="title">{{ $store['name'] ?? '' }}</h2>
                    <div class="content">
                        <p>{{ $store['address'] ?? '' }}</p>
                        @if(!empty($store['phone']))
                        <p><a href="tel:{{ str_replace([' ', '.'], '', $store['phone']) }}">{{ $store['phone'] }}</a></p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div></section>
        @endif
        
        <section id="contact">
            <div class="container">
            <div class="row">
	<div class="col-md-7" data-aos="super-slide-right">
                <div id="panel_contact">
                    @if(session('success'))
                        <div class="alert alert-success" style="padding: 15px; margin-bottom: 20px; border: 1px solid transparent; border-radius: 4px; color: #3c763d; background-color: #dff0d8; border-color: #d6e9c6;">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form class="form-horizontal" action="{{ route('contact.submit') }}" name="frmContact" id="frmContact" method="post">
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
                        <a href="{{ $settings['facebook'] ?? '#' }}" target="_blank"><img src="{{ asset('assets/') }}/images/facebook.svg" alt=""></a>
                        <a href="{{ $settings['tiktok'] ?? '#' }}" target="_blank"><img src="{{ asset('assets/') }}/images/tiktok.svg" alt=""></a>
                        <a href="{{ $settings['shopee'] ?? '#' }}" target="_blank"><img src="{{ asset('assets/') }}/images/shopee.svg" alt=""></a>
                        <a href="{{ $settings['website'] ?? '#' }}" target="_blank"><img src="{{ asset('assets/') }}/images/web.svg" alt=""></a>
                    </div>
                </div>
</div>
	<div class="col-md-5" data-aos="super-slide-left" data-aos-delay="200"><img src="{{ asset('assets/') }}/images/right-contact.png" class="img-fluid" alt="Contact"/></div>
</div>
                
            </div></section>
    
</main>
@endsection
