<div class="card">
    <div class="card-body">
        <div class="mb-4">
            <div class="row">
                <div class="form-group col-lg-4 mb-3">
                    <label for="facebook" class="form-label">@lang('setting::setting.social.facebook')</label>
                    <input type="text" class="form-control" id="facebook" name="SOCIAL[facebook]"
                        value="{{ @$social['facebook'] }}">
                </div>
                <div class="form-group col-lg-4 mb-3">
                    <label for="instagram" class="form-label">@lang('setting::setting.social.instagram')</label>
                    <input type="text" class="form-control" id="instagram" name="SOCIAL[instagram]"
                        value="{{ @$social['instagram'] }}">
                </div>
                <div class="form-group col-lg-4 mb-3">
                    <label for="zalo" class="form-label">@lang('setting::setting.social.zalo')</label>
                    <input type="text" class="form-control" id="zalo" name="SOCIAL[zalo]"
                        value="{{ @$social['zalo'] }}">
                </div>
            </div>

        </div>
    </div>
</div>
