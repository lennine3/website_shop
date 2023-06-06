@if ($productList->hasPages())
    <div class="col-lg-12">
        <div class="paginating-container pagination-solid justify-content-end">
            <ul class="pagination">
                @if (!$productList->onFirstPage())
                    <li class="prev"><a href="{{ $productList->previousPageUrl() }}" rel="prev">Prev</a></li>
                @endif

                @if ($productList->currentPage() > 3)
                    <li><a href="{{ $productList->url(1) }}">
                            <div>1</div>
                        </a></li>
                @endif
                @if ($productList->currentPage() > 4)
                    <li>
                        <div class="padContainText"><a href="javascript:void(0);">...</a></div>
                    </li>
                @endif
                @foreach (range(1, $productList->lastPage()) as $i)
                    @if ($i >= $productList->currentPage() - 2 && $i <= $productList->currentPage() + 2)
                        @if ($i == $productList->currentPage())
                            <li class="active">
                                <a href="javascript:void(0);">{{ $i }}</a>
                            </li>
                        @else
                            <li><a href="{{ $productList->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endif
                @endforeach
                @if ($productList->currentPage() < $productList->lastPage() - 3)
                    <li><a href="javascript:void(0);">...</a></li>
                @endif
                @if ($productList->currentPage() < $productList->lastPage() - 2)
                    <li><a href="{{ $productList->url($productList->lastPage()) }}">{{ $productList->lastPage() }}</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($productList->hasMorePages())
                    <li class="next"><a href="{{ $productList->nextPageUrl() }}">Next</a></li>
                @endif
            </ul>
        </div>
    </div>
    <ul class="pagination pagination justify-content-center">
        {{-- Previous Page Link --}}





    </ul>
@endif
