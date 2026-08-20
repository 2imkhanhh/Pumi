@extends('client.layouts.master')
@section('title', 'Sản phẩm')
@section('content')
<main id="main">

        <section id="banner" class="banner-bgs d-flex align-items-end" style="background-image: url('assets/images/upload/banner/img_68ddde15169dd.png')" data-aos="super-zoom-in" data-aos-duration="1200">
            <div class="container">
            <h2>Sản phẩm</h2>
            </div>
       </section><section id="panel-products" class="bg-pagein mt-5 mb-5"><div class="container"> <div id="pro-list"><div class="row">
           @foreach($products as $product)
           <div class="col-6 col-md-4 col-lg-3" data-aos="super-zoom-in" data-aos-delay="{{ 100 * (($loop->index % 4) + 1) }}">
            <div class="box-item">
            <a href="{{ route('product.detail', $product->slug) }}"><div class="img"><img src="{{ asset($product->image) }}" alt="{{ $product->name }}"/></div>
                <div class="info">
                    <h4 class="title text-truncate">{{ $product->name }}</h4>
                    <div class="desc"><p>{{ $product->short_description }}</p></div>
                    <div class="btn-themes">Xem thêm <img src="{{ asset('assets/') }}/images/right-arrow.svg" alt=""/></div>
                </div>
                </a>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="mt-4 d-flex justify-content-center">
            {{ $products->links('pagination::bootstrap-5') }}
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
            <div class="col-md-5" data-aos="super-slide-left" data-aos-delay="200"><img src="{{ asset('assets/images/right-contact.png') }}" class="img-fluid" alt="Contact"/></div>
        </div>
                
            </div></section>
    
</main>
@endsection
