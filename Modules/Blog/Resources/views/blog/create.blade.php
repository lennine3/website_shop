@extends('layouts.layout')
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/src/tomSelect/tom-select.default.min.css') }}">
    {{-- dark theme --}}
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/dark/tomSelect/custom-tomSelect.css') }}">
    {{-- light theme --}}
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/light/tomSelect/custom-tomSelect.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/blog_category.css') }}">
@endsection
@section('content')
    <div class="middle-content container-xxl p-0">
        <form id="blogForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="text" value="{{ @$blog->id }}" name="blog_id" hidden>
            <div class="row layout-top-spacing">
                <div class="col-xxl-9">
                    <div class="card">
                        <div class="card-header">
                            @lang('blog::blog.blog.header.' . (@$blog->id ? 'edit' : 'add'))
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label for="title" class="form-label">@lang('blog::blog.blog.title')</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ @$blog->title }}">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="slug" class="form-label">slug</label>
                                    <input type="text" class="form-control" id="slug" name="slug"
                                        value="{{ @$blog->slug }}">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="description_blog" class="form-label">@lang('blog::blog.blog.short_description')</label>
                                    <textarea name="description" class="form-control" id="description_blog" cols="30" rows="10">{{ @$blog->description }}</textarea>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="content_blog" class="form-label"> @lang('blog::blog.blog.content')</label>
                                    <textarea name="content" class="form-control content_blog" id="content_blog" cols="30" rows="10">{{ @$blog->content }}</textarea>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="priority" class="form-label">@lang('blog::blog.blog.priority')</label>
                                    <input type="text" class="form-control" id="priority" name="priority"
                                        value="{{ @$blog->priority }}">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="status-select" class="form-label">
                                        @lang('blog::blog.blog.status.header')
                                    </label>
                                    <select id="status-select" name="status" placeholder="Select your parent"
                                        autocomplete="off">
                                        <option value="A" {{ @$blog->status == 'A' ? 'selected' : '' }}>
                                            @lang('blog::blog.blog.status.A')
                                        </option>
                                        <option value="D" {{ @$blog->status == 'D' ? 'selected' : '' }}>
                                            @lang('blog::blog.blog.status.D')
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 mt-xxl-0 mt-4">
                    <div class="card mb-3">
                        <div class="card-header">
                            @lang('blog::blog.blog.image')
                        </div>
                        <div class="card-body">
                            <div class="blogImgBox">
                                <img src="{{ @$blog->image ? asset(config('blog.image.path') . $blog->id . '/' . $blog->image) : asset('admin/assets/img/no-image.jpeg') }}"
                                    alt="" id="image-preview">
                                <div class="uploadButtonContain d-flex justify-content-end">
                                    <label class="uploadButton" for="avatar-upload">
                                        <i data-feather="upload"></i>
                                    </label>
                                    <input type="file" id="avatar-upload" accept="image/*" hidden=""
                                        name="blogImage">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header">
                            @lang('blog::blog.blog.category')
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label for="blog_category_id" class="form-label">Danh mục</label>
                                    <select name="blog_category_id" id="blog_category_id">
                                        @foreach ($blogCategoryList as $item)
                                            <option value="{{ $item->id }}"
                                                {{ @$blog && @$item->id == $blog->blog_category_id ? 'selected' : '' }}>
                                                {{ $item->title_short }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-header">
                            Seo
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <label for="seoTitle" class="form-label">Seo title</label>
                                    <input type="text" class="form-control" id="seoTitle" name="seo_title"
                                        value="{{ @$blog->seo->seo_title }}">
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <label for="seoDescription" class="form-label">Seo Description</label>
                                    <textarea type="text" cols="30" rows="5" class="form-control" id="seoDescription"
                                        name="seo_description">{{ @$blog->seo->seo_description }}</textarea>
                                </div>
                                <div class="col-lg-12">
                                    <label for="seoKeyword" class="form-label">Seo Keyword</label>
                                    <textarea type="text" cols="30" rows="5" class="form-control" id="seoKeyword" name="seo_keyword">{{ @$blog->seo->seo_keyword }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-12 col-sm-4 col-12 mx-auto">
                        <button id="submitForm"
                            class="btn btn-success w-100 _effect--ripple waves-effect waves-light">{{ @$blog->id ? 'Update' : 'Create' }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('script')
    <script src="{{ asset('admin/assets/js/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('admin/plugins/src/tomSelect/tom-select.complete.min.js') }}"></script>
    <script>
        new TomSelect("#blog_category_id", {});
        new TomSelect("#status-select", {});
    </script>
    <script>
        const avatarUpload = document.getElementById("avatar-upload");
        const avatarPreview = document.getElementById("image-preview");

        avatarUpload.addEventListener("change", () => {
            const file = avatarUpload.files[0];

            if (file) {
                const reader = new FileReader();

                reader.addEventListener("load", () => {
                    avatarPreview.setAttribute("src", reader.result);
                });

                reader.readAsDataURL(file);
            } else {
                avatarPreview.setAttribute("src", "");
            }
        });
    </script>
    <script>
        CKEDITOR.replace("content_blog", {
            filebrowserBrowseUrl: "public/third/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
            filebrowserImageBrowseUrl: "public/third/filemanager/dialog.php?type=1&editor=ckeditor&fldr=",
            disallowedContent: "img{width,height}[width, height];",
            global_xss_fitering: !1,
            allowedContent: !0,
        });
        CKEDITOR.replace("description_blog", {
            filebrowserBrowseUrl: "public/third/filemanager/dialog.php?type=2&editor=ckeditor&fldr=",
            filebrowserImageBrowseUrl: "public/third/filemanager/dialog.php?type=1&editor=ckeditor&fldr=",
            disallowedContent: "img{width,height}[width, height];",
            global_xss_fitering: !1,
            allowedContent: !0,
        });
    </script>
    <script>
        $(document).ready(function() {
            // listen for click event on button
            $('#submitForm').click(function(e) {
                e.preventDefault(); // prevent default form submission
                // Get CKEditor data
                var editorContentData = CKEDITOR.instances.content_blog.getData();
                var editorDescData = CKEDITOR.instances.description_blog.getData();
                var form_data = new FormData($('#blogForm')[0]); // get form data

                // Append CKEditor data to the form data
                form_data.append('content', editorContentData);
                form_data.append('description', editorDescData);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/admin/blog/process',
                    type: 'POST',
                    data: form_data,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        toastr.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        // handle error response here
                    }
                });
            });
        });
    </script>
    {{-- <script src="{{asset('admin/assets/js/ckeditor/ckfinder/ckfinder.js')}}"></script> --}}
@endsection
