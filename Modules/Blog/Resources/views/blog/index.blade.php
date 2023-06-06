@extends('layouts.layout')
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/light/elements/custom-pagination.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dark/elements/custom-pagination.css') }}">
    <style>
        .form-control,
        .form-select {
            padding: 8px 10px !important;
        }
    </style>
@endsection
@section('content')
    <div class="middle-content container-xxl p-0">
        <div class="breadcrumb-wrapper-content  mt-3 layout-top-spacing">
            <form action="{{ route('blog.search') }}" method="GET">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <input id="t-text" type="text" name="title" placeholder="title" class="form-control"
                            value="{{ @$filters['title'] }}">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <select name="category" id="" class="form-select">
                            <option value="">Tất cả danh mục</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item->id }}"
                                    {{ @$filters['blog_category_id'] == $item->id ? 'selected' : '' }}>{{ $item->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <select name="status" id="" class="form-select">
                            <option value="">-- Chọn trạng thái --</option>
                            <option value="A" {{ @$filters['status'] == 'A' ? 'selected' : '' }}>@lang('product::product.product.status.A')
                            </option>
                            <option value="D" {{ @$filters['status'] == 'D' ? 'selected' : '' }}>@lang('product::product.product.status.D')
                            </option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3">
                        <button class="btn btn-primary w-100">Tìm kiếm</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row mt-3">
            @foreach ($blogList as $item)
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a href="{{ route('blog.edit', ['blog' => $item->id]) }}" class="card style-2 mb-md-0 mb-4">
                        <img src="{{ @$item->image ? asset(config('blog.image.path') . $item->id . '/' . $item->image) : asset('admin/assets/img/no-image.jpeg') }}"
                            class="card-img-top" alt="...">
                        <div class="card-body px-0 pb-0">
                            <h5 class="card-title mb-3">{{ $item->title }}</h5>
                            <div class="media mt-4 mb-0 pt-1">
                                <img src="{{ $item->user->avatar != null ? asset(config('user.image.path') . $item->user->id . '/' . $item->user->avatar) : asset('admin/assets/img/blank.png') }}"
                                    class="card-media-image me-3" alt="" style="object-fit: cover">
                                <div class="media-body">
                                    <h4 class="media-heading mb-1">{{ $item->user->name }}</h4>
                                    <p class="media-text">
                                        {{ Carbon\Carbon::parse($item->created_at)->toFormattedDateString() }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                @include('blog::blogCategory.pagination')
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
