<nav class="headerMobile" id="headerMobile">
    <div class="logoHeaderMobile">
        <a href="#"> <img src="{{ asset('web/assets/image/logo/headerLogo.svg') }}" alt=""></a>
    </div>
    <div>

    </div>
    <div class="menuMobile">
        <div class="hamburger" id="hamburger">
            <div class="lineMobile"></div>
            <div class="lineMobile"></div>
            <div class="lineMobile"></div>
        </div>
        <ul id="menuMobile">
            <li><a href="/#aboutUsSection">Về chúng tôi</a></li>
            <li><a href="/#homeMarketingSection">Dịch vụ Marketing</a></li>
            <li><a href="/#pricingTableSetion">Bảng giá dịch vụ</a></li>
            <li><a href="/#blogMarketing">Blog Marketing</a></li>
            {{-- <li><a href="/#formContactSection">Liên hệ</a></li> --}}
            <li><a href="tel:{{ $generals['SHOP']['phone'] }}" class="btn headerContactBtn">Gọi nhanh:
                    {{ $generals['SHOP']['phone'] }}</a></li>
        </ul>
    </div>
</nav>
