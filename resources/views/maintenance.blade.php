<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>The page is under contruction please wait</title>
    <link rel="icon" type="image/x-icon" href="../src/assets/img/favicon.ico" />
    <link rel="stylesheet" href="{{ asset('admin/layouts/modern-light-menu/css/light/loader.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/layouts/modern-light-menu/css/dark/loader.css') }}" type="text/css">
    <script src="{{ asset('admin/layouts/modern-light-menu/loader.js') }}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/bootstrap/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('admin/layouts/modern-light-menu/css/light/plugins.css') }}" type="text/css">
    <link href="{{ asset('admin/assets/css/light/pages/error/style-maintanence.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('admin/assets/css/dark/pages/error/style-maintanence.css') }}" rel="stylesheet"
        type="text/css" />

    <link rel="stylesheet" href="{{ asset('admin/layouts/modern-light-menu/css/dark/plugins.css') }}" type="text/css">
    <!-- END GLOBAL MANDATORY STYLES -->

    <style>
        body.dark .theme-logo.dark-element {
            display: inline-block;
        }

        .theme-logo.dark-element {
            display: none;
        }

        body.dark .theme-logo.light-element {
            display: none;
        }

        .theme-logo.light-element {
            display: inline-block;
        }
    </style>

</head>

<body class="maintanence text-center">


    <div class="container-fluid maintanence-content">
        <div class="">
            <div class="maintanence-hero-img">
                <a href="javascript:0">
                    <img alt="logo" src="{{ asset('admin/assets/img/logo.svg') }}" class="dark-element theme-logo">
                    <img alt="logo" src="{{ asset('admin/assets/img/logo2.svg') }}"
                        class="light-element theme-logo">
                </a>
            </div>
            <h1 class="error-title">Under Maintenance</h1>
            <p class="error-text">Thank you for visiting us.</p>
            <p class="text">We are currently working on making some improvements <br /> to give you better user
                experience.</p>
            <p class="text">Please visit us again shortly.</p>
            <a href="javascript:0" class="btn btn-dark mt-4">Home</a>
        </div>
    </div>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('admin/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
</body>

</html>
