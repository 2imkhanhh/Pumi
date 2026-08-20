<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'PUMI - Khởi nguồn từ yêu thương')</title>
    
    <meta name="description" content="@yield('meta_description', 'Mang trong mình sứ mệnh tạo ra những sản phẩm chất lượng từ những nguồn nguyên liệu dược liệu quý của Việt Nam.')" />
    <meta name="keywords" content="@yield('meta_keywords', 'dung dịch vệ sinh cho bé, nước tắm thảo dược, nước giặt thảo mộc')" />
    
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:title" content="@yield('title', 'PUMI - Khởi nguồn từ yêu thương')"/>
    <meta property="og:description" content="@yield('meta_description', 'Mang trong mình sứ mệnh tạo ra những sản phẩm chất lượng từ những nguồn nguyên liệu dược liệu quý của Việt Nam.')"/>
    <meta property="og:image" content="{{ asset('assets/images/thumbs.png') }}"/>
    <meta property="og:site_name" content="PUMI - Khởi nguồn từ yêu thương" />
    <link rel="canonical" href="{{ url()->current() }}" />
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png?v=1.0') }}">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/jquery-ui/jquery-ui.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/sweetalert2/sweetalert2.min.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor/aos/aos.css') }}">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@400..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/css.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme.css?v=1.1') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/theme-refined.css?v=1.2') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/timepicker/jquery.timepicker.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" />
    
    @stack('styles')
</head>
<body id="@yield('body_id', 'home-page')">
<div id="page" class="@yield('page_class', 'home')">
    
    @include('client.layouts.header')

    <main id="main">
        @yield('content')
    </main>

    @include('client.layouts.footer')
    
</div>

<script type="text/javascript">
    var is_mobile = false;
    var page_name = "@yield('page_name', 'index')";
</script>
<script type="text/javascript" src="{{ asset('assets/js/jquery-3.6.1.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/popper.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/sweetalert2/sweetalert2.all.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/loading.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/functions.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/main.js?v=1.1') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/nav.js?v=1.1') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/swiper/swiper-element-bundle.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendor/timepicker/jquery.timepicker.min.js') }}"></script>

@stack('scripts')

</body>
</html>
