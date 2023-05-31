@extends('layouts.layout')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/src/tomSelect/tom-select.default.min.css') }}">
    {{-- dark theme --}}
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/dark/tomSelect/custom-tomSelect.css') }}">
    {{-- light theme --}}
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/light/tomSelect/custom-tomSelect.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/category.css') }}">
@endsection

@section('content')
    <div class="middle-content container-xxl p-0">
        <div class="breadcrumb-wrapper-content  mt-3 d-flex justify-content-end layout-top-spacing">
            <div>
                <button class="btn btn-light-primary" type="submit" id="submitForm">Save</button>
            </div>
        </div>
        <form id="featureForm" action="#" method="POST">
            @csrf
            <input type="text" value="{{ @$feature->id }}" name="feature_id" hidden>
            <div class="row layout-top-spacing">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            @lang('product::product.feature.header.' . (@$feature->id ? 'edit' : 'add'))
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label for="parent-select" class="form-label">@lang('product::product.feature.parent_category'):
                                        {{ @$feature->parent_id != 0 ? @$feature->parent->name : 'Danh mục cha' }}
                                    </label>
                                    <select id="parent-select" name="parent_id" placeholder="Select your parent"
                                        autocomplete="off">
                                        <option value="0">Danh mục cha</option>
                                        @foreach ($features as $item)
                                            <option value="{{ $item->id }}"
                                                {{ @$feature->parent_id == $item->id ? 'selected' : '' }}>
                                                {{ @$item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="title" class="form-label">@lang('product::product.feature.title')</label>
                                    <input type="text" class="form-control" id="title" name="name"
                                        value="{{ @$feature->name }}">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="status-select" class="form-label">
                                        @lang('product::product.feature.status.header')
                                    </label>
                                    <select id="status-select" name="status" placeholder="Select your parent"
                                        autocomplete="off">
                                        <option value="A" {{ @$feature->status == 'A' ? 'selected' : '' }}>
                                            @lang('product::product.feature.status.A')
                                        </option>
                                        <option value="D" {{ @$feature->status == 'D' ? 'selected' : '' }}>
                                            @lang('product::product.feature.status.D')
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            @lang('product::product.feature.image')
                        </div>
                        <div class="card-body">
                            <div class="blogImgBox">
                                <img src="{{ @$feature->option ? asset(config('product.image.feature_path') . $feature->id . '/' . $feature->option) : asset('admin/assets/img/no-image.jpeg') }}"
                                    alt="" id="feature-option-preview">
                                <div class="uploadButtonContain d-flex justify-content-end">
                                    <label class="uploadButton" for="feature-option-upload">
                                        <i data-feather="upload"></i>
                                    </label>
                                    <input type="file" id="feature-option-upload" accept="image/*" hidden=""
                                        name="featureImage">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin/plugins/src/tomSelect/tom-select.complete.min.js') }}"></script>
    <script>
        new TomSelect("#parent-select", {});
        new TomSelect("#status-select", {});
    </script>
    <script src="{{ asset('js/admin/feature.js') }}"></script>
@endsection
