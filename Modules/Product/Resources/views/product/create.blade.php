@extends('layouts.layout')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/src/tomSelect/tom-select.default.min.css') }}">
    {{-- dark theme --}}
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/dark/tomSelect/custom-tomSelect.css') }}">
    {{-- light theme --}}
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/light/tomSelect/custom-tomSelect.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/category.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/product.css') }}">
@endsection

@section('content')
    <div class="middle-content container-xxl p-0">
        <div class="breadcrumb-wrapper-content  mt-3 layout-top-spacing">
            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills" id="animateLine" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active d-flex align-items-center" id="form-tab" data-bs-toggle="tab"
                                href="#form-content-tab" role="tab" aria-controls="form-content-tab"
                                aria-selected="true">
                                <i data-feather="home"></i>
                                Thông tin</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link d-flex align-items-center" id="child-tab" data-bs-toggle="tab"
                                href="#child-content-tab" role="tab" aria-controls="child-content-tab"
                                aria-selected="true">
                                <i data-feather="home"></i>
                                Sản phẩm con</button>
                        </li>
                    </ul>
                </div>
            </div>
            {{-- <div>
                <button class="btn btn-light-primary" type="submit" id="submitForm">Save</button>
            </div> --}}
        </div>
        <div class="tab-content" id="animateLineContent-4">
            <div class="tab-pane fade show active" id="form-content-tab" role="tabpanel" aria-labelledby="form-content-tab">
                @include('product::product.form')
            </div>
            <div class="tab-pane fade" id="child-content-tab" role="tabpanel" aria-labelledby="child-content-tab">
                @include('product::product.child-form')
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin/plugins/src/tomSelect/tom-select.complete.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/ckeditor/ckeditor.js') }}"></script>
    <script>
        function updateChildProduct(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/admin/product/child/' + id + '/edit',
                type: 'GET',
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#childForm').html(response.html)
                    // toastr.success(response.message);
                },
                error: function(xhr, status, error) {
                    // handle error response here
                }
            });
        }

        var countFeature = $("#featureCount").val();
        for (let index = 0; index < countFeature; index++) {
            new TomSelect("#feature-select_" + index, {});
        }

        var countFeature = $("#featureChildCount").val();
        for (let index = 0; index < countFeature; index++) {
            new TomSelect("#feature-child-select_" + index, {});
        }

        CKEDITOR.replace("product_content", {
            filebrowserBrowseUrl: "public/third/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
            filebrowserImageBrowseUrl: "public/third/filemanager/dialog.php?type=1&editor=ckeditor&fldr=",
            disallowedContent: "img{width,height}[width, height];",
            global_xss_fitering: !1,
            allowedContent: !0,
        });
        CKEDITOR.replace("description", {
            filebrowserBrowseUrl: "public/third/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
            filebrowserImageBrowseUrl: "public/third/filemanager/dialog.php?type=1&editor=ckeditor&fldr=",
            disallowedContent: "img{width,height}[width, height];",
            global_xss_fitering: !1,
            allowedContent: !0,
        });
        new TomSelect("#cate-select", {});
        new TomSelect("#status-select", {});
        new TomSelect("#child-status-select", {});
    </script>
    <script src="{{ asset('js/admin/product.js') }}"></script>
@endsection
