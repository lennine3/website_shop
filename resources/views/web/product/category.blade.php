@extends('layouts.web.app')
@section('title')
    {{ $cateData->seo->seo_title != null ? $cateData->seo->seo_title : $cateData->title }}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('web/assets/css/web/product/category.css') }}">
    <link rel="stylesheet" href="{{ asset('web/assets/css/web/product/paginate.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css"
        integrity="sha512-UTNP5BXLIptsaj5WdKFrkFov94lDx+eBvbKyoe1YAfjeRPC+gT5kyZ10kOHCfNZqEui1sxmqvodNUx3KbuYI/A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
    <div class="container">
        <section class="breadcrumb-background">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="fa-solid fa-house"></i></a></li>
                    @foreach ($cateData->grandFather() as $item)
                        <li class="breadcrumb-item"><a href="#">{{ $item->title }}</a></li>
                    @endforeach
                    <li class="breadcrumb-item">{{ $cateData->title }}</li>
                </ol>
            </nav>
        </section>
        <section>
            <div class="d-flex justify-content-between mb-2">
                <div>
                    Mới
                </div>
                <div>
                    @include('web.product.paginate')
                </div>
            </div>
            <div class="row">
                <input type="text" value="{{ count($cateData->products) }}" hidden id="countProduct">
                @php
                    $indexProduct = 0;
                @endphp
                @foreach ($productList as $index => $product)
                    <div class=" {{ $indexProduct == 8 || $indexProduct == 9 ? 'col-md-6' : 'col-md-3' }} col-6">
                        @php
                            $indexProduct == 9 ? ($indexProduct = 0) : $indexProduct++;
                        @endphp
                        <a href="{{ url($product->slug) }}">
                            <div class="owlProduct_{{ $index }} owl-carousel owl-theme">
                                <div class="item">
                                    <div class="productImg">
                                        <img src="{{ asset('web/assets/image/home/blog.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="productImg">
                                        <img src="{{ asset('web/assets/image/home/seoImage.png') }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                <div>
                    @include('web.product.paginate')
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js"
        integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('web/assets/js/category.js') }}"></script>
@endsection
