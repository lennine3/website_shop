<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Quản trị</title>
    <link rel="icon" type="image/x-icon" href="{{ show_favicon('favicon.ico') }}"/>
    <link rel="stylesheet" href="{{ asset('admin/layouts/modern-light-menu/css/light/loader.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/layouts/modern-light-menu/css/dark/loader.css') }}" type="text/css">
    <script src="{{ asset('admin/layouts/modern-light-menu/loader.js') }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/bootstrap/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/layouts/modern-light-menu/css/light/plugins.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/layouts/modern-light-menu/css/dark/plugins.css') }}" type="text/css">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/src/apex/apexcharts.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/light/dashboard/dash_1.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dark/dashboard/dash_1.css') }}" type="text/css">
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    {{-- toastr --}}
    <link rel="stylesheet" href="{{ asset('admin/plugins/src/notification/snackbar/snackbar.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/dark/notification/snackbar/custom-snackbar.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/light/notification/snackbar/custom-snackbar.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('web/assets/css/toastr/toastr.css') }}">
    {{-- sweetalert --}}
    <link rel="stylesheet" href="{{ asset('admin/plugins/src/sweetalerts2/custom-sweetalert.js') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}">
    {{-- Base link --}}
    <base href="{{ url('admin/') }}">
    {{-- date time picker --}}
    <link href="{{ asset('admin/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/light/flatpickr/custom-flatpickr.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/css/dark/flatpickr/custom-flatpickr.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/src/font-icons/fontawesome/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/src/font-icons/fontawesome/css/regular.css') }}">
</head>
