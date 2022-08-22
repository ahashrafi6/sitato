<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="app">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>در حال بروزرسانی هستیم!</title>

    <link rel="shortcut icon" href="{{ asset('assets/site/images/subwp-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/site.css') }}">

</head>

<body class="dark:bg-gray-800">
<div class="flex flex-col justify-center items-center mx-auto max-w-lg p-5 dir-rtl gap-4 mt-8">
    <img src="{{ asset('assets/site/images/icon.png') }}" class="mb-3" alt="404">
    <p class="text-gray-700 dark:text-white text-xl lg:text-3xl font-bold">درحال برزرسانی سرور هستیم!</p>
    <p class="text-gray-500">با عرض پوزش، تا دقایقی دیگر برمیگردیم</p>
    <a href="/" class="btn btn-primary">بازگشت به سایت</a>
</div>


<script src="{{ asset('assets/site/js/site.js') }}"></script>
</body>
</html>
