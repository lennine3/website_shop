<div class="col-lg-12 col-md-12 designServiceContain">
    <form id="aboutInfoForm_{{ @$aboutInfo->id }}">
        @csrf
        <div class="designServiceSave">
            <i class="far fa-save designServiceSaveButton" data-id="designServiceInfoId_{{ @$aboutInfo->id }}"
                id="saveAboutInfo"></i>
        </div>
        <input type="text" name="sectionInfo_id" value="{{ @$aboutInfo->id }}" hidden>
        <div class="card card-custom">
            <div class="card-body my-auto">
                <div class="designServiceContain">
                    <div>
                        <label for="webDesignInfoTitle">Tên tiêu đề</label>
                        <input type="text" id="webDesignInfoTitle" value="{{ @$aboutInfo->name }}"
                            class="form-control designServiceInput" name="name">
                    </div>
                    <div class="mt-5">
                        <label for="uiDesignInfoTitle">Tên tiêu đề 2</label>
                        <input type="text" id="uiDesignInfoTitle" value="{{ @$aboutInfo->sub_name }}"
                            class="form-control designServiceInput" name="sub_name">
                    </div>
                    <div class="mt-5">
                        <label for="webDesignInfoDescription">Mô tả</label>
                        <input type="text" id="webDesignInfoDescription" value="{{ @$aboutInfo->description }}"
                            class="form-control designServiceInput" name="description">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

