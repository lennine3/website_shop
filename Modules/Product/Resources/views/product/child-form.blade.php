<form id="productChildForm" action="#" method="POST">
    @csrf
    <input type="text" value="{{ @$product->id }}" name="product_parent_id" hidden>
    <div class="row layout-top-spacing">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    @lang('product::product.product.child.list')
                </div>
                <div class="card-body">
                    <div class="row">
                        <div id="childList">
                            @include('product::product.child-left-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div id="childForm">
                @include('product::product.child-right-form')
            </div>
        </div>
    </div>
</form>
