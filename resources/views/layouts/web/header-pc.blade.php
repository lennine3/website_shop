<header class="headerPc">
    <nav class="container">
        <div class="d-flex justify-content-between">
            <div class="logoContain">
                <div class="logoBox">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('web/assets/image/logo/headerLogo.svg') }}" alt="">
                    </a>
                </div>
            </div>
            <ul>
                <li><a href="/#aboutUsSection">Về chúng tôi</a></li>
                <li><a href="/#homeMarketingSection">Dịch vụ marketing</a></li>
                <li>
                    <a href="/#pricingTableSetion">Bảng giá dịch vụ</a>
                </li>
                <li><a href="/#blogMarketing">Blog marketing</a></li>
                {{-- <li><a href="/#formContactSection">Liên hệ</a></li> --}}
            </ul>
            <div class="btnContain">
                <a href="tel:{{ $generals['SHOP']['phone'] }}" class="btn headerContactBtn">Gọi nhanh:
                    {{ $generals['SHOP']['phone'] }}</a>
            </div>
        </div>

    </nav>
</header>
