<footer class="footer-section relative overflow-hidden mt-10 max-w-8xl mx-auto bg-white dark:bg-gray-700 shadow-2xl rounded-t-lg dark:shadow-none box px-8 py-8 lg:pt-12 lg:px-12 transition duration-500">
    <div class="z-1 bg-section absolute -top-10 -right-10 opacity-10 transform rotate-45"></div>
    <div class="z-2 relative grid grid-cols-1 md:grid-cols-5 gap-8 lg:gap-16 dir-rtl">
        <div class="md:col-span-2">
            <h4 class="text-gray-700 dark:text-white text-md xl:text-lg font-bold mb-5">رسالت اشتراک وردپرس</h4>
            <p class="text-justify text-sm text-gray-500 dark:text-gray-300 leading-loose">اشتراک وردپرس اولین مارکت اشتراکی وردپرس ایران است، هدف توسعه دهندگان اشتراک وردپرس فراهم کردن محصولات اورجینال و محصولات ایرانی با کیفیت و پشتیبانی متمایز است تا شما بتوانید با هزینه بسیار مناسب و تجربه کیفیت و خدمات بالا، سایت و کسب و کار آنلاین خود را راه اندازی کنید.</p>
        </div>
        <div>
            <h4 class="text-gray-700 dark:text-white text-md xl:text-lg font-bold mb-5">اشتراک وردپرس</h4>
            <ul class="footer-menu">
                <li class="mb-5"><a class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-300" href="{{ route('quick-support') }}">پشتیبانی سریع</a></li>
                <li class="mb-5"><a class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-300" href="{{ route('contact') }}">تماس با ما</a></li>
                <li class="mb-5"><a class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-300" href="{{ route('articles') }}">مقالات</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-gray-700 dark:text-white text-md xl:text-lg font-bold mb-5">راهنما</h4>
            <ul class="footer-menu">
                <li class="mb-5"><a class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-300" href="{{ route('faq') }}">سوالات متداول</a></li>
                <li class="mb-5"><a class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-300" href="{{ route('terms') }}">قوانین استفاده</a></li>
                <li class="mb-5"><a class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-300" href="{{ route('product-rules') }}">قوانین انتشار محصول</a></li>
            </ul>
        </div>
        <div>
            <h4 class="text-gray-700 dark:text-white text-md xl:text-lg font-bold mb-5">همراه ما باشید</h4>
            <div class="flex items-center gap-4">
                <a href=""
                   class="rounded-md p-4 flex flex-col items-center justify-center shadow-md bg-gradient-to-t from-yellow-400 via-red-500 to-pink-500 w-1/2 hover:shadow-xl">
                    <i class="fab fa-instagram text-5xl text-white mb-3"></i>
                    <span class="text-xs text-white">اینستاگرام</span>
                </a>
                <a href=""
                   class="rounded-md p-4 flex flex-col items-center justify-center shadow-md bg-gradient-to-r from-red-400 to-red-500 w-1/2 hover:shadow-xl">
                    <i class="fab fa-youtube text-5xl text-white mb-3"></i>
                    <span class="text-xs text-white">یوتیوب</span>
                </a>
            </div>
        </div>
    </div>
    <div class="z-2 relative my-8 custom-shadow rounded-lg grid grid-cols-2 dir-rtl overflow-hidden gap-8 lg:gap-0">
        <div class="col-span-2 lg:col-span-1 flex justify-around items-center bg-white">
            <div class="flex items-center">
                <img width="50px" src="{{ asset('assets/site/images/seller-footer-icon.png') }}" alt="فروشنده شوید">
                <div class="mr-3">
                    <a href="{{ route('become-seller') }}" class="text-sm text-gray-700 mb-1">فروشنده شو</a>
                    <p class="text-xs text-gray-500">درآمد بالا برای افراد متخصص</p>
                </div>
            </div>
            <div class="flex items-center">
                <img width="50px" src="{{ asset('assets/site/images/affiliate-footer-icon.png') }}" alt="فروشنده شوید">
                <div class="mr-3">
                    <a href="{{ route('affiliate') }}" class="text-sm text-gray-700 mb-1">همکار ما شو</a>
                    <p class="text-xs text-gray-500">از درآمد میلیونی ماهانه نمیشه گذشت!</p>
                </div>
            </div>
        </div>
        <div
            class="col-span-2 lg:col-span-1 p-5 flex flex-col lg:flex-row items-center justify-between gap-3 lg:gap-0 bg-gray-100">
            <div>
                <p class="text-gray-700 mb-3 text-center lg:text-right">پاسخگوی سوالات شما هستیم</p>
                <p class="text-gray-500 text-xs text-center lg:text-right">سوال خود را در تیکت مطرح کنید تا سریعا
                    پاسخگوی شما باشیم</p>
            </div>
            <a href="{{ route('profile.tickets.create') }}" class="btn btn-green px-8">ارسال تیکت</a>
        </div>
    </div>
    <div class="z-2 relative flex items-center justify-between dir-rtl">
        <div class="text-gray-400 text-sm gap-2 hidden md:flex items-center">
            <span class="copyright-icon opacity-20 dark:opacity-80"></span>
            <span>تمامی حقوق برای سایت اشتراک وردپرس محفوظ است</span>
        </div>

        <div class="flex items-center gap-2 text-gray-800 dark:text-white text-xs md:text-sm dir-rtl">
            <i class="fal fa-code text-sm md:text-xl text-primary-400"></i>
            <span>با</span>
            <i class="fal fa-heartbeat text-sm md:text-xl text-primary-400"></i>
            <span>و</span>
            <i class="fal fa-mug-hot text-sm md:text-xl text-primary-400"></i>
            <span>در اشتراک وردپرس</span>
        </div>
    </div>
</footer>

