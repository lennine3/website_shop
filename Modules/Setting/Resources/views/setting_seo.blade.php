<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12 mb-3">
                <label for="seoTitle" class="form-label">Seo title</label>
                <input type="text" class="form-control" id="seoTitle" name="SHOP[seo_title]"
                    value="{{ @$shop['seo_title'] }}">
            </div>
            <div class="col-lg-12 mb-3">
                <label for="seoKeyword" class="form-label">Seo keyword</label>
                <input type="text" class="form-control" id="seoKeyword" name="SHOP[seo_keyword]"
                    value="{{ @$shop['seo_keyword'] }}">
            </div>
            <div class="col-lg-12 mb-3">
                <label for="seoDescription" class="form-label">Seo
                    description</label>
                <textarea type="text" cols="30" rows="10" class="form-control" id="seoDescription"
                    name="SHOP[seo_description]">{{ @$shop['seo_description'] }}</textarea>
            </div>
            <div class="col-lg-12 mb-3">
                <label for="coordinates" class="form-label">@lang('setting::setting.info.coordinate')</label>
                <input type="text" class="form-control" id="coordinates" name="SHOP[coordinates]"
                    value="{{ @$shop['coordinates'] }}">
            </div>
            <div class="col-lg-12 mb-3">
                <label for="Coppyright" class="form-label">Coppyright</label>
                <input type="text" class="form-control" id="Coppyright" name="SHOP[coppyright]"
                    value="{{ @$shop['coppyright'] }}">
            </div>
        </div>

    </div>
</div>
