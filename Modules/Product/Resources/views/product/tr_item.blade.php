@foreach ($product->images as $index => $image)
    <tr id="{{ $image->id }}" class="table_tr" data-row-id="{{ $image->id }}">
        <td class="pl-0 py-4">
            <input type="hidden" name="image_ids[]" value="{{ $image->id }}">
            <div class="tableProductImage">
                <img src="{{ asset(config('product.image.product_path') . $product->id . '/' . $image->image_path) }}"
                    alt="" style="object-fit: cover">
            </div>
        </td>
        <td>({{ $image->image_width }}px x {{ $image->image_height }}px)</td>
        <td><i data-feather="trash" id="delete-button"></i></td>
    </tr>
@endforeach
@if (@$showScript)
    {{-- feather icon --}}
    <script src="{{ asset('admin/plugins/src/font-icons/feather/feather.min.js') }}"></script>
    <script>
        feather.replace()
    </script>
@endif
