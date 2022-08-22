<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="app">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title' , config('app.name', 'Subwp'))</title>

    <link rel="shortcut icon" href="{{ asset('assets/site/images/icon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/scss/site.css') }}">
    @livewireStyles
</head>

<body class="bg-gray-100 dark:bg-gray-900 antialiased transition duration-500">
<div id="loading-holder" class="fixed top-0 right-0 left-0 bottom-0 bg-white dark:bg-gray-800 z-100 flex items-center justify-center">
    <img src="{{ asset('assets/site/images/loading-icon.gif') }}" alt="loading">
</div>

<div class="flex flex-col lg:flex-row overflow-hidden" x-data="{resMenu: false}">
    <div class="w-full lg:w-9/12 p-4 lg:p-8 transition-all duration-500">
        @include('site.profile.layouts.header')
        @yield('body')
    </div>
    <div class="fixed right-0 bottom-0 top-0 lg:right-0 w-80 lg:w-3/12 p-5 min-h-screen max-h-screen transition-all duration-500" :class="{'-right-full': resMenu !== true}">
        @include('site.profile.layouts.sidebar')
    </div>
</div>

<script src="{{ asset('assets/site/js/site.js?ver=1.0') }}"></script>
<script src="{{ asset('assets/site/js/alpine.js') }}" defer></script>
@yield('script')
@livewireScripts
<script src="{{ asset('assets/site/js/livewire.js') }}" defer></script>
</body>

</html>
