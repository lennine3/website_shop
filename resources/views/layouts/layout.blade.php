<!DOCTYPE html>
<html lang="en">
@include('layouts.head')
@yield('style')

<body class="layout-boxed">
    @include('layouts.navbar')
    <div class="main-container" id="container">
        <div class="overlay"></div>
        <div class="search-overlay"></div>
        @include('layouts.sidebar')
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                @yield('content')
                @include('layouts.footer')
            </div>
        </div>
    </div>
    @include('layouts.global-script')
    @yield('script')
</body>

</html>
