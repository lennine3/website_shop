<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <div class="d-flex justify-content-start">
                <div class="position-relative">
                    <div class="position-absolute labelIcon">
                        <div class="logo-box">
                            <label for="shopLogo"
                                class="btn btn-xs btn-icon-logo btn-circle btn-white btn-hover-text-primary btn-shadow">
                                <i data-feather="edit"></i>
                            </label>
                            <input type="file" id="shopLogo" hidden name="image">
                        </div>
                    </div>
                    <div class="logoImgContain">
                        {{-- <img src="{{ asset('admin/assets/img/blank.png') }}" alt=""> --}}
                        <img src="{{ $logo }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <p>Favicon</p>
            <div class="d-flex justify-content-start">
                <div class="position-relative">
                    <div class="position-absolute labelIcon">
                        <div class="logo-box">
                            <label for="shopFavicon"
                                class="btn btn-xs btn-icon-logo btn-circle btn-white btn-hover-text-primary btn-shadow">
                                <i data-feather="edit"></i>
                            </label>
                            <input type="file" id="shopFavicon" hidden name="favicon">
                        </div>
                    </div>
                    <div class="favIconContain">
                        <img src="{{ show_favicon('favicon.ico') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="form-group mb-3">
                <label for="websiteName" class="form-label">@lang('setting::setting.info.name')</label>
                <input type="text" class="form-control" id="websiteName" name="SHOP[web_name]"
                    value="{{ @$shop['web_name'] }}">
            </div>
            <div class="form-group mb-3">
                <label for="workingTime" class="form-label">@lang('setting::setting.info.working_time')</label>
                <input class="form-control" type="text" name="SHOP[working_time]" id="workingTime"
                    value="{{ @$shop['working_time'] }}">
            </div>
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input class="form-control" type="email" name="SHOP[email]" id="email"
                    value="{{ @$shop['email'] }}">
            </div>
            <div class="form-group mb-3">
                <label for="business_name" class="form-label">@lang('setting::setting.info.license_name')</label>
                <input class="form-control" type="text" name="SHOP[business_name]" id="business_name"
                    value="{{ @$shop['business_name'] }}">
            </div>
            <div class="form-group mb-3">
                <label for="phone" class="form-label">@lang('setting::setting.info.phone')</label>
                <input class="form-control" type="text" name="SHOP[phone]" id="phone"
                    value="{{ @$shop['phone'] }}">
            </div>
            <div class="form-group mb-3">
                <label for="address" class="form-label">@lang('setting::setting.info.address')</label>
                <input class="form-control" type="text" name="SHOP[address]" id="address"
                    value="{{ @$shop['address'] }}">
            </div>
            <div class="form-group mb-3">
                <label for="gg_maps" class="form-label">@lang('setting::setting.info.embed_google_map')</label>
                <textarea type="text" cols="30" rows="5" class="form-control" id="gg_maps" name="SHOP[gg_maps]">{{ @$shop['gg_maps'] }}</textarea>
            </div>
            <div class="form-group mb-3">
                <label for="footer_text" class="form-label">@lang('setting::setting.info.footer_text')</label>
                <textarea type="text" cols="30" rows="5" class="form-control" id="footer_text" name="SHOP[footer_text]">{{ @$shop['footer_text'] }}</textarea>
            </div>
        </div>
    </div>
</div>
