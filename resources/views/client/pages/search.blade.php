@extends('client.layouts.master')
@section('title', 'Chi tiết')
@section('content')
<main id="main">

        <section id="banner" class="banner-bgs d-flex align-items-end" style="background-image: url('assets/images/upload/banner/img_68ddde15169dd.png')">
            <div class="container">
            <h2>Tìm kiếm sản phẩm</h2>
            </div>
       </section>
       <section id="search-hero">
            <div class="container">
                <form id="searchForm" class="search-form-big" role="search" onsubmit="return false;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="searchInput" placeholder="Nhập tên sản phẩm, ví dụ: nước tắm thảo dược, dung dịch vệ sinh..." autocomplete="off" autofocus>
                    <button type="button" id="searchClear" class="search-clear" aria-label="Xoá từ khoá"><i class="fa-solid fa-xmark"></i></button>
                </form>
                <div class="search-tags" id="searchTags">
                    <button type="button" class="tag-chip active" data-cat="all">Tất cả</button>
                    <button type="button" class="tag-chip" data-cat="Nước tắm thảo dược">Nước tắm thảo dược</button>
                    <button type="button" class="tag-chip" data-cat="Dung dịch vệ sinh cho bé">Dung dịch vệ sinh cho bé</button>
                    <button type="button" class="tag-chip" data-cat="Nước giặt thảo mộc">Nước giặt thảo mộc</button>
                </div>
            </div>
       </section>
       <section id="search-results" class="mt-4 mb-5">
            <div class="container">
                <div id="searchStatus" class="search-status"></div>
                <div id="searchGrid" class="row" data-aos="fade-up"></div>
                <div id="searchEmpty" class="search-empty d-none">
                    <img src="{{ asset('assets/') }}/images/search.svg" alt="">
                    <h3>Không tìm thấy sản phẩm phù hợp</h3>
                    <p>Hãy thử từ khoá khác hoặc xem toàn bộ sản phẩm của Pumi.</p>
                    <a href="san-pham.html" class="btn-themes">Xem tất cả sản phẩm <img src="{{ asset('assets/') }}/images/right-arrow.svg" /></a>
                </div>
            </div>
       </section>
    
</main>
<script>
    window.PRODUCTS_DATA = @json($products);
</script>
@endsection
