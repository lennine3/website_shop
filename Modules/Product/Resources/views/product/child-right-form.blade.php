<div class="card">
    <div class="card-header">
        Thêm/Sửa Sản phẩm con
    </div>
    <div class="card-body">
        <input type="text" value="{{ @$showScript ? @$product->id : @$product->childId }}" name="product_child_id" hidden>
        <div class="row">
            <div class="col-lg-12 mb-3">
                <label for="product_code" class="form-label">@lang('product::product.product.product_code')<span class="text-danger">(*)</span></label>
                <input type="text" class="form-control" id="product_code" name="product_code"
                    value="{{ @$product->product_code }}" required>
            </div>
            <div class="col-lg-12 mb-3">
                <label for="childName" class="form-label">Tên sản phẩm</label>
                <input type="text" class="form-control" id="childName" name="name" required
                    value="{{ @$product->name }}">
            </div>
            <input type="text" id="featureChildCount" value="{{ $features->count() }}" hidden>
            @foreach ($features as $index => $feature)
                <div class="col-lg-12 mb-3">
                    <label class="form-label">{{ $feature->name }}</label>
                    <select name="feature[]" id="feature-child-select_{{ $index }}">
                        <option value="0">Không có dữ liệu</option>
                        @foreach ($feature->children as $item)
                            <option value="{{ $item->id }}"
                                {{ $product->features->contains('id', $item->id) ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endforeach
            <div class="col-lg-12">
                <label for="slug" class="form-label">Giá nhập/ Giá bán</label>
            </div>
            <div class="input-group col-lg-12 mb-3">
                <span class="input-group-text"><i data-feather="clipboard"></i></span>
                <input id="child_org_price" type="text" name="org_price" class="form-control" placeholder="Giá  nhập"
                    aria-label="Giá nhập" value="{{ $product->org_price }}">
                <span class="input-group-text"><i data-feather="clipboard"></i></span>
                <input id="child_sell_price" type="text" name="sell_price" class="form-control"
                    value="{{ $product->sell_price }}" placeholder="Giá bán" aria-label="Giá bán">
            </div>
            <div class="col-lg-12 mb-3">
                <label for="qty" class="form-label">@lang('product::product.product.quantity')</label>
                <input type="number" class="form-control" id="qty" name="qty" value="{{ @$product->qty }}">
            </div>
            <div class="col-lg-12 mb-3">
                <label for="status-select" class="form-label">
                    @lang('product::product.product.status.header')
                </label>
                <select id="child-status-select" name="status" placeholder="Select your parent" autocomplete="off">
                    <option value="A" {{ @$product->status == 'A' ? 'selected' : '' }}>
                        @lang('product::product.product.status.A')
                    </option>
                    <option value="D" {{ @$product->status == 'D' ? 'selected' : '' }}>
                        @lang('product::product.product.status.D')
                    </option>
                </select>
            </div>
            <div class="col-xxl-12 col-sm-4 col-12 mx-auto">
                <button class="btn btn-success w-100 _effect--ripple waves-effect waves-light"
                    id="productChildSubmitForm">Save</button>
            </div>
        </div>
    </div>
</div>

@if (@$showScript)
    {{-- feather icon --}}
    <script src="{{ asset('admin/plugins/src/font-icons/feather/feather.min.js') }}"></script>
    <script>
        feather.replace()
        var countFeature = $("#featureChildCount").val();
        for (let index = 0; index < countFeature; index++) {
            new TomSelect("#feature-child-select_" + index, {});
        }
        new
        TomSelect("#child-status-select", {});

        // Ajax
        $(document).ready(function() {
            $('#productChildSubmitForm').click(function(e) {
                e.preventDefault(); // prevent default form submission

                var form_data = new FormData($('#productChildForm')[0]); // get form data

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/admin/product/child/process',
                    type: 'POST',
                    data: form_data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        toastr.success(response.message);
                        $('#childList').html(response.html);
                    },
                    error: function(xhr, status, error) {
                        // handle error response here
                    }
                });
            });
        });
    </script>
@endif
