@extends('client.layouts.master')
@section('title', $product->name)

@push('styles')
<link rel="stylesheet" href="{{ asset('assets/css/detail.css?v=1.0') }}" />
@endpush

@section('content')
<main id="main">

        <section id="banner" class="banner-bgs d-flex align-items-end" style="background-image: url('{{ asset('assets/images/bg-banner-in.png') }}')" data-aos="super-zoom-in" data-aos-duration="1200">
            <div class="container">
                <div class="content" style="right: 10%;">
                     <h3>Sản phẩm</h3><h2>{{ $product->name }}</h2>
                </div>
            </div>
       </section>
                <section id="panel-products-details" class="detail mt-5">
				<div class="container">
				<div class="row mt-5 gy-4">
                <div class="col-md-6" data-aos="super-slide-right">
                    <div id="imgdt">
                        <img id="main-product-image" src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="max-width: 55%; height: auto; margin: 0 auto; display: block;"/>
                    </div>
                    @if($product->gallery && count($product->gallery) > 0)
                    <div class="product-gallery mt-3 d-flex justify-content-center" style="gap: 10px;">
                        @foreach($product->gallery as $galleryImg)
                            <div class="gallery-thumb" style="width: 60px; height: 60px; cursor: pointer; border: 2px solid #ddd; border-radius: 4px; overflow: hidden;" onmouseover="this.style.borderColor='#8b5cf6'" onmouseout="this.style.borderColor='#ddd'" onclick="document.getElementById('main-product-image').src = this.querySelector('img').src">
                                <img src="{{ asset($galleryImg) }}" alt="Thumb" class="img-fluid w-100 h-100" style="object-fit: cover;" />
                            </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                <div class="col-md-6 mt-3 mt-lg-0" data-aos="super-slide-left" data-aos-delay="200">
                    <h2 class="title">{{ $product->name }}</h2>
                    <div class="desc">{!! $product->description !!}</div></div>
            </div></div></section>

            @if($product->use_1 || $product->use_2 || $product->use_3)
            <section id="pro-uses" class="mt-5">
            <div class="container">
               <h2 class="title-header">Công dụng</h2>
                <div class="row d-flex align-items-center justify-content-center mt-5 gy-4">
                    @if($product->use_1)
                    <div class="col-6 col-lg-4 text-center mt-3 mt-lg-0" data-aos="super-zoom-in" data-aos-delay="100">
                        <div class="box-uses">
                            <div class="img"><img src="{{ asset('assets/') }}/images/usage-1.png" alt=""/></div>
                            <div class="content">{{ $product->use_1 }}</div>
                        </div>
                    </div>
                    @endif
                    @if($product->use_2)
                    <div class="col-6 col-lg-4 text-center mt-3 mt-lg-0" data-aos="super-zoom-in" data-aos-delay="200">
                        <div class="box-uses">
                            <div class="img"><img src="{{ asset('assets/') }}/images/usage-2.png" alt=""/></div>
                            <div class="content">{{ $product->use_2 }}</div>
                        </div>
                    </div>
                    @endif
                    @if($product->use_3)
                    <div class="col-6 col-lg-4 text-center mt-3 mt-lg-0" data-aos="super-zoom-in" data-aos-delay="300">
                        <div class="box-uses">
                            <div class="img"><img src="{{ asset('assets/') }}/images/usage-3.png" alt=""/></div>
                            <div class="content">{{ $product->use_3 }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            </section>
            @endif

            @if($product->usage_guide)
            <section id="pro-guide" class="mt-5 mb-5">
                <div class="container">
                    <div class="row d-flex align-items-center justify-content-center gy-4">
                        <div class="col-md-6" data-aos="super-slide-right">
                            <div class="info">
                                <h2 class="title">Hướng dẫn sử dụng</h2>
                                <div class="content">
                                    <p>{!! nl2br(e($product->usage_guide)) !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" data-aos="super-slide-left" data-aos-delay="200">
                            <div class="img"><img src="{{ asset('assets/') }}/images/upload/post/img_68de0603897c6.jpg" alt="Hướng dẫn sử dụng" class="img-fluid"/></div>
                        </div>
                    </div>
                </div>
            </section>
            @endif

            <div id="panel-pro-cus">
                @if($product->notice || $product->preservation)
                <section id="pro-notice" class="mt-5">
                    <div class="container">
                        <div class="row d-flex align-items-center justify-content-center gy-4">
                            <div class="col-md-6" data-aos="super-slide-right">
                                <div class="img"><img src="{{ asset('assets/') }}/images/upload/post/img_68de064c1b7a5.jpg" alt="Lưu ý" class="img-fluid"/></div>
                            </div>
                            <div class="col-md-6" data-aos="super-slide-left" data-aos-delay="200">
                                <div class="info">
                                    <div class="content">
                                        @if($product->notice)
                                            <h4>Lưu ý</h4>
                                            <p>{!! nl2br(e($product->notice)) !!}</p>
                                        @endif
                                        @if($product->preservation)
                                            <h4>Bảo quản</h4>
                                            <p>{!! nl2br(e($product->preservation)) !!}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                @endif
            </div>

            <style>
                .rating input, 
                .rating label, 
                .rating i,
                .rating input:focus,
                .rating input:active,
                .rating label:focus,
                .rating label:active,
                .form-check-input,
                .form-check-input:focus {
                    outline: none !important;
                    box-shadow: none !important;
                    -webkit-tap-highlight-color: transparent !important;
                }
            </style>
            <section id="pro-rate" class="mt-5" data-aos="super-fade-up"><div class="container"><h2 class="title-section">ĐÁNH GIÁ</h2>
            <div id="list-rate" class="mb-4">
                @if(isset($reviews) && $reviews->count() > 0)
                     <div class="reviews-list mt-3">
                        @foreach($reviews as $review)
                        <div class="review-item d-flex mb-4 pb-4" style="border-bottom: 1px solid #eee;">
                            <div class="review-avatar mr-3" style="width: 50px; height: 50px; flex-shrink: 0;">
                                <div style="width: 100%; height: 100%; background: #f0f2f5; color: #666; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 18px; font-weight: bold;">
                                    {{ strtoupper(substr($review->fullname, 0, 1)) }}
                                </div>
                            </div>
                            <div class="review-content" style="flex-grow: 1; padding-left: 15px;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <h5 class="mb-0" style="font-size: 1.1rem; font-weight: 600;">{{ $review->fullname }}</h5>
                                    <span class="text-muted" style="font-size: 0.85rem;">{{ $review->created_at->format('d/m/Y') }}</span>
                                </div>
                                <div class="mb-2 text-warning" style="font-size: 0.9rem;">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $review->rating)
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-star-o" aria-hidden="true" style="color: #ccc;"></i>
                                        @endif
                                    @endfor
                                </div>
                                <div class="review-text" style="color: #444; line-height: 1.6;">
                                    {{ $review->note }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-light text-center py-4" style="background: #f8f9fa; border: 1px dashed #ddd;">
                        Chưa có đánh giá nào. Hãy là người đầu tiên đánh giá sản phẩm này!
                    </div>
                @endif
            </div>
            
            <form class="ajaxform" action="{{ route('product.review.submit') }}" name="frmrate" id="frmrate" method="post">
                @csrf
 <input type="hidden" name="product_id" value="{{ $product->id }}" />
@if(!isset($reviews) || $reviews->count() == 0)
<div class="title">Hãy là người đầu tiên nhận xét “{{ $product->name }}”</div>
@endif

    <div class="form-group required">
    <label class="label">Đánh giá của bạn *</label>
     <div class="rating" role="radiogroup" aria-label="Chọn số sao">
        <input type="radio" id="star5" name="rating" value="5" />
        <label for="star5" title="5 sao"><i class="fa fa-star" aria-hidden="true"></i></label>
    
        <input type="radio" id="star4" name="rating" value="4" />
        <label for="star4" title="4 sao"><i class="fa fa-star" aria-hidden="true"></i></label>
    
        <input type="radio" id="star3" name="rating" value="3" />
        <label for="star3" title="3 sao"><i class="fa fa-star" aria-hidden="true"></i></label>
    
        <input type="radio" id="star2" name="rating" value="2" />
        <label for="star2" title="2 sao"><i class="fa fa-star" aria-hidden="true"></i></label>
    
        <input type="radio" id="star1" name="rating" value="1" />
        <label for="star1" title="1 sao"><i class="fa fa-star" aria-hidden="true"></i></label>
    </div>
    <span class="rating-value" id="ratingValue">Chưa chọn</span>
    </div>
    
    <div class="form-group required mt-3">
       <label class="label">Nhận xét của bạn *</label>
	    <textarea name="note" placeholder="Nhập nhận xét..." class="form-control" rows="5" /></textarea>
</div>
	
<div class="row mt-3 gy-3">
	<div class="col-md-6">
	<div class="form-group required">
	 <label class="label">Tên *</label>
           <input type="text" name="fullname" value="" placeholder="Full name" class="form-control" maxlength="256"  />
	</div>
</div>
	<div class="col-md-6">
	<div class="form-group required">
	 <label class="label">Email *</label>
          <input type="text" name="email" value="" placeholder="Email" class="form-control" maxlength="256"  />
    </div>
</div>
</div>
<div class="form-check mt-3">
  <input class="form-check-input" type="checkbox" value="1" id="saveReviewInfo" name="saveReviewInfo">
  <label class="label form-check-label" for="saveReviewInfo">
   Lưu tên của tôi và email trong trình duyệt này cho lần bình luận kế tiếp của tôi.
  </label>
</div>

<div class="mt-4">
<button type="submit" id="btn-send" name="btn-send" >Gửi đi</button>
</div>
</form></div></section></div>
                <section id="related-pro" class="related-pro mt-5" data-aos="super-fade-up">
            <div class="container">
                 <header class="section-header d-flex align-items-center justify-content-between" data-aos="super-zoom-in">
                      <h2>Sản phẩm khác</h2>
                      <div><a href="{{ route('products') }}" class="btn-themes">Tất cả sản phẩm <img src="{{ asset('assets/') }}/images/right-arrow.svg" /></a></div>
                  </header>
  
                  <div class="position-relative mt-5">
                      <div class="swiper homeproSwiper">
                          <div class="swiper-wrapper">
                          @if(isset($relatedProducts) && $relatedProducts->count() > 0)
                              @foreach($relatedProducts as $related)
                              <div class="swiper-slide">
                                  <div class="box-item">
                                <a href="{{ route('product.detail', $related->slug) }}"><div class="img"><img src="{{ asset($related->image) }}" alt="{{ $related->name }}" class="img-fluid"/></div>
                                    <div class="info">
                                        <h4 class="title text-truncate">{{ $related->name }}</h4>
                                        <div class="desc"><p>{{ $related->short_description }}</p></div>
                                        <div class="btn-themes">Xem thêm <img src="{{ asset('assets/') }}/images/right-arrow.svg" alt=""/></div>
                                    </div>
                                </a>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <!-- Placeholder nếu không có sản phẩm liên quan từ DB -->
                            <div class="swiper-slide">
                                <p>Đang cập nhật...</p>
                            </div>
                        @endif
                        </div>
                    </div>
                    <style>
                        .position-relative .swiper-button-next-01,
                        .position-relative .swiper-button-prev-01 {
                            opacity: 0;
                            visibility: hidden;
                            transition: all 0.3s ease;
                        }
                        
                        .position-relative:hover .swiper-button-next-01:not(.swiper-button-disabled),
                        .position-relative:hover .swiper-button-prev-01:not(.swiper-button-disabled) {
                            opacity: 1;
                            visibility: visible;
                        }
                    </style>
                    <div class="swiper-button-next-01 shadow-sm"><i class="fa-regular fa-arrow-right"></i></div>
                    <div class="swiper-button-prev-01 shadow-sm"><i class="fa-regular fa-arrow-left"></i></div>
                </div>
            </div>
        </section><section id="contact">
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
            <div class="col-md-5" data-aos="super-slide-left" data-aos-delay="200"><img src="{{ asset('assets/images/right-contact.png') }}" class="img-fluid" alt="Contact"/></div>
        </div>
                
            </div></section>
    
</main>

@push('scripts')
<script type="text/javascript" src="{{ asset('assets/js/pages/products-detail.js?v=1.0') }}"></script>
@endpush

@endsection
