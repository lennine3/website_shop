<div class="table-responsive">
    <table id="tbl_product_images" class="table table-borderless table-vertical-center">
        <thead>
            <tr class="text-muted">
                <th style="min-width: 100px">
                    Ảnh
                </th>
                <th style="min-width: 300px">Tên /Kích thước</th>
                <th style="min-width: 100px"></th>
            </tr>
        </thead>
        <tbody class="drag-body ui-sortable ui-droppable" id="tr_body">
            @include('product::product.tr_item')
        </tbody>
    </table>
</div>
