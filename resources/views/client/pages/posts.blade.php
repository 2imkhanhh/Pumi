@extends('client.layouts.master')
@section('title', 'Tin tức')
@section('content')
    <main id="main">

        <section id="banner" class="banner-bgs d-flex align-items-end"
            style="background-image: url('assets/images/upload/banner/img_68dde2e81b6f1.png')" data-aos="super-zoom-in" data-aos-duration="1200">
            <div class="container">
                <h2>Tin tức</h2>
            </div>
        </section>
        <section id="news" class="news">
            <div class="container">
                <!-- Category Filter -->
                <div class="post-categories-filter mb-4" data-aos="fade-up">
                    <a href="{{ route('posts') }}" class="category-pill {{ !request()->has('category') ? 'active' : '' }}">Tất cả</a>
                    @foreach($categories as $category)
                        <a href="{{ route('posts', ['category' => $category->slug]) }}" class="category-pill {{ request()->query('category') == $category->slug ? 'active' : '' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>

                <div id="news-list" class="news-list row gy-4 mt-4">
                    @foreach ($posts as $post)
                        <div class="col-xl-3 col-md-6 col-12" data-aos="super-fade-up" data-aos-delay="{{ 100 * (($loop->index % 4) + 1) }}">
                            <a href="{{ route('post.detail', $post->slug) }}">
                                <div class="inner">
                                     <article>
                                        <div class="imgbox">
                                            <img src="{{ asset($post->image) }}"
                                                alt="{{ $post->title }}" />
                                        </div>
                                        <div class="date">Pumi |
                                            {{ \Carbon\Carbon::parse($post->published_at)->format('d.m.y') }}</div>
                                        <h2 class="title">{{ $post->title }}</h2>
                                        <div class="desc">{{ Str::limit(strip_tags($post->excerpt), 120) }}</div>
                                     </article>
                                </div>
                            </a>
                        </div><!-- End item -->
                    @endforeach
                </div>

                <div class="mt-4 d-flex justify-content-center">
                    {{ $posts->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </section>
        <section id="contact">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-md-7" data-aos="super-slide-right">
                        <div id="panel_contact">
                            <form class="form-horizontal ajaxform" action="{{ route('contact.submit') }}"
                                name="frmContact" id="frmContact" method="post">
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
                    <div class="col-md-5" data-aos="super-slide-left" data-aos-delay="200"><img src="{{ asset('assets/images/right-contact.png') }}" class="img-fluid"
                            alt="Contact" /></div>
                </div>

            </div>
        </section>

    </main>
@endsection
