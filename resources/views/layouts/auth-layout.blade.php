<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login | Register</title>
    <link rel="stylesheet" href="{{ asset('admin/bootstrap/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/layouts/modern-light-menu/css/dark/plugins.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dark/authentication/auth-boxed.css') }}" type="text/css">

    <link rel="stylesheet" href="{{ asset('admin/layouts/modern-light-menu/css/light/plugins.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/light/authentication/auth-boxed.css') }}" type="text/css">
</head>

<body class="form">
    @yield('content')
</body>
<script src="{{ asset('admin/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</html>
