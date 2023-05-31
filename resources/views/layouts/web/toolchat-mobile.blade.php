<div class="toolchat-mobile" id="toolChatMobile">
    <div class="toolChatCall">
        <a href="tel:{{ @$generals['SHOP']['phone'] }}" class="supportText" style="color:#ffffff">
            Bấm để gọi: {{ @$generals['SHOP']['phone'] }}
        </a>
    </div>
    <div class="toolChatZalo">
        <div class="position-relative">
            <div class="notiToolChat bounce2">
                <div class="round-comment">
                    <div class="d-flex">
                        <div>
                            Chào bạn
                        </div>
                        <div style="padding-left:10px">
                            <img src="{{ asset('web/assets/image/logo/support.svg') }}" alt="support logo"
                                height="14" width="16">
                        </div>
                    </div>trò chuyện ngay
                </div>
            </div>
            <a href="{{ @$generals['SOCIAL']['zalo'] }}" target="_blank" rel="nofollow">
                <img src="{{ asset('web/assets/image/logo/zaloLogo.svg') }}" alt="zalo icon" height="30"
                    width="72">
            </a>
        </div>
    </div>
</div>
