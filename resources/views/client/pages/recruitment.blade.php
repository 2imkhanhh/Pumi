@extends('client.layouts.master')
@section('title', 'Tuyển dụng')
@section('content')
<main id="main">

        <section id="banner" class="banner-bgs d-flex align-items-end" style="background-image: url('assets/images/upload/banner/img_68dde2e81b6f1.png')" data-aos="super-zoom-in" data-aos-duration="1200">
            <div class="container">
            <h2>Tuyển dụng</h2>
            </div>
       </section><section id="news" class="news">
       <div class="container"><div id="news-list" class="news-list row gy-4 mt-4">
            @forelse($recruitments as $post)
             <div class="col-xl-3 col-md-6 col-12" data-aos="super-fade-up" data-aos-delay="{{ 100 * (($loop->index % 4) + 1) }}">
              <a href="{{ route('recruitment.detail', $post->slug) }}">
                    <div class="inner">
                        <article>
                            <div class="imgbox">
                                <img src="{{ $post->image ? asset($post->image) : asset('assets/images/no-image.jpg') }}" alt="{{ $post->title }}"/>
                            </div>
                            <div class="date">Pumi  |   {{ $post->published_at ? \Carbon\Carbon::parse($post->published_at)->format('d.m.y') : '' }}</div>
                            <h2 class="title">{{ $post->title }}</h2>
                            <div class="desc">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 120) }}</div>
                        </article>
                    </div>
                    </a>
                </div><!-- End item -->
            @empty
                <div class="col-12 text-center py-4">
                    <p>Hiện chưa có thông tin tuyển dụng nào.</p>
                </div>
            @endforelse
            </div>
            
            <div class="mt-4">
                {{ $recruitments->links('pagination::bootstrap-5') }}
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
