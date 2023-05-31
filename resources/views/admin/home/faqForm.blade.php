<div class="col-lg-12 col-md-12 designServiceContain">
    <form id="faqForm_submit">
        @csrf
        <div class="card">
            <div class="card-header">
                Câu hỏi thường gặp form
            </div>
            <div class="card-body my-auto">
                <div class="designServiceContain">
                    <div>
                        <label for="benefitTtile">Tên tiêu đề</label>
                        <input type="text" id="benefitTtile" value="" class="form-control designServiceInput"
                            name="title">
                    </div>
                    <div class="mt-5">
                        <label for="benefitDescription">Mô tả</label>
                        <input type="text" id="benefitDescription" value=""
                            class="form-control designServiceInput" name="content">
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-5">
                    <button class="btn-banner-save">Lưu thông tin</button>
                </div>
            </div>
        </div>
    </form>
</div>

