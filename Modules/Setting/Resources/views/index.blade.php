@php
    $shop = !empty($generals['SHOP']) ? $generals['SHOP'] : [];
@endphp
@extends('layouts.layout')
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dark/elements/infobox.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/light/elements/infobox.css') }}">
    <style>
        .widget-header {
            padding-top: 25px !important;
        }

        .favIconContain {
            width: 50px;
            height: 50px;
        }

        .favIconContain img {
            height: 100%;
            width: 100%;
            object-fit: cover
        }

        .logoImgContain {
            height: 120px;
            width: 120px;
        }

        .logoImgContain img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .btn.btn-white.btn-shadow {
            -webkit-box-shadow: 0px 9px 16px 0px rgba(24, 28, 50, 0.25) !important;
            box-shadow: 0px 9px 16px 0px rgba(24, 28, 50, 0.25) !important;
        }

        .btn.btn-icon-logo.btn-circle {
            border-radius: 50%;
        }

        .btn.btn-icon-logo.btn-xs {
            height: 24px;
            width: 24px;
        }

        .btn-icon-logo {
            padding: 1px 0px !important;
        }

        .logo-box {
            right: 0;
            display: flex;
            justify-content: end;
            position: absolute;
        }

        .labelIcon {
            right: -10px;
            top: -10px
        }

        body.dark .btn svg {
            pointer-events: none;
            height: 16px;
            width: 16px;
            vertical-align: middle;
        }

        body .btn svg {
            pointer-events: none;
            height: 16px;
            width: 16px;
            vertical-align: middle;
        }
    </style>
@endsection
@section('content')
    <div class="breadcrumb-wrapper-content  mt-3 d-flex justify-content-end">
        <div>
            <button class="btn btn-light-primary" type="submit" id="submitForm">Save</button>
        </div>
    </div>
    <div class="middle-content container-xxl p-0">
        <div class="row layout-top-spacing">
            <form action="#" id="formSetting" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-xl-12 mb-4">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>Thông tin trang web</h4>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-8 mx-auto">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            @include('setting::setting_info')
                                        </div>
                                        <div class="col-lg-6">
                                            @include('setting::setting_seo')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4>@lang('setting::setting.social.name')</h4>
                            </div>
                        </div>
                        <div class="widget-content widget-content-area">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-8 mx-auto">
                                    @include('setting::setting_social')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/admin/setting.js') }}"></script>
@endsection
