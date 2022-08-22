<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="app">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <title>صفحه مورد نظر یافت نشد!</title>

    <link rel="shortcut icon" href="{{ asset('assets/site/images/subwp-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/css/site.css') }}">

</head>

<body class="dark:bg-gray-800">
    <div class="flex flex-col justify-center items-center mx-auto max-w-lg p-5 dir-rtl gap-4">
        <img src="{{ asset('assets/site/images/404.png') }}" alt="404">
        <p class="text-gray-700 dark:text-white text-xl lg:text-3xl font-bold">صفحه مورد نظر یافت نشد!</p>
        <p class="text-gray-500">با عرض پوزش، چنین صفحه‌ای در سایت وجود ندارد یا این صفحه از سایت پاک شده است.</p>
        <a href="/" class="btn btn-primary">بازگشت به سایت</a>
    </div>


    <script src="{{ asset('assets/site/js/site.js') }}"></script>
</body>
</html>
