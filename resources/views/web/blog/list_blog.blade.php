@php
    $slug = @$blog->slug;
@endphp
{{-- featureBlog --}}
<div class="d-flex">
    <div class="">
        <a href="{{ url($slug) }}">
            <div class="blogInfoImg">
                <img class="blogInfo-img" alt="{{ @$blog->title }}"
                    src="{{ @$blog->image ? asset(config('blog.image.path') . $blog->id . '/' . $blog->image) : asset('admin/assets/img/no-image.jpeg') }}">
            </div>
        </a>
    </div>

    <div class="blogInfoBox">
        <div class="blogInfoContain">
            <a href="{{ url($slug) }}">
                <h3 class="blogCardTitle">{{ @$blog->title }}</h3>

                <div class="blogInfoItem mr-2">
                    {!! @$blog->description !!}
                </div>
            </a>
        </div>
    </div>
</div>
