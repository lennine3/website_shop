@extends('layouts.layout')
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/light/elements/custom-tree_view.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dark/elements/custom-tree_view.css') }}">
@endsection
@section('content')
    <div class="middle-content container-xxl p-0">
        <div class="row layout-top-spacing">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header">
                        @lang('blog::blog.list.header')
                    </div>
                    <div class="card-body">
                        @foreach ($categories as $category)
                            <ul class="treeview" id="treeviewBasicMainChild_{{ $category->id }}">
                                <li class="tv-item tv-folder">
                                    <div class="tv-header" id="mainChildHeadingOne">
                                        <div class="tv-collapsible">
                                            <div data-bs-toggle="collapse" data-bs-target="#mainChild_{{ $category->id }}"
                                                aria-expanded="true" aria-controls="mainChild_{{ $category->id }}">
                                                <div class="icon">
                                                    <i data-feather="chevron-right"
                                                        class="icon icon-tabler icon-tabler-chevron-right"></i>
                                                </div>
                                            </div>
                                            <p class="title">
                                                <a class="statusTreeView {{ $category->status == 'A' ? 'statusTreeViewActive' : 'statusTreeViewDisActive' }}"
                                                    href="{{ route('product.category.edit',['product_cate'=>$category->id]) }}">
                                                    {{ $category->title }}
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    @if ($category->allDescendants()->count() > 0)
                                        <div id="mainChild_{{ $category->id }}" class="treeview-collapse collapse"
                                            aria-labelledby="mainChildHeadingOne"
                                            data-bs-parent="#treeviewBasicMainChild_{{ $category->id }}">
                                            @include('product::cate_product.treeview', [
                                                'categories' => $category->allDescendants,
                                            ])
                                        </div>
                                    @endif

                                </li>
                            </ul>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
