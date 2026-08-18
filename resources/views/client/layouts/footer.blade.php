<footer id="footer">
    <div class="container">
        <div id="footer_text">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div id="blogo"><a href="{{ url('/') }}"><img src="{{ asset($settings['footer_logo'] ?? 'assets/images/blogo.png') }}" alt=""/></a></div>
                    <h4 id="company">{{ $settings['company_name'] ?? 'PUMI VIỆT NAM - TỰ HÀO TINH HOA THẢO MỘC VIỆT' }}</h4>
                    <div id="address">{{ $settings['address'] ?? '309a Lê Duẩn, Tổ 1, Phường Chiềng Sinh, Thành phố Sơn La.' }}</div>
                </div>
                <div class="col-12 col-md-4 mt-4 mt-md-0">
                    <h4 class="title">Liên hệ</h4>
                    <ul>
                        <li><a target="_blank" href="tel:{{ str_replace('.', '', $settings['phone'] ?? '0986127635') }}"><i class="fa-solid fa-phone"></i> {{ $settings['phone'] ?? '0986.127.635' }}</a></li>
                        <li><a class="text-truncate" href="mailto:{{ $settings['email'] ?? 'congtycophanpumivietnam@gmail.com' }}"><i class="fa-solid fa-envelope"></i> {{ $settings['email'] ?? 'congtycophanpumivietnam@gmail.com' }}</a></li>
                        <li><a target="_blank" href="https://{{ $settings['website'] ?? 'pumi.vn' }}"><i class="fa-solid fa-globe"></i> {{ $settings['website'] ?? 'www.pumi.vn' }}</a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-2 mt-4 mt-md-0">
                    <h4 class="title">Về chúng tôi</h4>
                    <ul id="bmenu">
                        <li><a href="{{ url('/ve-pumi') }}">Giới thiệu</a></li>
                        <li><a href="{{ url('/san-pham') }}">Sản phẩm</a></li>
                        <li><a href="{{ url('/doi-tac') }}">Đối tác</a></li>
                        <li><a href="{{ url('/tin-tuc') }}">Tin Tức</a></li>
                        <li><a href="{{ url('/lien-he') }}">Liên hệ</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
