@extends('layouts.web.app')
@section('title')
    {{ @$blogData->seo->seo_title ? @$blogData->seo->seo_title : @$blogData->title }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('web/assets/css/web/blogDetail.css') }}">
@endsection

@section('meta')
@endsection

@section('content')
    <section>
        <div class="blogDetailHeadBanner">
            <img class="imgBannerBlogDetail" alt="{{ @$blogData->title }}"
                src="{{ @$blogData->image ? asset(config('blog.image.path') . $blogData->id . '/' . $blogData->image) : asset('admin/assets/img/no-image.jpeg') }}">
        </div>
    </section>
    <section>
        <div class="blog-detail-wrapper">
            <h1 class="titleText text-center px-3 blogDetailTitle">{{ $blogData->title }}</h1>
            <article class="mx-auto blog-detail-article">
                <div class="infoBox">
                    <div>Biên tập viên: {{ $blogData->user->name }}</div>
                    <div>Ngày đăng: {{ Carbon\Carbon::parse($blogData->created_at)->format('d-m-Y') }}</div>
                </div>
                <div>
                    <div class="short-description">{!! $blogData->description !!}</div>
                </div>

                <div id="post-content">
                    <div class="bg-light py-3 px-3 tableOfContent" id="toc-content">
                        <div data-bs-toggle="collapse" data-bs-target="#tocAccordion">
                            <div class="mb-0 d-flex justify-content-between align-items-center">
                                <div>
                                    <b>Nội dung tiêu điểm:</b>
                                </div>
                                <button class="toc-accordion-btn">
                                    <span id="tocText">Thu gọn</span><i class="fa fa-angle-down"></i>
                                </button>
                            </div>
                        </div>
                        <div class="collapse show" id="tocAccordion">
                            <ul data-toc="#post-content" data-toc-headings="h1,h2,h3" id="toc-blog" class="ml-3">
                            </ul>
                        </div>
                    </div>
                    <div class="blogDetailContent">
                        {!! $blogData->content !!}
                    </div>
                </div>
                <div class="d-flex justify-content-center socialBox">
                    <div>
                        <div class="blogDetailShareTitle"> Hãy chia sẻ ngay bài viết hữu ích này nhé! </div>
                        <div class="d-flex justify-content-center blogDetailSocialBox">
                            <div> <a href="https://www.facebook.com/sharer/sharer.php?u=https://hello-xe-local.com.vn/bang-gia-xe-toyota/"
                                    target="_blank"> <img src="{{ asset('web/assets/image/blogDetail/facebook.svg') }}"
                                        alt="">
                                </a> </div>
                            <div> <a href="https://www.linkedin.com/sharing/share-offsite/?url=https://hello-xe-local.com.vn/bang-gia-xe-toyota/"
                                    target="_blank"> <img src="{{ asset('web/assets/image/blogDetail/linkedin.svg') }}"
                                        alt="">
                                </a> </div>
                            <div> <span type="button" data-toggle="tooltip" data-placement="top" title=""
                                    id="copylink" data-original-title="Copy to clipboard"> <img
                                        src="{{ asset('web/assets/image/blogDetail/sharingLink.svg') }}" alt="">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

        </div>
    </section>
    @if (count($relatedBlog) > 0)
        <section class="relatedSection">
            <div class="container">
                <div class="maybeCareTitle text-center titleText">Tham khảo thêm</div>
                <div class="row">
                    @foreach ($relatedBlog as $item)
                        <div class="col-lg-3 col-md-3 col-sm-12 relatedBox">
                            <a href="{{ url($item->slug) }}">
                                <div class="post-thumb">
                                    <img src="{{ @$item->image ? asset(config('blog.image.path') . $item->id . '/' . $item->image) : asset('admin/assets/img/no-image.jpeg') }}"
                                        alt="">
                                </div>
                                <div>
                                    <h3 class="relatedPostTitle">{{ $item->title }}</h3>
                                    <div class="relatedPostDesc">
                                        {!! $item->description !!}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
@section('script')
    <script src="{{ asset('web/assets/js/toc/jquery.toc.js') }}"></script>
    <script src="{{ asset('web/assets/js/blog.js') }}"></script>
@endsection
