<div class="card">
    <div class="card-header">
        Tải hình ảnh
    </div>
    <div class="card-body">
        <form id="productDropzone" action="{{ route('product.dropzone.process') }}" method="POST"
            enctype="multipart/form-data" class="dropzone" hidden>
            @csrf
            <input type="text" value="{{ @$product->id }}" name="product_id">
        </form>
        <button id="chooseButton" class="btn btn-primary">Chọn hình ảnh</button>
        <button id="productImageSubmitForm" style="display: none"
            class="btn btn-info _effect--ripple waves-effect waves-light">Tải tất cả</button>
        <button id="removeAllButton" class="btn btn-danger" style="display: none">Xóa tất cả</button>
        <div id="productPreviewTemplate">
            <div hidden>
                <div id="myPreviewTemplate">
                    <div class="d-flex justify-content-between dropzone-items">
                        <div style="overflow: auto">
                            <div class="dz-filename"><span data-dz-name></span></div>
                        </div>
                        <div class="dropzone-progress">
                            <div class="dz-progress"><span class="dz-upload progress"
                                    data-dz-uploadprogress></span>
                            </div>
                        </div>
                        <div>
                            <i data-feather="x" class="remove-button" data-dz-remove></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
