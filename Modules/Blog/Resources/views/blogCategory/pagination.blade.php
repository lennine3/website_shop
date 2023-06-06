@if ($blogList->hasPages())
    <div class="col-lg-12">
        <div class="paginating-container pagination-solid justify-content-end">
            <ul class="pagination">
                @if (!$blogList->onFirstPage())
                    <li class="prev"><a href="{{ $blogList->previousPageUrl() }}" rel="prev">Prev</a></li>
                @endif

                @if ($blogList->currentPage() > 3)
                    <li><a href="{{ $blogList->url(1) }}">
                            <div>1</div>
                        </a></li>
                @endif
                @if ($blogList->currentPage() > 4)
                    <li>
                        <div class="padContainText"><a href="javascript:void(0);">...</a></div>
                    </li>
                @endif
                @foreach (range(1, $blogList->lastPage()) as $i)
                    @if ($i >= $blogList->currentPage() - 2 && $i <= $blogList->currentPage() + 2)
                        @if ($i == $blogList->currentPage())
                            <li class="active">
                                <a href="javascript:void(0);">{{ $i }}</a>
                            </li>
                        @else
                            <li><a href="{{ $blogList->url($i) }}">{{ $i }}</a></li>
                        @endif
                    @endif
                @endforeach
                @if ($blogList->currentPage() < $blogList->lastPage() - 3)
                    <li><a href="javascript:void(0);">...</a></li>
                @endif
                @if ($blogList->currentPage() < $blogList->lastPage() - 2)
                    <li><a href="{{ $blogList->url($blogList->lastPage()) }}">{{ $blogList->lastPage() }}</a>
                    </li>
                @endif

                {{-- Next Page Link --}}
                @if ($blogList->hasMorePages())
                    <li class="next"><a href="{{ $blogList->nextPageUrl() }}">Next</a></li>
                @endif
            </ul>
        </div>
    </div>
    <ul class="pagination pagination justify-content-center">
        {{-- Previous Page Link --}}





    </ul>
@endif
