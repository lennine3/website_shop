@if ($productList->hasPages())
    <div class="col-lg-12">
        <div class="paginating-container pagination-solid justify-content-end">
            <ul class="pagination">
                @if (!$productList->onFirstPage())
                    <li class="prev paginateBox"><a href="{{ $productList->previousPageUrl() }}" rel="prev">
                            <i class="fa-solid fa-chevrons-left"></i>
                        </a></li>
                @endif

                @if ($productList->currentPage() > 3)
                    <li class="paginateBox"><a href="{{ $productList->url(1) }}">
                            1
                        </a></li>
                @endif
                @if ($productList->currentPage() > 4)
                    <li class="paginateBox">
                        <a href="javascript:void(0);">...</a>
                    </li>
                @endif
                @foreach (range(1, $productList->lastPage()) as $i)
                    @if ($i >= $productList->currentPage() - 2 && $i <= $productList->currentPage() + 2)
                        @if ($i == $productList->currentPage())
                            <li class="active paginateBox">
                                <a href="javascript:void(0);">{{ $i }}</a>
                            </li>
                        @else
                            <li class="paginateBox"><a href="{{ $productList->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endif
                @endforeach
                @if ($productList->currentPage() < $productList->lastPage() - 3)
                    <li class="paginateBox"><a href="javascript:void(0);">...</a></li>
                @endif
                @if ($productList->currentPage() < $productList->lastPage() - 2)
                    <li class="paginateBox"><a
                            href="{{ $productList->url($productList->lastPage()) }}">{{ $productList->lastPage() }}</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($productList->hasMorePages())
                    <li class="next paginateBox"><a href="{{ $productList->nextPageUrl() }}"><i
                                class="fa-solid fa-chevrons-right"></i></a></li>
                @endif
            </ul>
        </div>
    </div>
@endif
