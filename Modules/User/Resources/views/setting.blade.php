@extends('layouts.layout')
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/plugins/src/filepond/filepond.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/src/filepond/FilePondPluginImagePreview.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/src/tomSelect/tom-select.default.min.css') }}">

    {{-- dark theme --}}
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dark/components/tabs.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dark/elements/alert.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dark/forms/switches.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dark/components/list-group.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dark/users/account-setting.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/dark/filepond/custom-filepond.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/dark/tomSelect/custom-tomSelect.css') }}">

    {{-- light theme --}}
    <link rel="stylesheet" href="{{ asset('admin/assets/css/light/components/tabs.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/light/elements/alert.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/light/forms/switches.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/light/components/list-group.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/light/users/account-setting.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/light/filepond/custom-filepond.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/light/tomSelect/custom-tomSelect.css') }}">

    <style>
        #avatar-preview {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }

        .uploadButtonContain {
            position: absolute;
            bottom: 0;
            right: 0;
            cursor: pointer;
        }

        .uploadButton {
            cursor: pointer;
            background-color: #fff;
            display: flex !important;
            align-items: center;
            justify-content: center;
            height: 50px;
            width: 50px;
            border-radius: 50px;
            margin: 0 !important
        }
    </style>
@endsection
@section('content')
    <div class="middle-content container-xxl p-0">
        <div class="layout-top-spacing">
            <div class="account-settings-container layout-top-spacing">

                <div class="account-content">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h2>@lang('user::user.header')</h2>

                            <ul class="nav nav-pills" id="animateLine" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="setting-tab" data-bs-toggle="tab"
                                        href="#setting-content-tab" role="tab" aria-controls="setting-content-tab"
                                        aria-selected="true">
                                        <i data-feather="home"></i>
                                        @lang('user::user.profile.nav_title')</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="password-tab" data-bs-toggle="tab"
                                        href="#password-content-tab" role="tab" aria-controls="password-tab"
                                        aria-selected="false" tabindex="-1">
                                        <i data-feather="shield"></i>
                                        @lang('user::user.password.nav_title')</button>
                                </li>
                                @if (Auth::user()->hasPermissionTo('view permission user'))
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="permission-tab" data-bs-toggle="tab"
                                            href="#permission-content-tab" role="tab"
                                            aria-controls="animated-underline-contact" aria-selected="false" tabindex="-1">
                                            <i data-feather="alert-circle"></i>
                                            @lang('user::user.permission.nav_title')</button>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="tab-content" id="animateLineContent-4">
                        <div class="tab-pane fade show active" id="setting-content-tab" role="tabpanel"
                            aria-labelledby="setting-content-tab">
                            @include('user::info')
                        </div>

                        <div class="tab-pane fade" id="password-content-tab" role="tabpanel"
                            aria-labelledby="password-content-tab">
                            @include('user::password')
                        </div>

                        <div class="tab-pane fade" id="permission-content-tab" role="tabpanel"
                            aria-labelledby="permission-content-tab">
                            @include('user::permission')
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('admin/plugins/src/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/src/filepond/FilePondPluginFileValidateType.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/src/filepond/FilePondPluginImageExifOrientation.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/src/filepond/FilePondPluginImagePreview.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/src/filepond/FilePondPluginImageCrop.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/src/filepond/FilePondPluginImageResize.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/src/filepond/FilePondPluginImageTransform.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/src/filepond/filepondPluginFileValidateSize.min.js') }}"></script>
    {{-- <script src="{{ asset('admin/plugins/src/font-icons/feather/feather.min.js') }}"></script> --}}
    <script src="{{ asset('admin/plugins/src/tomSelect/tom-select.complete.min.js') }}"></script>

    {{-- custom js --}}
    <script src="{{ asset('js/admin/user.js') }}"></script>

    {{-- time picker --}}
    <script src="{{ asset('admin/plugins/src/flatpickr/flatpickr.js') }}"></script>
    <script>
        var f1 = flatpickr(document.getElementById('basicFlatpickr'), {});
    </script>
@endsection
