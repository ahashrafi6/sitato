<x-auth.auth-card>

    <h3 class="text-2xl mb-2 text-right dir-rtl dark:text-white">به سایتاتو خوش آمدید 👋</h3>
    <p class="text-sm text-gray-400 mb-8">وارد حساب کاربری خود شوید یا به خانواده بزرگ سایتاتو بپیوندید</p>

    <!-- Session Status -->
    <x-auth.auth-session-status class="mb-4" :status="session('status')"/>

    <form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
        <div>
            <x-auth.label for="email" value="ایمیل"/>

            <x-auth.input wire:model.lazy="email" id="email" class="block mt-1 w-full" type="email" name="email"
                          :value="old('email')" required
                          autofocus/>
            <x-auth.auth-validation-error name="email"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-auth.label for="password" value="پسورد"/>

            <x-auth.input wire:model.lazy="password" id="password" class="block mt-1 w-full"
                          type="password"
                          name="password"
                          required autocomplete="current-password"/>
            <x-auth.auth-validation-error name="password"/>
        </div>


        <div class="flex items-center justify-between mt-4 dir-rtl">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                       class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                       name="remember">
                <span class="mr-2 text-sm text-gray-600 dark:text-white">مرا به خاطر بسپار</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 hover:text-gray-900 dark:text-white"
                   href="{{ route('password.request') }}">
                    پسورد خود را فراموش کردید؟
                </a>
            @endif

        </div>

        <div class="block mt-4 float-right" wire:ignore>
            <div class="g-recaptcha" data-sitekey="6LdnpPQaAAAAAEHwvTffi0d2LiGjA2xoNP-NYdN0"></div>
        </div>
        <div class="w-full flex items-center dir-rtl float-right mt-2 mb-4">
            @error('g-recaptcha-response')
            <i class="fad fa-exclamation-circle text-sm text-red-300 pl-1"></i>
            <p class="text-red-500 text-xs">لطفا از فعال بودن گزینه امنیتی
                شناسایی ربات مطمئن شوید</p>
            @enderror
        </div>

        <div class="block">
            <div wire:ignore>
                @if(request('redirect'))
                    <input type="hidden" name="redirect" value="{{ request('redirect') }}">
                @endif
            </div>

            <button type="submit" class="btn btn-primary w-full">
                ورود
            </button>
        </div>

        <div class="block mt-4">
            <span class="text-sm text-gray-500 dark:text-white">هنوز عضو نشدید؟</span>
            <a class="text-sm text-gray-900 dark:text-primary-400 font-bold" href="{{ route('register') }}">
                عضویت
            </a>
        </div>
    </form>

    <div class="relative flex justify-center my-5">
        <h3 class="text-xs text-gray-400 z-10 relative dark:bg-gray-900 bg-gray-100 px-3">
            یا ورود به حساب با
        </h3>
        <i class="absolute top-1/2 transform -translate-y-1/2 z-0 right-0 w-full flex border-t border-gray-400 border-opacity-30"></i>
    </div>
    <a href="{{ route('login.google') }}" class="bg-white hover:bg-gray-50 transition rounded-md p-3 text-sm flex items-center justify-center text-gray-500 gap-3">
        <span>ورود با جیمیل</span>
        <img width="30px" src="{{ asset('assets/site/images/gmail-icon.png') }}" alt="">
    </a>

</x-auth.auth-card>

