@extends('layouts.web.app')
@section('title')
    {{ @$blog_category->seo->seo_title ? @$blog_category->seo->seo_title : @$blog_category->title }}
@endsection
@section('style')
    <link rel="stylesheet" href="{{ asset('web/assets/css/web/blogCategory.css') }}">
@endsection
@section('content')
    <div class="slide-wrap">
        <img src="{{ asset('web/assets/image/home/banner.png') }}" alt="banner blog category" width="1920" height="480">
    </div>
    <section class="blogCategorySection">
        <div class="container">
            <div>
                <div class="blogCategoryTitle">
                    {{ $blog_category->title }}
                </div>
                <div class="blogCategorySubTitle">
                    {{ $blog_category->description }}
                </div>
            </div>
            <div class="lynessa-blog style-01" id="blog-pagination">
                <div class="blog-list-grid row align-items-strect auto-clear equal-container better-height">
                    @foreach ($blog_category->blogs()->latest()->take(4)->get() as $blog)
                        <article class="col-lg-6 col-md-6 blogBoxItem">
                            @include('web.blog.list_blog')
                        </article>
                    @endforeach
                </div>
            </div>
            {{-- <div class="lynessa-blog style-01" id="blog-pagination">
                <div class="blog-list-grid row align-items-strect auto-clear equal-container better-height">
                    @foreach ($categories as $item)
                        <div class="col-lg-12">
                            <div class="categoryChildTitle">
                                {{ $item->title }}</div>

                        </div>
                        @foreach ($item->blogs()->latest()->take(4)->get() as $blog)
                            <article class="col-lg-6 col-md-6 blogBoxItem">
                                @include('Web::general.list-blog')
                            </article>
                        @endforeach
                    @endforeach
                </div>
            </div> --}}
        </div>
    </section>
@endsection

@section('script')
@endsection
