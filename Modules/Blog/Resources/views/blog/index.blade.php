@extends('layouts.layout')
@section('style')
@endsection
@section('content')
    <div class="middle-content container-xxl p-0">
        <div class="row layout-top-spacing">
            @foreach ($blogList as $item)
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 mb-4">
                    <a href="{{ route('blog.edit', ['blog' => $item->id]) }}" class="card style-2 mb-md-0 mb-4">
                        <img src="{{ @$item->image ? asset(config('blog.image.path') . $item->id . '/' . $item->image) : asset('admin/assets/img/no-image.jpeg') }}"
                            class="card-img-top" alt="...">
                        <div class="card-body px-0 pb-0">
                            <h5 class="card-title mb-3">{{ $item->title }}</h5>
                            <div class="media mt-4 mb-0 pt-1">
                                <img src="{{ $item->user->avatar != null ? asset(config('user.image.path') . $item->user->id . '/' . $item->user->avatar) : asset('admin/assets/img/blank.png') }}"
                                    class="card-media-image me-3" alt="" style="object-fit: cover">
                                <div class="media-body">
                                    <h4 class="media-heading mb-1">{{ $item->user->name }}</h4>
                                    <p class="media-text">{{ Carbon\Carbon::parse($item->created_at)->toFormattedDateString() }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('script')
@endsection
