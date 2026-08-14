<header id="header" class="sticky-top">
    <div id="pnmenu">
        <div class="container text-center">
            <div class="d-flex align-items-center justify-content-between">
                <div><a class="logo" href="{{ url('/') }}"><img src="{{ asset($settings['logo'] ?? 'assets/images/upload/banner/img_68da82f29e290.png') }}"></a></div>
                <div class="d-flex align-items-center justify-content-center">
                    <div>
                        <span id="icon-menu"><i class="mobile-nav-toggle d-xl-none bi bi-list"></i></span>
                        <nav id="navmenu" class="navmenu d-flex justify-content-center">
                            <ul>
                                <li><a href="{{ url('/') }}" {!! request()->is('/') ? 'class="active"' : '' !!}>Trang chủ</a></li>
                                <li class="dropdown has-dropdown"><a href="{{ url('/ve-pumi') }}" {!! request()->is('ve-pumi*') || request()->is('doi-tac*') ? 'class="active"' : '' !!}><span>Về Pumi</span> <i class="bi bi-chevron-down"></i></a>
                                    <ul class="dd-box-shadow">
                                        <li><a href="{{ url('/ve-pumi') }}">Về Pumi</a></li>
                                        <li><a href="{{ url('/doi-tac') }}">Đối tác</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ url('/san-pham') }}" {!! request()->is('san-pham*') ? 'class="active"' : '' !!}>Sản phẩm</a></li>
                                <li class="dropdown has-dropdown"><a href="{{ url('/tin-tuc') }}" {!! request()->is('tin-tuc*') || request()->is('tuyen-dung*') ? 'class="active"' : '' !!}><span>Tin tức</span> <i class="bi bi-chevron-down"></i></a>
                                    <ul class="dd-box-shadow">
                                        <li><a href="{{ url('/tin-tuc') }}">Tin tức</a></li>
                                        <li><a href="{{ url('/tuyen-dung') }}">Tuyển dụng</a></li>
                                    </ul>
                                </li>
                                <li><a href="{{ url('/lien-he') }}" {!! request()->is('lien-he*') ? 'class="active"' : '' !!}>Liên hệ</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="d-none d-md-block ms-3"><a href="{{ route('search') }}" aria-label="Tìm kiếm sản phẩm"><img src="{{ asset('assets/images/search.svg') }}" class="mx-2"></a></div>
                </div>
            </div>
        </div>
    </div>
</header>
