@extends('layouts.layout')
@section('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/home/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/src/splide/splide.min.css') }}">

    {{-- dark --}}
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/dark/splide/custom-splide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/light/splide/custom-splide.min.css') }}">
@endsection
@section('content')
    <div class="middle-content container-xxl p-0">
        <div class="row layout-top-spacing">
            <div class="col-xl-12">
                <div>
                    <div>
                        <h3>About</h3>
                    </div>
                    <div class="row mb-4">
                        @include('admin.home.about.aboutInfo')
                    </div>
                </div>
                <div>
                    <div class="text-center">
                        <h3>Web Design</h3>
                    </div>
                    <div class="row mb-4">
                        @include('admin.home.webDesign.webDesignInfo')
                        @foreach ($designService as $item)
                            @include('admin.home.webDesign.webDesignService')
                        @endforeach
                    </div>
                </div>
                <div>
                    <div class="text-center">
                        <h3>Bảng báo giá</h3>
                    </div>
                    <div class="row mb-4">
                        <div class="col-xl-3">
                            <div class="card">
                                <div class="card-header">
                                    Pricing list form
                                </div>
                                <div class="card-body">
                                    @include('admin.home.pricingForm')
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9">
                            <section class="splide" id="splide" aria-label="Splide Basic HTML Example">
                                <div class="splide__track">
                                    <ul class="splide__list">
                                        @foreach ($pricingTable as $item)
                                            <li class="splide__slide">@include('admin.home.prcing-list')</li>
                                        @endforeach
                                        <div class="splide__pagination"></div>
                                    </ul>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="text-center">
                        <h3>Câu hỏi thường gặp</h3>
                    </div>
                    <div class="mb-3">
                        @include('admin.home.faqForm')
                    </div>
                    <div class="mb-3">
                        <div class="card">
                            <div class="card-header">
                                Danh sách câu hỏi
                            </div>
                            <div class="card-body">
                                @include('admin.home.faqList')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('admin/plugins/src/splide/splide.min.js') }}"></script>
    <script src="{{ asset('js/admin/home.js') }}"></script>
    <script>
        new Splide('.splide', {
            perPage: 3,
            pagination: true,
            arrows: false,
        }).mount();
    </script>
@endsection
