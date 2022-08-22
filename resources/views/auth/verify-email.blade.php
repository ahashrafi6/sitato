<x-auth-layout>
    <x-auth.auth-card>

        <h3 class="text-2xl mb-2 text-right dir-rtl dark:text-white">تبریک، عضو خانواده بزرگ اشتراک وردپرس شدید!</h3>
        <p class="text-sm text-gray-400 text-right">قبل از شروع هرکاری باید حساب کاربری خود را فعال نمایید. لینک فعالسازی به ایمیل شما ارسال شده است، بر روی لینک فعالسازی در ایمیلتان کلیک کنید</p>
        <div class="flex items-center mt-3 dir-rtl">
            <i class="fad fa-exclamation-circle text-md text-yellow-500 pl-2"></i>
            <span class="text-xs text-gray-500 dark:text-yellow-300">در صورت نبود ایمیل در inbox لطفا بخش spam و promotion را هم چک کنید</span>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="my-4 font-medium text-sm text-green-600">
               لینک فعالسازی مجدد به ایمیل شما ارسال شد
            </div>
        @endif

        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button>
                        ارسال مجدد ایمیل فعالسازی
                    </x-button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="text-sm text-gray-600 hover:text-gray-900 dark:text-white">
                    خروج از حساب
                </button>
            </form>
        </div>
    </x-auth.auth-card>
</x-auth-layout>
