<div x-data="{ openModal: false , errorModal: {{ $errors->count() > 0 ? 'true' : 'false' }} }">
    <div @click="openModal = !openModal">
        {{ $slot }}
    </div>
    <div x-show="openModal || errorModal"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="fixed top-0 bottom-0 right-0 w-full h-full z-10">
        <div class="fixed top-0 bottom-0 right-0 w-full h-full bg-black opacity-60"></div>
        <div @click.away="openModal = false" class="bg-white dark:bg-gray-700 rounded-lg overflow-hidden shadow-xl transform transition-all w-11/12 lg:w-4/12 mx-auto mt-16 py-8 px-6 dir-rtl relative">
            <p class="text-2xl font-bold mb-3 dark:text-white text-center">ورود</p>
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div>
                    <x-auth.label for="email" value="ایمیل"/>

                    <x-auth.input id="email" class="block mt-1 w-full" type="email" name="email"
                                  :value="old('email')" required
                                  autofocus/>
                    <x-auth.auth-validation-error name="email"/>
                </div>

                <div class="mt-4">
                    <x-auth.label for="password" value="پسورد"/>

                    <x-auth.input  id="password" class="block mt-1 w-full"
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

                <div class="block mt-4">
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
        </div>
    </div>
</div>
