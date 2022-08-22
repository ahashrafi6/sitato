<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="app">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title' , 'قالب وردپرس | پوسته وردپرس | اشتراک وردپرس')</title>

    <link rel="shortcut icon" href="{{ asset('assets/site/images/subwp-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/scss/site.css') }}">

    {{ $head }}
    @livewireStyles
</head>

<body class="bg-white dark:bg-gray-900 transition duration-500">
<div id="loading-holder" class="fixed top-0 right-0 left-0 bottom-0 bg-white dark:bg-gray-800 z-100 flex items-center justify-center">
    <img src="{{ asset('assets/site/images/loading-icon.gif') }}" alt="loading">
</div>

@include('site.layouts.header')
{{ $slot }}
@include('site.layouts.footer')

<script src="{{ asset('assets/site/js/site.js') }}"></script>
<script src="{{ asset('assets/site/js/alpine.js') }}" defer></script>
@livewireScripts
<script src="{{ asset('assets/site/js/livewire.js') }}" defer></script>
{{ $script }}

</body>
</html>
