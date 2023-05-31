@foreach ($product->children as $item)
    <div class="col-lg-12">
        <div class="productChildContainer" onclick="updateChildProduct({{ $item->id }})">
            <div style="padding: 10px">
                <div>
                    <span class="productChildText">
                        Product Id: {{ $item->id }}
                    </span>
                    <span class="text-danger">(Qty: {{ $item->qty }})</span>
                </div>
                <div class="fw-bolder py-2 py-lg-2 mr-5">
                    <span class="text-primary mr-3">{{ $item->org_price }}
                        /{{ $item->sell_price }}</span> <span
                        class="statusProduct {{ $item->status == 'A' ? 'statusProductActive' : 'statusProductDisActive' }}">
                        @if ($item->status == 'A')
                            @lang('product::product.product.status.A')
                        @else
                            @lang('product::product.product.status.D')
                        @endif
                    </span>
                </div>
                <div class="fw-bolder productChildText">
                    {{ $item->name }}
                </div>
            </div>

        </div>
    </div>
@endforeach
