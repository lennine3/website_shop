<footer class="footer">
    <div class="container">
        <div class="d-flex justify-content-between FooterLogoSection footerLogoContain">
            <div class="d-flex align-items-center">
                <div class="footerLogo">
                    <img src="{{ asset('web/assets/image/logo/footerLogo.svg') }}" alt="">
                </div>
            </div>
            <div class="socialLogoMobile">
                <div class="footerDescText"> Theo dõi chúng tôi tại </div>
                <div class="d-flex justify-content-end socialContain">
                    <div>
                        <a href="{{ @$generals['SOCIAL']['facebook'] }}" class="socialTextFooter"><img
                                src="{{ asset('web/assets/image/logo/face.svg') }}" alt=""></a>
                    </div>
                    <div class="socialIconBox">
                        <a href="{{ @$generals['SOCIAL']['instagram'] }}" class="socialTextFooter"><img
                                src="{{ asset('web/assets/image/logo/insta.svg') }}" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div>
                    <div class="footerDescText"><b>{{ @$generals['SHOP']['web_name'] }}</b></div>
                    <div class="footerDescText"><b>Thời gian làm việc:</b> {{ @$generals['SHOP']['working_time'] }}</div>
                    <div class="footerDescText"><b>Chăm sóc khách hàng:</b> <a class="footerDescText"
                            href="tel:{{ @$generals['SHOP']['phone'] }}"> {{ @$generals['SHOP']['phone'] }}</a></div>
                    <div class="footerDescText"><b>Email:</b> {{ $generals['SHOP']['email'] }} </div>
                </div>
                {{-- <div class="socialLogoMobile">
                    <div class="footerDescText footerWebDesign"> Dịch vụ thiết kế website </div>
                    <div>
                        <img src="{{ asset('web/assets/image/logo/footerWeb.png') }}" alt="">
                    </div>
                </div> --}}
            </div>
            <div class="col-lg-6 col-md-6 ourPartnerContainMobile socialInfoBox">
                <div class="LeftInfo">
                    <div class="socialTextAlign">
                        <div class="footerDescText"> Theo dõi chúng tôi tại </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-6">
                                <a href="{{ @$generals['SOCIAL']['facebook'] }}" class="socialTextFooter">Facebook</a>
                            </div>
                            <div class="col-lg-6 col-md-6 col-6">
                                <a href="{{ @$generals['SOCIAL']['instagram'] }}"
                                    class="socialTextFooter">Instagram</a>
                            </div>
                        </div>
                        {{-- <div class="footerDescText footerWebDesign"> Dịch vụ thiết kế website </div>
                        <div>
                            <img src="{{ asset('web/assets/image/logo/footerWeb.png') }}" alt="">
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copyRight">
    <div class="d-flex justify-content-center">
        {{ $generals['SHOP']['coppyright'] }}
    </div>
</div>
