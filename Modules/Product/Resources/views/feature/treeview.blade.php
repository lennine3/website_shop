<ul class="treeview" id="treeviewBasicCSSChild">
    @foreach ($categories as $category)
        @if ($loop->parent->last||$category->allDescendants()->count() == 0)
            <li class="tv-item ">
                <p class="title">
                    <a class="statusTreeView {{ $category->status == 'A' ? 'statusTreeViewActive' : 'statusTreeViewDisActive' }}"
                        href="{{ route('product.feature.edit', ['feature' => $category->id]) }}">
                        {{ $category->name }}
                    </a>
                </p>
            </li>
        @else
            <li class="tv-item tv-folder">
                <div class="tv-header" id="cssChildHeadingOne">
                    <div class="tv-collapsible">
                        <div data-bs-toggle="collapse" data-bs-target="#cssChild_{{ $category->id }}"
                            aria-expanded="false" aria-controls="cssChild_{{ $category->id }}">
                            <div class="icon">
                                <i data-feather="chevron-right" class="icon icon-tabler icon-tabler-chevron-right"></i>
                            </div>
                        </div>
                        <p class="title">
                            <a class="statusTreeView {{ $category->status == 'A' ? 'statusTreeViewActive' : 'statusTreeViewDisActive' }}"
                                href="{{ route('product.feature.edit', ['feature' => $category->id]) }}">
                                {{ $category->name }}
                            </a>
                        </p>
                    </div>
                </div>
                <div id="cssChild_{{ $category->id }}" class="treeview-collapse collapse">
                    @if ($category->allDescendants()->count() > 0)
                        @include('product::feature.treeview', [
                            'categories' => $category->allDescendants,
                        ])
                    @endif
                </div>
            </li>
        @endif
    @endforeach
</ul>
