<x-slot name="style">

</x-slot>

<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
        <div class="col-span-12 lg:col-span-8 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">سرویس ها</h4>
            <a href="{{ $product->path() }}" target="_blank" class="text-sm text-gray-500 dark:text-gray-400">{{ $product->fa_title }}</a>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-12 lg:col-span-6 mb-3 lg:mb-0">
            <div class="bg-white dark:bg-gray-600 p-5 rounded-lg transition-all duration-500">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="fal fa-stopwatch p-4 bg-yellow-200 text-yellow-500 text-xl rounded-full"></i>
                        <div>
                            <p class="dark:text-white mb-1">سرویس 6 ماه پشتیبانی بیشتر</p>
                            <x-site.info-modal :name="4">
                                <x-slot name="button">
                             <span class="text-sm text-gray-500 cursor-pointer">
                                <i class="fal fa-info-circle"></i>
                                   قوانین
                             </span>
                                </x-slot>

                                <x-slot name="title">قوانین 6 ماه پشتیبانی بیشتر</x-slot>

                                <ul class="text-sm text-justify text-gray-500 dark:text-white">
                                    <li class="mb-4">1- طبق قوانین اشتراک وردپرس، کاربر پس از خرید لایسنس نقدی یک محصول، 6 ماه پشتیبانی رایگان پیش فرض دریافت میکند که پس از اتمام این 6 ماه درصورت نیاز میتواند آن را تمدید کند. سرویس 6 ماه پشتیبانی بیشتر امکان تمدید 6 ماهه را برای کاربر با 20 درصد تخفیف را در همان ابتدای خرید محصول فراهم می کند.</li>
                                </ul>

                            </x-site.info-modal>
                        </div>
                    </div>
                    <div x-data="{tab: @entangle('extend_support')}">
                        <div class="flex items-center bg-gray-100 dark:bg-gray-700 rounded text-sm p-1">
                            <div class="text-gray-400 py-2 px-4 cursor-pointer"
                                 :class="{'bg-white rounded text-green-500': tab}"
                                 wire:click="active('extend_support')">
                                فعال
                            </div>
                            <div class="text-gray-400 py-2 px-4 cursor-pointer"
                                 :class="{'bg-white rounded text-red-500': !tab}"
                                 wire:click="disable('extend_support')">
                                غیر فعال
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-6 mb-3 lg:mb-0">
            <div class="bg-white dark:bg-gray-600 p-5 rounded-lg transition-all duration-500">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="fal fa-stopwatch p-4 bg-yellow-200 text-yellow-500 text-xl rounded-full"></i>
                        <div>
                            <p class="dark:text-white mb-1">سرویس پشتیبانی سریع</p>
                            <x-site.info-modal :name="4">
                                <x-slot name="button">
                             <span class="text-sm text-gray-500 cursor-pointer">
                                <i class="fal fa-info-circle"></i>
                                   قوانین
                             </span>
                                </x-slot>

                                <x-slot name="title">قوانین سرویس پشتیبانی سریع</x-slot>

                                <ul class="text-sm text-justify text-gray-500 dark:text-white">
                                    <li class="mb-4">1- کاربر پس از خرید سرویس پشتیبانی سریع در واقع میتواند تیک هایی ثبت کند که دارای تنها 2 ساعت زمان پاسخگویی است که باید توسط شما طی این 2 ساعت پاسخ داده شود در غیر اینصورت کاربر میتواند درخواست بازگشت وجه پشتیبانی سریع را ثبت نماید.</li>
                                    <li class="mb-4">2- بازه زمانی پاسخ دهی به تیکت های پشتیبانی سریع از ساعت 8 صبح تا 10 روزهای کاری است، در خارج از این بازه مجبور به پاسخ دهی نیستید.</li>
                                    <li class="mb-4">3- در پاسخ دهی دقت لازم را داشته باشید تا صرفا جهت وقت تلف کردن نباشد، در صورت نارضایتی کاربر علاوه بر بازگشت هزینه پشتیبانی سریع، جریمه نیز اعمال خواهد شد.</li>
                                    <li class="mb-4">4- توجه کنید که کاربر در بازه پشتیبانی سریع محدودیت در ارسال تیکت دارد و قادر به ارسال تیکت های بیش از حد مجاز نیست.</li>
                                </ul>

                            </x-site.info-modal>
                        </div>
                    </div>
                    <div x-data="{tab: @entangle('quick_support')}">
                        <div class="flex items-center bg-gray-100 dark:bg-gray-700 rounded text-sm p-1">
                            <div class="text-gray-400 py-2 px-4 cursor-pointer"
                                 :class="{'bg-white rounded text-green-500': tab}"
                                 wire:click="active('quick_support')">
                                فعال
                            </div>
                            <div class="text-gray-400 py-2 px-4 cursor-pointer"
                                 :class="{'bg-white rounded text-red-500': !tab}"
                                 wire:click="disable('quick_support')">
                                غیر فعال
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-6 mb-3 lg:mb-0">
            <div class="bg-white dark:bg-gray-600 p-5 rounded-lg transition-all duration-500">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <i class="fal fa-cog p-4 bg-yellow-200 text-yellow-500 text-xl rounded-full"></i>
                        <div>
                            <p class="dark:text-white mb-1">سرویس نصب محصول</p>
                            <x-site.info-modal :name="4">
                                <x-slot name="button">
                             <span class="text-sm text-gray-500 cursor-pointer">
                                <i class="fal fa-info-circle"></i>
                                   قوانین
                             </span>
                                </x-slot>

                                <x-slot name="title">قوانین سرویس نصب محصول</x-slot>

                                <ul class="text-sm text-justify text-gray-500 dark:text-white">
                                    <li class="mb-4">1- هزینه نصب 50 هزار تومان است که سهم اشتراک وردپرس و فروشنده بر اساس توافق همکاری محصولات است.</li>
                                    <li class="mb-4">2- حداکثر فرصت نصب برای هدر درخواست 24 ساعت است.</li>
                                    <li class="mb-4">3- در صورت عدم نصب به موقع کاربر می تواند درخواست بازگشت وجه کند.</li>
                                </ul>

                            </x-site.info-modal>
                        </div>
                    </div>

                    <div x-data="{tab: @entangle('product_install')}">
                        <div class="flex items-center bg-gray-100 dark:bg-gray-700 rounded text-sm p-1">
                            <div class="text-gray-400 py-2 px-4 cursor-pointer"
                                 :class="{'bg-white rounded text-green-500': tab}"
                                 wire:click="active('product_install')">
                                فعال
                            </div>
                            <div class="text-gray-400 py-2 px-4 cursor-pointer"
                                 :class="{'bg-white rounded text-red-500': !tab}"
                                 wire:click="disable('product_install')">
                                غیر فعال
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<x-slot name="script">

</x-slot>
