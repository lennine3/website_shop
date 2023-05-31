<a href="{{ route('admin.edit.pricing-table', ['pricingTableData' => @$item->id]) }}">
    <div class="pricingTable">
        <div class="pricingHeadingContainer">
            <div class="pricingTableHeading">
                <h3 class="pricingTableTitle"> {{ @$item->title }} </h3>
            </div>
            <div class="pricingTablePrice"> <span class="pricingTablePriceValueTitle"> Gói:
                </span> <span class="pricingTablePriceValue"> {{ @$item->price }} đ </span> </div>
            <div class="text-center" style="font-size:14px"> {{ @$item->note }} </div>
        </div>
        <div class="pricingSaleContain">
            <div class="pricingSaleText"> {{ @$item->saleNote }} </div>
        </div>
        <div class="pricingTableFeatures" id="pricingTableFeatures_0">
            <div>
                <ul class="pricingList">
                    <li>{{ @$item->otherNote }}</li>
                    @if (@$item->otherNote_1)
                        <li>{{ @$item->otherNote_1 }}</li>
                    @endif
                </ul>
                <hr class="pricingHr">
                <div class="pricingTitle"> Mô tả gói: </div>
                <ul class="pricingList">
                    @php
                        $funcData = json_decode($item->pricing_func);
                    @endphp
                    @foreach ($funcData->pricing_func as $data)
                        <li>{{ $data }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</a>
