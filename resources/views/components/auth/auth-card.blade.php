<div class="min-h-screen grid grid-cols-5">

    <div class="min-h-screen hidden xl:block xl:col-span-2 p-8 bg-white dark:bg-gray-800 transition duration-500 auth-product">
        <a href="/">
            <img class="w-12 inline-block float-left" src="{{ asset(asset('assets/site/images/icon.png')) }}" alt="سایتاتو">
        </a>
    </div>
    <div class="min-h-screen col-span-5 xl:col-span-3 bg-gray-100 dark:bg-gray-900 overflow-hidden md:flex items-center justify-center p-10 md:p-0 transition duration-500">
        <div class="w-full md:max-w-lg">
            {{ $slot }}
        </div>
    </div>

</div>

