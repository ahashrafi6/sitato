<x-auth-layout>
    <x-auth.auth-card>


        <div class="flex items-center dir-rtl mb-8">
            <i class="fad fa-lock-open-alt text-5xl pl-4 text-primary-500"></i>
            <div class="flex flex-col justify-center">
                <h3 class="text-2xl mb-2 text-right dir-rtl dark:text-white">پسورد خود را فراموش کردید؟</h3>
                <p class="text-sm text-gray-400"> مشکلی نیست! ایمیلتان را وارد کنید تا لینک تغییر پسورد برایتان ایمیل
                    شود</p>
            </div>
        </div>

        <!-- Session Status -->
        <x-auth.auth-session-status class="mb-4" :status="session('status')"/>

        <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
            <div>
                <x-auth.label for="email" value="ایمیل"/>

                <x-auth.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                         autofocus/>
                <x-auth.auth-validation-error name="email"/>
            </div>

            <div class="block mt-4">

                <button type="submit" class="btn btn-primary w-full">
                    ارسال ایمیل تغییر پسورد
                </button>

            </div>
            <div class="flex items-center mt-3 dir-rtl">
                <i class="fad fa-exclamation-circle text-md text-yellow-500 pl-2"></i>
                <span class="text-xs text-gray-500 dark:text-yellow-300">در صورت نبود ایمیل در inbox لطفا بخش spam و promotion را هم چک کنید</span>
            </div>
        </form>
    </x-auth.auth-card>
</x-auth-layout>
