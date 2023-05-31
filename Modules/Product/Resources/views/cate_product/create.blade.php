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
        <form id="productCateForm" action="#" method="POST">
            @csrf
            <input type="text" value="{{ @$product_cate->id }}" name="product_cate_id" hidden>
            <div class="row layout-top-spacing">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header">
                            @lang('product::product.category.header.' . (@$product_cate->id ? 'edit' : 'add'))
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label for="parent-select" class="form-label">@lang('product::product.category.parent_category'):
                                        {{ @$product_cate->parent_id != 0 ? @$product_cate->parent->title : 'Danh mục cha' }}
                                    </label>
                                    <select id="parent-select" name="parent_id" placeholder="Select your parent"
                                        autocomplete="off">
                                        <option value="0">Danh mục cha</option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}"
                                                {{ @$product_cate->parent_id == $item->id ? 'selected' : '' }}>
                                                {{ @$item->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="title" class="form-label">@lang('product::product.category.title')</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ @$product_cate->title }}">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="slug" class="form-label">slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        value="{{ @$product_cate->slug }}">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="description" class="form-label">@lang('product::product.category.description')</label>
                                    <textarea name="description" id="description" cols="30" rows="5" class="form-control">{{ @$product_cate->description }}</textarea>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="priority" class="form-label">Priority</label>
                                    <input type="text" class="form-control" id="priority" name="priority"
                                        value="{{ @$product_cate->priority }}">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="status-select" class="form-label">
                                        @lang('product::product.category.status')
                                    </label>
                                    <select id="status-select" name="status" placeholder="Select your parent"
                                        autocomplete="off">
                                        <option value="A" {{ @$product_cate->status == 'A' ? 'selected' : '' }}>
                                            Hoạt động
                                        </option>
                                        <option value="D" {{ @$product_cate->status == 'D' ? 'selected' : '' }}>
                                            KHông hoạt động
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
                            @lang('product::product.category.image')
                        </div>
                        <div class="card-body">
                            <div class="blogImgBox">
                                <img src="{{ @$product_cate->image ? asset(config('product.image.path') . $product_cate->id . '/' . $product_cate->image) : asset('admin/assets/img/no-image.jpeg') }}"
                                    alt="" id="image-category-preview">
                                <div class="uploadButtonContain d-flex justify-content-end">
                                    <label class="uploadButton" for="avatar-category-upload">
                                        <i data-feather="upload"></i>
                                    </label>
                                    <input type="file" id="avatar-category-upload" accept="image/*" hidden=""
                                        name="productCateImage">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Seo
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label for="seoTitle" class="form-label">Seo title</label>
                                    <input type="text" class="form-control" id="seoTitle" name="seo_title"
                                        value="{{ @$product_cate->seo->seo_title }}">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="seoDescription" class="form-label">Seo Description</label>
                                    <textarea type="text" cols="30" rows="5" class="form-control" id="seoDescription"
                                        name="seo_description">{{ @$product_cate->seo->seo_keyword }}</textarea>
                                </div>
                                <div class="col-lg-12">
                                    <label for="seoKeyword" class="form-label">Seo Keyword</label>
                                    <textarea type="text" cols="30" rows="5" class="form-control" id="seoKeyword" name="seo_keyword">{{ @$product_cate->seo->seo_description }}</textarea>
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
    <script src="{{ asset('js/admin/product_cate.js') }}"></script>
@endsection
