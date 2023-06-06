@extends('layouts.layout')

@section('style')
    {{-- dropzone js --}}
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    {{-- Tom select --}}
    <link rel="stylesheet" href="{{ asset('admin/plugins/src/tomSelect/tom-select.default.min.css') }}">
    {{-- dark theme --}}
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/dark/tomSelect/custom-tomSelect.css') }}">
    {{-- light theme --}}
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/light/tomSelect/custom-tomSelect.css') }}">
    {{-- sweet alert --}}
    <link rel="stylesheet" href="{{ asset('admin/plugins/src/sweetalerts2/sweetalerts2.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/category.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/product.css') }}">
@endsection

@section('content')
    <div class="middle-content container-xxl p-0">
        @if (@$product)
            <div class="breadcrumb-wrapper-content  mt-3 layout-top-spacing">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills" id="animateLine" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active d-flex align-items-center" id="form-tab"
                                    data-bs-toggle="tab" href="#form-content-tab" role="tab"
                                    aria-controls="form-content-tab" aria-selected="true">
                                    <i data-feather="info"></i> @lang('product::product.product.tab.info')</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link d-flex align-items-center" id="child-tab" data-bs-toggle="tab"
                                    href="#child-content-tab" role="tab" aria-controls="child-content-tab"
                                    aria-selected="true">
                                    <i data-feather="archive"></i> @lang('product::product.product.tab.child')</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link d-flex align-items-center" id="image-tab" data-bs-toggle="tab"
                                    href="#image-content-tab" role="tab" aria-controls="image-content-tab"
                                    aria-selected="true">
                                    <i data-feather="image"></i> @lang('product::product.product.tab.image')</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        <div class="tab-content" id="animateLineContent-4">
            <div class="tab-pane fade show active" id="form-content-tab" role="tabpanel" aria-labelledby="form-content-tab">
                @include('product::product.form')
            </div>
            @if (@$product)
                <div class="tab-pane fade" id="child-content-tab" role="tabpanel" aria-labelledby="child-content-tab">
                    @include('product::product.child-form')
                </div>
                <div class="tab-pane fade" id="image-content-tab" role="tabpanel" aria-labelledby="image-content-tab">
                    @include('product::product.image-form')
                </div>
            @endif
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin/plugins/src/tomSelect/tom-select.complete.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/admin/product.js') }}"></script>
@endsection
