@extends('client.layouts.master')
@section('title', 'Liên hệ')
@section('content')
<main id="main">

        <section id="banner" class="banner-bgs d-flex align-items-end" style="background-image: url('assets/images/upload/banner/img_68de2f0ed6f42.png')">
            <div class="container">
            <h2>Liên hệ</h2>
            </div>
       </section><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14869.83984618334!2d103.94579688090464!3d21.29283412983767!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3132f54a6750e6d5%3A0xb634d44a48777b7e!2zWGUgTcOheSAtIFhlIMSQaeG7h24gLSBYZSDEkOG6oXAgTWluaCBDaMOidQ!5e0!3m2!1sen!2s!4v1759391662747!5m2!1sen!2s" height="450" style="border:0; width: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe><section id="contact-shop" class="mt-5"><div class="container"><h2 class="title-section">Hệ thống cửa hàng</h2><div class="row d-flex align-items-center justify-content-center mt-5">  <div class="col-md-6 mb-3">
                        <div class="info">
                            <h2 class="title">Pumi 1</h2>
                            <div class="content"><p>309a Lê Duẩn, Tổ 1, Phường Chiềng Sinh, Thành phố Sơn La.</p><p><a href="tel:0986127635">0986 127 635</a></p></div>
                        </div>
                    </div>  <div class="col-md-6 mb-3">
                        <div class="info">
                            <h2 class="title">Pumi 2</h2>
                            <div class="content"><p>309a Lê Duẩn, Tổ 1, Phường Chiềng Sinh, Thành phố Sơn La.</p><p><a href="tel:0986127635">0986 127 635</a></p></div>
                        </div>
                    </div>  <div class="col-md-6 mb-3">
                        <div class="info">
                            <h2 class="title">Pumi 3</h2>
                            <div class="content"><p>309a Lê Duẩn, Tổ 1, Phường Chiềng Sinh, Thành phố Sơn La.</p><p><a href="tel:0986127635">0986 127 635</a></p></div>
                        </div>
                    </div>  <div class="col-md-6 mb-3">
                        <div class="info">
                            <h2 class="title">Pumi 4</h2>
                            <div class="content"><p>309a Lê Duẩn, Tổ 1, Phường Chiềng Sinh, Thành phố Sơn La.</p><p><a href="tel:0986127635">0986 127 635</a></p></div>
                        </div>
                    </div>  <div class="col-md-6 mb-3">
                        <div class="info">
                            <h2 class="title">Pumi 5</h2>
                            <div class="content"><p>309a Lê Duẩn, Tổ 1, Phường Chiềng Sinh, Thành phố Sơn La.</p><p><a href="tel:0986127635">0986 127 635</a></p></div>
                        </div>
                    </div>  <div class="col-md-6 mb-3">
                        <div class="info">
                            <h2 class="title">Pumi 6</h2>
                            <div class="content"><p>309a Lê Duẩn, Tổ 1, Phường Chiềng Sinh, Thành phố Sơn La.</p><p><a href="tel:0986127635">0986 127 635</a></p></div>
                        </div>
                    </div></div></section><section id="contact">
            <div class="container">
            <div class="row">
	<div class="col-md-7">
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
                        <a href="{{ $settings['instagram'] ?? '#' }}" target="_blank"><img src="{{ asset('assets/') }}/images/instagram.svg" alt=""></a>
                        <a href="{{ $settings['website'] ?? '#' }}" target="_blank"><img src="{{ asset('assets/') }}/images/web.svg" alt=""></a>
                    </div>
                </div>
</div>
	<div class="col-md-5"><img src="{{ asset('assets/') }}/images/right-contact.png" class="img-fluid" alt="Contact"/></div>
</div>
                
            </div></section>
    
</main>
@endsection
