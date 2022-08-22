<div
    class="bg-white dark:bg-gray-700 rounded-3xl py-3 px-1 lg:p-8 dir-rtl relative h-full overflow-hidden transition duration-500">
    <div class="absolute top-4 left-4">
        <i x-show="resMenu" @click="resMenu = !resMenu"
            class="fal fa-arrow-right text-xl text-gray-500 dark:text-gray-300 cursor-pointer"></i>
    </div>
    <div class="flex items-center justify-center lg:justify-between">
        <a class="block lg:hidden" href="/"><img class="w-12" src="{{ asset('assets/site/images/icon.png') }}"
                alt="اشتراک وردپرس"></a>
        <a class="hidden lg:block dark:hidden" href="/"><img class="w-38"
                src="{{ asset('assets/site/images/logo.png') }}" alt="اشتراک وردپرس"></a>
        <a class="hidden lg:dark:block" href="/"><img class="w-38" src="{{ asset('assets/site/images/logo-dark.png') }}"
                alt="اشتراک وردپرس"></a>
    </div>

 
        <div class="mt-5 overflow-hidden overflow-y-auto h-full">

            <ul>
                <li class="mb-5">
                    <a href="{{ route('index') }}" class="flex items-center gap-3 hover:opacity-80">
                        <i
                            class="fal fa-tachometer-slow text-2xl text-gray-400 {{ \Illuminate\Support\Facades\Route::is('index') ? 'text-primary-400' : '' }}"></i>
                        <span class="dark:text-gray-300 text-lg">داشبورد</span>
                    </a>
                </li>
                <li class="mb-5">  
                    <a href="{{ route('projects') }}" class="flex items-center gap-3 hover:opacity-80">
                        <i
                            class="fal fa-box text-2xl text-gray-400 {{ \Illuminate\Support\Facades\Route::is('projects') ? 'text-primary-400' : '' }}"></i>
                        <span class="dark:text-gray-300 text-lg">برنامه ها</span>
                    </a>
                </li>

                <li class="mb-5">
                    <a href="{{ route('invoices') }}" class="flex items-center gap-3 hover:opacity-80">
                        <i
                            class="fal fa-receipt text-2xl text-gray-400 {{ \Illuminate\Support\Facades\Route::is('invoices') ? 'text-primary-400' : '' }}"></i>
                        <span class="dark:text-gray-300 text-lg">صورتحساب ها</span>
                    </a>
                </li>

                <li class="mb-5">
                    <a href="{{ route('tickets') }}" class="flex items-center gap-3 hover:opacity-80">
                        <i
                            class="fal fa-ticket text-2xl text-gray-400 {{ \Illuminate\Support\Facades\Route::is('tickets') ? 'text-primary-400' : '' }}"></i>
                        <span class="dark:text-gray-300 text-lg">تیکت ها</span>
                    </a>
                </li>

            </ul>


        </div>

    </div>

</div>