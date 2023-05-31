@extends('layouts.web.app')
@section('title')
    {{ @$generals['SHOP']['seo_title'] ? @$generals['SHOP']['seo_title'] : @$generals['SHOP']['web_name'] }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('web/assets/css/home.css') }}">
@endsection

@section('meta')
    @include('meta.home-meta')
@endsection

@section('content')
    <section>
        <div class="bannerContain">
            <img src="{{ asset('web/assets/image/home/banner.png') }}" alt="">
        </div>
    </section>
    <section class="aboutUsSection" id="aboutUsSection">
        <div class="aboutUsContain container">
            <h1 class="titleText">{{ $aboutInfo->name }}</h1>
            <div class="aboutUsBox">
                <div class="descText">
                    {{ $aboutInfo->description }}
                </div>
            </div>
        </div>
    </section>

    {{-- home service --}}
    @include('web.home.designService')

    {{-- seo Service --}}
    @include('web.home.seoService')

    <section id="homeMarketingSection">
        <div class="homeMarketingContainer container">
            <div class=" text-center">
                <div class="d-flex justify-content-center">
                    <h2 class="titleText homeMarketingTitle"> Dịch vụ marketing
                        dành cho doanh nghiệp vừa và nhỏ </h2>
                </div>
                <div class="d-flex justify-content-center">
                    <span class="descText homeMarketingDesc"> Lựa chọn dịch vụ marketing mà bạn muốn chúng tôi tư vấn!
                    </span>
                </div>
                <div class="d-flex justify-content-center">
                    <hr class="homeMarketingSeparateLine">
                </div>
            </div>
            <div class="row">
                @foreach ($marketingService as $item)
                    <div class="col-lg-4 col-md-6 col-sm-6 d-flex justify-content-center homeMarketingBoxContain">
                        <div class="homeMarketingBox">
                            <div class="homeMarketingBoxImg">
                                <img src="{{ @$item->image ? asset(config('blog.image.path') . $item->id . '/' . $item->image) : asset('admin/assets/img/no-image.jpeg') }}"
                                    alt="{{ $item->title }}" loading="lazy">
                            </div>
                            <div>
                                <h3 class="homeMarketingBoxTitle"> {{ $item->title }} </h3>
                                <div class="homeMarketingBoxDesc"> {!! $item->description !!} </div>
                                <div class="homeMarketingBoxLink">
                                    <a target="_blank" href="{{ url($item->slug) }}" class="homeMarketLink">
                                        Bấm vào để xem chi tiết <i class="far fa-chevron-double-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <section id="pricingTableSetion">
        <div class="quotationContain">
            <div class=" text-center">
                <h2 class="quotationTitle titleText"> Bảng giá dịch vụ marketing </h2>
                <div class="d-flex justify-content-center"> <span class="quotationDesc"> Bảng giá được thiết kế dựa trên
                        nhu cầu tùy chọn của từng khách hàng
                        Áp dụng đến 31/12/2023 </span> </div>
                <div class="d-flex justify-content-center">
                    <hr class="quotationSeparateLine">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="pricingContain">
                <div class="pricingContainer">
                    <div class="row">
                        @foreach ($pricingTable as $index => $item)
                            @include('web.home.pricing-table')
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btnPricing" id="show-more">
                    Xem thêm bảng giá
                </button>
            </div>
        </div>
    </section>
    <section class="container blogContainer blogContain" id="blogMarketing">
        <h2 class="titleText blogHeadTitle">Blog marketing </h2>
        <div class="descText"> Chia sẻ kiến thức về marketing giúp bạn quản trị thương hiệu tốt hơn </div>
        <div class="blogContainBox">
            <div class="blog-slider">
                @foreach ($marketingBlog as $item)
                    <div class="blogContainMobile">
                        <a href="{{ url($item->slug) }}">
                            <div class="blogBox">
                                <img src="{{ @$item->image ? asset(config('blog.image.path') . $item->id . '/' . $item->image) : asset('admin/assets/img/no-image.jpeg') }}"
                                    alt="{{ $item->title }}" loading="lazy">
                            </div>
                            <div class="blogTitle"> {{ $item->title }} </div>
                            <div class="blogSubTitle">{!! $item->description !!}</div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- home Faq --}}
    @include('web.home.faq')
@endsection
@section('script')
    <script src="{{ asset('web/assets/js/home.js') }}"></script>
@endsection
