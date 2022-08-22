<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="app">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Subwp') }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/site/css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/scss/site.css') }}">
    @livewireStyles
</head>
<body>
<div id="loading-holder" class="fixed top-0 right-0 left-0 bottom-0 bg-white dark:bg-gray-800 z-100 flex items-center justify-center">
    <img src="{{ asset('assets/site/images/loading-icon.gif') }}" alt="loading">
</div>

{{ $slot }}

<script src="{{ asset('assets/site/js/site.js?ver=1.0') }}"></script>
<script src="{{ asset('assets/site/js/alpine.js') }}" defer></script>
@livewireScripts
<script src="{{ asset('assets/site/js/livewire.js') }}" defer></script>

</body>
</html>



