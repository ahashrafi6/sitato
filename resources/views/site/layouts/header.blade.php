<header
    class="header-section custom-shadow dark:shadow-none bg-white dark:bg-gray-700 w-full z-60 transition duration-500 fixed">
    <div class="max-w-8xl mx-auto flex items-center justify-between dir-rtl h-20 relative px-5">

        @include('site.layouts.phone-menu')

        <div class="flex items-center h-full">
            <a class="hidden lg:block dark:hidden" href="/">
                <img class="w-48"
                     src="{{ asset('assets/site/images/logo.png') }}"
                     alt="اشتراک وردپرس"></a>
            <a class="hidden lg:dark:block" href="/">
                <img class="w-48"
                     src="{{ asset('assets/site/images/logo-dark.png') }}"
                     alt="اشتراک وردپرس"></a>

            @include('site.layouts.menu')
        </div>
        <div class="flex items-center">
<!--            <a href="" class="hover:opacity-70 hidden xl:block">
                <span class="text-gray-700 dark:text-gray-400">021-32776978</span>
                <i class="fal fa-phone-alt text-xl text-gray-500 cursor-pointer bg-gray-100 rounded-full w-11 h-11 text-center py-3"></i>
            </a>-->


            <x-site.cart-modal>
                <i class="fal fa-shopping-bag relative text-xl text-gray-500 cursor-pointer bg-gray-100 rounded-full w-11 h-11 text-center py-2.5 mr-3 hover:opacity-70">
                    @if($cart_count)
                        <span
                            class="bg-primary-400 rounded-full w-6 h-6 flex items-center justify-center text-white absolute -top-2 -right-2 text-xs z-10">
                            {{ $cart_count }}
                    </span>
                    @endif
                </i>
            </x-site.cart-modal>

            <i id="dark"
               class="fal fa-moon text-xl text-gray-500 dark:text-primary-600 cursor-pointer bg-gray-100 rounded-full w-11 h-11 text-center py-3 mr-3 hover:opacity-70"></i>

            @auth
                <a href="{{ route('profile.index') }}" class="btn btn-green shadow-none px-3 py-2 lg:py-3 lg:px-6 rounded-full mr-3">
                    <i class="fal fa-user text-lg pl-0 lg:pl-1.5"></i>
                    <span class="hidden lg:inline-block">حساب کاربری</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="btn btn-green shadow-none px-3 py-2 lg:py-3 lg:px-6 rounded-full mr-3">
                    <i class="fal fa-user text-lg pl-0 lg:pl-1.5"></i>
                    <span class="hidden lg:inline-block">ورود به حساب</span>
                </a>
            @endauth
        </div>
    </div>
</header>
