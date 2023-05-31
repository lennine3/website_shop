<div class="col-lg-12 col-md-12 designServiceContain">
    <form id="serviceWebDesignInfoForm_{{ @$webDesignInfo->id }}">
        @csrf
        <div class="designServiceSave">
            <i class="far fa-save designServiceSaveButton" data-id="designServiceInfoId_{{ @$webDesignInfo->id }}"
                id="saveWebDesignInfo"></i>
        </div>
        <input type="text" name="sectionInfo_id" value="{{ @$webDesignInfo->id }}" hidden>
        <div class="card card-custom">
            <div class="card-body my-auto">
                <div class="designServiceContain">
                    <div>
                        <label for="webDesignInfoTitle">Tên tiêu đề</label>
                        <input type="text" id="webDesignInfoTitle" value="{{ @$webDesignInfo->name }}"
                            class="form-control designServiceInput" name="name">
                    </div>
                    <div class="mt-5">
                        <label for="uiDesignInfoTitle">Tên tiêu đề 2</label>
                        <input type="text" id="uiDesignInfoTitle" value="{{ @$webDesignInfo->sub_name }}"
                            class="form-control designServiceInput" name="sub_name">
                    </div>
                    <div class="mt-5">
                        <label for="webDesignInfoDescription">Mô tả</label>
                        <input type="text" id="webDesignInfoDescription" value="{{ @$webDesignInfo->description }}"
                            class="form-control designServiceInput" name="description">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

