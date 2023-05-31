<div class="form">
    <form method="POST" id="pricigTableSubmit">
        {{-- @csrf --}}
        <input type="text" value="{{ @$pricingTableData->id }}" hidden name="pricing_id">
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group mb-3">
                    <label for="titlePricing" class="form-label">Tên tiều đề</label>
                    <input type="text" class="form-control" name="title" id="titlePricing"
                        value="{{ @$pricingTableData->title }}">
                </div>
                <div class="form-group mb-3">
                    <label for="pricePricing" class="form-label">Giá tiền</label>
                    <input type="text" class="form-control" name="price" id="pricePricing"
                        value="{{ @$pricingTableData->price }}">
                </div>
                <div class="form-group mb-3">
                    <label for="notePricing" class="form-label">Ghi chú</label>
                    <input type="text" class="form-control" name="note" id="notePricing"
                        value="{{ @$pricingTableData->note }}">
                </div>
                <div class="form-group mb-3">
                    <label for="saleNote" class="form-label">Ghi chú khuyến mãi</label>
                    <input type="text" class="form-control" name="saleNote" id="saleNote"
                        value="{{ @$pricingTableData->saleNote }}">
                </div>
                <div class="form-group mb-3">
                    <label for="otherNotePricing" class="form-label">Note khác 1</label>
                    <input type="text" class="form-control" name="otherNote" id="otherNotePricing"
                        value="{{ @$pricingTableData->otherNote }}">
                </div>
                <div class="form-group mb-3">
                    <label for="otherNote_1" class="form-label">Note khác 2</label>
                    <input type="text" class="form-control" name="otherNote_1" id="otherNote_1"
                        value="{{ @$pricingTableData->otherNote_1 }}">
                </div>
                <input type="text" id="func_count" hidden
                    value="{{ @$pricingTableData->pricing_func ? count(json_decode(@$pricingTableData->pricing_func)->pricing_func) : 0 }}">
                @if (@$pricingTableData)
                    @php
                        $funcData = json_decode($pricingTableData->pricing_func);
                        $countData = 1;
                    @endphp
                    @foreach ($funcData->pricing_func as $data)
                        <div class="col-lg-12 mt-3">
                            <div class="form-group">
                                <label for="description_${{ $countData }}" class="form-label">quyền lợi
                                    {{ $countData++ }}</label>
                                <input type="text" class="form-control" name="pricing_func[]"
                                    id="description_${{ $countData }}" value="{{ $data }}">
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-lg-12 mb-3">
                <div id="description-fields"></div>
            </div>
        </div>
        <div class="text-center mb-3">
            <div><i id="add-description" data-feather="plus-circle"></i></div>
        </div>

        <div class="text-center">
            <!-- other form fields -->
            <button type="submit" class="btn btn-primary" id="pricignTableSubmit">Create Pricing Plan</button>
        </div>
    </form>
</div>
