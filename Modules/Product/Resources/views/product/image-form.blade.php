<input type="text" value="{{ @$product->id }}" name="product_parent_id" hidden>
<div class="row layout-top-spacing">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-header">
                @lang('product::product.product.image.list')
            </div>
            <div class="card-body">
                <div class="row">
                    @include('product::product.image-left-list')
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        @include('product::product.image-right-form')
    </div>
</div>
