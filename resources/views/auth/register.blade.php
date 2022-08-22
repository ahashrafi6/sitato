<x-auth.auth-card>

    <div class="flex items-center dir-rtl mb-8">
        <i class="fad fa-user-plus text-5xl pl-4 text-primary-500"></i>
        <div class="flex flex-col justify-center">
            <h3 class="text-2xl mb-2 text-right dir-rtl dark:text-white">عضویت در سایتاتو</h3>
            <p class="text-sm text-gray-400">بسیار خرسندیم که به خانواده سایتاتو می پیوندید</p>
        </div>
    </div>

    <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
       <div class="md:grid md:grid-cols-2 md:gap-1 dir-rtl">
           <div class="mb-3 md:mb-0">
               <div class="flex items-center justify-between">
                   <x-auth.label for="name" value="نام"/>
                   <span class="text-gray-500 dark:text-white text-xs">(ترجیحا فارسی)</span>
               </div>

               <x-auth.input wire:model.lazy="name" id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                        autofocus/>
               <x-auth.auth-validation-error name="name"/>
           </div>
           <div>
               <div class="flex items-center justify-between">
                   <x-auth.label for="name" value="نام خانوادگی"/>
                   <span class="text-gray-500 dark:text-white text-xs">(ترجیحا فارسی)</span>
               </div>

               <x-auth.input wire:model.lazy="family" id="family" class="block mt-1 w-full" type="text" name="family" :value="old('family')" required
                        autofocus/>
               <x-auth.auth-validation-error name="family"/>
           </div>
       </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-auth.label for="email" value="ایمیل"/>

            <x-auth.input wire:model.lazy="email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required/>
            <x-auth.auth-validation-error name="email"/>
        </div>

        <div class="md:grid md:grid-cols-2 md:gap-1 dir-rtl">
            <!-- Password -->
            <div class="mb-3 md:mb-0">
                <x-auth.label for="password" value="پسورد"/>

                <x-auth.input wire:model.lazy="password" id="register-password" class="block mt-1 w-full"
                            type="password"
                              name="password"
                              required autocomplete="new-password"/>

              <div>
                <div id="strong-bar" class="strong-bar transition"></div>
                <p id="strong-msg" class="strong-msg"></p>
            </div>

            </div>

            <!-- Confirm Password -->
            <div class="mb-3 md:mb-0">
                <x-auth.label for="password_confirmation" value="تکرار پسورد"/>

                <x-auth.input wire:model.lazy="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                              type="password"
                              name="password_confirmation" required/>
            </div>
            
        </div>

        <x-auth.auth-validation-error name="password"/>

        <ul class="mt-3 dir-rtl dark:bg-gray-800 rounded-md text-gray-500 text-sm password-help overflow-hidden" id="password-help">
            <li>حداقل 8 کاراکتر</li>
            <li>حروف کوچک و بزرگ انگلیسی</li>
            <li>شامل عدد</li>
            <li>شامل کارکتر علائم ویژه (*)</li>
        </ul>


        <div class="flex items-center justify-end mt-4">
            <a class="text-sm text-gray-600 hover:text-gray-900 dark:text-white" href="{{ route('login') }}">
                قبلا عضو شده اید؟
            </a>
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

        <div class="block mt-4">
            <button type="submit" class="btn btn-primary w-full">
                عضویت
            </button>
        </div>
        <div class="flex items-center mt-3 dir-rtl">
            <i class="fad fa-exclamation-circle text-md text-yellow-500 pl-2"></i>
            <span class="text-xs text-gray-500 dark:text-yellow-300">لینک تایید عضویت برایتان ایمیل میشود(بخش  spam و promotion چک شود)</span>
        </div>
        <div class="flex items-center dir-rtl mt-3">
            <i class="fad fa-exclamation-circle text-md text-green-500 pl-2"></i>
            <span class="text-xs text-gray-500 dark:text-green-500">خرید و استفاده از خدمات، به منزله موافقت شما با <a
                    class="font-bold"
                    target="_blank"
                    href="{{ route('terms') }}">قوانین اشتراک وردپرس</a> است.
                            </span>
        </div>

        <div class="relative flex justify-center my-5">
            <h3 class="text-xs text-gray-400 z-10 relative dark:bg-gray-900 bg-gray-100 px-3">
                یا ثبت نام با
            </h3>
            <i class="absolute top-1/2 transform -translate-y-1/2 z-0 right-0 w-full flex border-t border-gray-400 border-opacity-30"></i>
        </div>
        <a href="{{ route('login.google') }}" class="bg-white hover:bg-gray-50 transition rounded-md p-3 text-sm flex items-center justify-center text-gray-500 gap-3">
            <span>ثبت نام با جیمیل</span>
            <img width="30px" src="{{ asset('assets/site/images/gmail-icon.png') }}" alt="">
        </a>
    </form>


</x-auth.auth-card>

