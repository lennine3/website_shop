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
    <div class="layout-px-spacing">
        <div class="middle-content container-xxl p-0">
            <div class="breadcrumb-wrapper-content  mt-3 layout-top-spacing">
                <form action="{{ route('product.search') }}" method="GET">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <input id="t-text" type="text" name="title" placeholder="Name" class="form-control"
                                value="{{ @$filters['name'] }}">
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-3">
                            <select name="category" id="" class="form-select">
                                <option value="">Tất cả danh mục</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}"
                                        {{ @$filters['category_ids'] == $item->id ? 'selected' : '' }}>{{ $item->title }}
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
                @foreach ($productList as $product)
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                        <a class="card style-6" href="{{ route('product.edit', ['product' => $product->id]) }}">
                            <span class="badge badge-danger"></span>
                            <img src="{{ isset($product->images[0]) ? asset(config('product.image.product_path') . $product->id . '/' . $product->images[0]->image_path) : asset('admin/assets/img/no-image.jpeg') }}"
                                class="card-img-top" alt="...">
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-12 mb-1">
                                        <b>{{ $product->name }}</b>
                                    </div>
                                    <div class="col-12">
                                        <b class="text-muted">{{ @$product->category->title }}</b>
                                    </div>
                                    <div class="col-9">
                                        <div class="pricing">
                                            <p class="text-success mb-0">{{ number_format($product->sell_price) }} /
                                                {{ number_format($product->sell_price) }}</p>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <span
                                            class="{{ $product->status == 'A' ? 'badge badge-success' : 'badge badge-danger' }}">
                                            @lang('product::product.feature.status' . '.' . $product->status)
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
                <div class="col-lg-12">
                    @include('product::product.pagination')
                </div>
            </div>

        </div>

    </div>
@endsection

@section('script')
@endsection
