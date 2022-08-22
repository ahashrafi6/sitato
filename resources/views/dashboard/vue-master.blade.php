<!DOCTYPE html>
<html class="loading" lang="fa" data-textdirection="rtl" dir="rtl">
<!-- BEGIN: Head-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="robots" content="noindex, nofollow">
    <title>پنل مدیریت اشتراک وردپرس</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/site/images/icon.png') }}">
    <meta name="theme-color" content="#5A8DEE">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/layouts/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/layouts/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/layouts/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/layouts/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/layouts/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/layouts/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/layouts/semi-dark-layout.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/layouts/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/layouts/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/css/layouts/bootstrap-datepicker.min.css') }}">
    <!-- END: Page CSS-->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/dashboard/scss/vue.css') }}">

    @yield('style')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">

@include('dashboard.layouts.header')

@include('dashboard.layouts.sidebar')

<!-- BEGIN: Content-->
<div class="app-content content" id="app">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            @yield('content')
        </div>
    </div>
</div>
<!-- END: Content-->

@include('dashboard.layouts.customizer')

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

@include('dashboard.layouts.footer')


<!-- BEGIN: Vendor JS-->
<script src="{{ asset('assets/dashboard/js/layouts/vendors.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/layouts/LivIconsEvo.tools.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/layouts/LivIconsEvo.defaults.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/layouts/LivIconsEvo.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/layouts/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/layouts/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/layouts/bootstrap-datepicker.fa.min.js') }}"></script>
<!-- BEGIN Vendor JS-->


<!-- BEGIN: Theme JS-->
<script src="{{ asset('assets/dashboard/js/layouts/vertical-menu-dark.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/layouts/app-menu.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/layouts/app.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/layouts/components.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/layouts/footer.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/layouts/customizer.js') }}"></script>
<!-- END: Theme JS-->

<script src="{{ asset('assets/dashboard/js/vue.js') }}"></script>


@yield('script')

</body>
<!-- END: Body-->
</html>
