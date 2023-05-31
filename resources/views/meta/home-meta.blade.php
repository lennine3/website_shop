@section('meta')
    <meta name="description" content="{{ @$generals['SHOP']['seo_description'] }}" />
    <meta name="keywords" content="{{ @$generals['SHOP']['seo_keyword'] }}">
    <meta name="author" content="{{ @$generals['SHOP']['web_name'] }}" />
    <meta name="generator" content="{{ @$generals['SHOP']['web_name'] }}" />
    <meta content="index,follow" name="googlebot">
    <meta name="copyright" content="{{ @$generals['SHOP']['coppyright'] }}">
    <meta name="robots" content="INDEX,FOLLOW">
    <meta name="geo.placename" content="{{ @$generals['SHOP']['address'] }}" />
    <meta name="geo.position" content="{{ @$generals['SHOP']['position'] }}" />
    <meta name="geo.region" content="VN-Hồ Chí Minh" />
    <meta name="ICBM" content="{{ @$generals['SHOP']['position'] }}" />
    <meta name="DC.title" lang="vi" content="{{ @$generals['SHOP']['seo_description'] }}">
    <meta name="DC.creator" content="{{ @$generals['SHOP']['web_name'] }}" />
    <link rel="DCTERMS.replaces" hreflang="vi" href="{{ $current_link }}">
    <meta name="DCTERMS.abstract" content="{{ @$generals['SHOP']['seo_description'] }}">
    <link rel="alternate" href="{{ $current_link }}" hreflang="vi" />
    <link rel="alternate" href="{{ $current_link }}" hreflang="x-default" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:title" content="{{ @$generals['SHOP']['seo_title'] }}">
    <meta property="og:description" content="{{ @$generals['SHOP']['seo_description'] }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ $current_link }}">
    {{-- @php
        $image = url('/') . show_image(config('banner.image.org_path'), @$banner_slide_home[0]->avatar);
    @endphp --}}
    <meta property="og:image" content="{{ url('public/web/assets/image/home/thumbnail.png') }}">
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="{{ '@' . @$getTwitter[3] }}">
    <meta name="twitter:title" content="{{ @$generals['SHOP']['seo_title'] }}">
    <meta name="twitter:description" content="{{ @$generals['SHOP']['seo_description'] }}">
    <meta property="twitter:image" content=" {{ url('public/web/assets/image/home/thumbnail.png') }} ">
    <link rel="canonical" href="{{ $current_link }}" />
@endsection
