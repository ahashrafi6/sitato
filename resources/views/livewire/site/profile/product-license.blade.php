<x-slot name="style">
    <link rel="stylesheet" href="{{ asset('assets/site/css/highlight.min.css') }}">
</x-slot>

<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
        <div class="col-span-12 lg:col-span-8 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">لایسنس ها</h4>
            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $product->fa_title }}</span>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-3">
        <div class="col-span-12 mb-3 lg:mb-0">
            <div class="bg-white dark:bg-gray-700 p-5 rounded-lg transition-all duration-500 mb-8">
                <div class="mb-5">
                    <span class="font-bold dark:text-white">توکن محصول</span>
                    <span class="text-xs text-gray-500 mr-2">(حتما کپی شود)</span>
                </div>
                <div class="relative">
                    <x-auth.input id="product-token" class="w-full bg-gray-100" type="text" value="{{ $product->token }}"/>
                    <div data-id="product-token" class="copy-btn absolute top-1 left-1 bg-gray-200 rounded-md py-1.5 px-2.5 cursor-pointer">
                        <i class="fal fa-copy"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-700 p-5 rounded-lg transition-all duration-500 mb-4">
                <p class="text-center dark:text-white mb-2">می توانید طبق راهنما زیر، لایسنس گذاری روی محصول را انجام دهید</p>
                <p class="text-center text-blue-500 text-sm">لطفا تمام نکات را با دقت بالا اجرا کنید، زیرا درآمد محصول شما به لایسنس گذاری صحیح وابسته است</p>
            </div>
            <div class="bg-white dark:bg-gray-700 p-5 rounded-lg transition-all duration-500 mb-4">
                <p class="dark:text-white font-bold text-lg mb-5">فایل لایسنس</p>
                <ul class="text-sm text-gray-500 dark:text-gray-300 flex flex-col gap-4">
                    <li>- فایل لایسنس را دانلود و در پوشه محصول (قالب یا افزونه) قرار بدهید.</li>
                    <li>- فایل لایسنس را میتوانید در پوشه های (تو در تو) در مسیر مد نظر خود در پوشه اصلی محصول قرار بدید تا به راحتی قابل شناسایی نباشد.</li>
                    <li>- سپس باید فایل لایسنس را با دستورات (include یا require یا require_once) در محصول خود، طبق مسیری که فایل را قرار داید فراخوانی کنید.</li>
                    <li>- اگر تسلط کافی دارید میتوانید نام کلاس اصلی و متد init را در این فایل، به نام دلخواه خود تغییر دهید، توجه کنید که مشکلی در عملکرد آن ایجاد نشود.</li>
                    <li>- میتوانید فایل لایسنس و فایل اصلی قالب یا افزونه خود مانند فایل functions.php را با ابزارهایی نظیر (ionCube) کد گذاری کنید تا امنیت لایسنس شما بالاتر باشد.</li>
                    <li>- توجه داشته باشید که برای عملکرد درست لایسنس باید نسخه PHP سرور حداقل 7.2 باشد.</li>
                </ul>
                <div class="text-center my-8">
                    <a href="" class="btn btn-green">دانلود فایل لایسنس</a>
                </div>
                <div class="mb-5">
                    <ul class="text-sm text-gray-500 dark:text-gray-300 flex flex-col gap-4 mb-3">
                        <li>موارد زیر را باید با دقت طبق برای هر محصول به صورت مجزا در این فایل تغییر دهید و از یک فایل نمیتوانید برای چند محصول استفاده کنید:</li>
                        <li>در متد ( subwp_licence_init ) در فایل لایسنس موارد زیر را با دقت طبق محصول خود ویرایش کنید:</li>
                    </ul>
                    <p class="font-bold dark:text-white my-3">1- عنوان فارسی محصول</p>
                    <p class="dark:text-white">عنوان فارسی دلخواه محصول را برای مقدار (name) وارد کنید</p>
                    <p class="font-bold dark:text-white my-3">2- slug محصول</p>
                    <p class="dark:text-white">برای مقدار (slug) باید مقدار اولیه your_product_name را مطابق محصول خود صورت دلخواه و لاتین وارد کنید</p>
                    <p class="font-bold dark:text-white my-3">3- توکن محصول</p>
                    <p class="dark:text-white">توکن محصول شما در بالای همین صفحه وجود دارد که باید برای مقدار (product_token) وارد کنید</p>
                    <p class="font-bold dark:text-white my-3">4- option محصول</p>
                    <p class="dark:text-white">برای مقدار (option_name) باید مقدار اولیه your_product_name را مطابق محصول خود به صورت دلخواه و لاتین وارد کنید</p>
                    <p class="font-bold dark:text-white my-3">5- نسخه محصول</p>
                    <p class="dark:text-white"> باید نسخه محصول خود را طبق ساختار (0.0.0) برای مقدار product_version قرار دهیدو توجه کنید در هر بار ارسال آپدیت علاوه بر تغییر نسخه در فایل اصلی محصول در فایل لایسنس هم باید مطابق آن تغییر داده شود</p>
                    <p class="font-bold dark:text-white my-3">4- لایسنس نقدی</p>
                    <p class="dark:text-white">اگر در اشتراک وردپرس نوع لایسنس محصول روی (لایسنس نقدی /یا/ لایسنس نقدی - اشتراکی) تنظیم کردید باید مقدار cash_status برابر true و در غیر اینصورت false باشد</p>
                    <p class="font-bold dark:text-white my-3">4- لایسنس اشتراکی</p>
                    <p class="dark:text-white">اگر در اشتراک وردپرس نوع لایسنس محصول روی (لایسنس اشتراکی /یا/ لایسنس نقدی - اشتراکی) تنظیم کردید باید مقدار subscribe_status برابر true و در غیر اینصورت false باشد</p>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-700 p-5 rounded-lg transition-all duration-500 mb-4">
                <p class="dark:text-white font-bold text-lg mb-5">اعتبارسنجی</p>
                <ul class="text-sm text-gray-500 dark:text-gray-300 flex flex-col gap-4">
                    <li>- توجه کنید قبل از استفاده از کد اعتبارسنجی زیر، باید تمام مراحل آماده سازی فایل لایسنس که در بخش بالا ذکر شده است را کامل و صحیح انجام داده باشید و فایل لایسنس را در محصول خود فراخوانی کرده باشید.</li>
                    <li>- شما میتوانید از کد اعتبار سنجی زیر در بخش های مختلف محصول خود استفاده کنید و دسترسی های اساسی و ویژه محصول خود را فقط در صورت فعال بودن لایسنس در اختیار کاربر قرار دهید.</li>
                    <li>- توجه کنید در سمت فرانت اند سایت کاربر هیچگونه محدودیتی نباید اعمال کنید و تمام محدودیت ها باید سمت پیشخوان وردپرس باشد.</li>
                    <li>- همچنین توصیه میشود هم فایل لایسنس و هم تمام فایل هایی که در آن از کد اعتبار سنجی استفاده کردید جهت امنیت بیشتر لایسنس محصول، با ابزار (ionCube) کدگذاری نمایید.</li>
                </ul>

                <p class="my-5 dark:text-white">در بخشی که نوشته شده (Enable Pro Features, Your Product is Active Now // ) کدهایی که بعد از فعال سازی محصول باید اعمال شوند را قرار دهید، به طور مثال میتوانید کدهایی که باعث فعال شدن پنل تنظیمات محصول شما میشود را قرار دهید.</p>

                <pre>
                    <code class="text-left dir-ltr">
$whitelist = array('127.0.0.1','localhost','::1');
$localhost = false;
if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){$localhost = true;} else {$localhost = false;}

if(Subwp_Licence::is_activated() === true && $localhost === true) {
   // Enable Pro Features, Your Product is Active Now
}

                    </code>
                </pre>

            </div>
        </div>
    </div>

</div>

<x-slot name="script">

    <script src="{{ asset('assets/site/js/highlight.min.js') }}"></script>

    <script>
        hljs.highlightAll();
    </script>

</x-slot>
