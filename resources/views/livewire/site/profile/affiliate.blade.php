<x-slot name="style">

</x-slot>
<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
        <div class="col-span-12 lg:col-span-10 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">همکاری در فروش</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">آمار همکاری در فروش شما</p>
        </div>

    </div>

    <div>
        <div x-data="{ tab: @entangle('type') }">

            <div class="flex flex-wrap items-center gap-5 mb-8">
                <button class="bg-gray-200 rounded-md py-2 w-1/4  focus:ring-0 focus:outline-none"
                        :class="{ 'bg-primary-400 text-white': tab === 'link' }" @click="tab = 'link'">
                    <i class="fal fa-link text-lg"></i>
                    <span>دریافت لینک</span>
                </button>
                <button class="bg-gray-200 rounded-md py-2 w-1/4 focus:ring-0 focus:outline-none"
                        :class="{ 'bg-primary-400 text-white': tab === 'transaction' }" @click="tab = 'transaction'">
                    <i class="fal fa-chart-bar text-lg"></i>
                    <span>درآمد ها</span>
                </button>
            </div>

            <div class="pt-8" x-show.transition="tab === 'link'">
                @if($verified)
                    <div class="bg-white p-8 rounded-lg dark:bg-gray-700 duration-500 dark:text-white">
                        <p class="font-bold text-lg mb-3">لینک های اشتراک گذاری شما</p>
                        <p>با اشتراک گذاری لینک های شما در سایت ها و شبکه های اجتماعی اگر کاربری وارد سایت شود و خرید
                            نماید تا 7 روز پس از ورود کاربر، 7% از تمام سفارشات آن دریافت خواهید کرد.</p>

                        <div class="my-8">
                            <p class="font-bold text-lg mb-3">لینک صفحه نخست سایت</p>
                            <div class="flex items-center gap-1">
                                <i data-id="affiliate-link"
                                   class="fal fa-copy copy-btn cursor-pointer text-lg p-3 bg-gray-300 dark:bg-gray-500 rounded-md"></i>
                                <input id="affiliate-link"
                                       class="focus:ring-0 border-0 rounded-md w-full bg-gray-100 dark:bg-gray-500 p-3"
                                       type="text" value="{{ url('/') . '?affid=' .$user->affid  }}">
                            </div>
                            <div class="flex items-center gap-2 mt-5">
                                <i class="fal fa-share-alt text-xl"></i>
                                <span class="text-sm">اشتراک گذاری</span>
                                <ul class="flex items-center gap-2">
                                    <li>
                                        <a target="_blank"
                                           href="https://twitter.com/intent/tweet?url={{ url('/') . '?affid=' .$user->affid  }}&text=پیشنهاد میکنم به هیچ عنوان این محصولات رو از دست نده"><i
                                                class="fab fa-twitter text-lg text-gray-400 bg-white rounded p-2"></i></a>
                                    </li>
                                    <li>
                                        <a target="_blank"
                                           href="https://telegram.me/share/url?url={{ url('/') . '?affid=' .$user->affid  }}&text=پیشنهاد میکنم به هیچ عنوان این محصولات رو از دست نده"><i
                                                class="fab fa-telegram text-lg text-gray-400 bg-white rounded p-2"></i></a>
                                    </li>
                                    <li>
                                        <a target="_blank"
                                           href="https://www.linkedin.com/shareArticle?mini=true&url={{ url('/') . '?affid=' .$user->affid  }}&title=پیشنهاد میکنم به هیچ عنوان این محصولات رو از دست نده"><i
                                                class="fab fa-linkedin text-lg text-gray-400 bg-white rounded p-2"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="my-8">
                            <p class="font-bold text-lg mb-3">لینک ویژه محصول</p>
                            <p>لینک همکاری در فروش ویژه شما برای هر محصول به صورت مجزا در صفحه همان محصول در اختیار
                                شماست.</p>

                        </div>

                    </div>
                @else
                    <div
                        class="overflow-y-scroll h-80 bg-white p-8 rounded-lg dark:bg-gray-700 duration-500 dark:text-white">
                        <p>شرایط و قوانین استفاده از سامانه همکاری در فروش</p>

                        <p>به سامانه همکار ی در فروش اشتراک وردپرس خوش آمدید.</p>

                        <p>شما در این سامانه امکان ارائه خدمات تبلیغاتی و کسب درآمد از سایت اشتراک وردپرس را پیدا خواهید نمود.</p>

                        <p>همکار گرامی لطفًا موارد زیر را جهت استفاده بهینه از برنامه های کاربردی سامانه همکار ی در فروش
                            اشتراک وردپرس به دقت ملاحظه فرمایید.</p>

                        <p>ورود شما به سامانه همکار ی در فروش و همچنین استفاده از خدمات آن به معنای آگاه بودن و پذیرفتن
                            تمامی شرایط و قوانین استفاده از این سامانه و همچنین نحوه صحیح استفاده از آن است.</p>

                        <p>همچنین پذیرش این قوانین به منزله ثبت نام در سیستم همکار ی در فروش اشتراک وردپرس خواهد بود.</p>


                        <p class="font-bold">شرایط پذیرش همکاران</p>

                        <p>همکار می‌بایست به منظور درج لینک اشتراک وردپرس در “وبسایت” خود حتما موارد زیر را رعایت کند :</p>

                        <p>• از نظر طراحی و گرافیک وب، در سطح مطلوب باشد.</p>

                        <p>• دارای پاپ آپ یا نمایش بیش از حد تبلیغات نباشد.</p>

                        <p>• دارای مطالب و محتوای کافی و آرشیو باشد.</p>

                        <p>• حاوی اطلاعات ناقص و یا ناهمگون نباشد.</p>

                        <p>• حاوی مطالب غیر اخلاقی و خلاف مصلحت عمومی نباشد.</p>

                        <p>• فعالیت سیاسی نداشته باشد.</p>

                        <p>• مطابق با قوانین و مقررات حاکم باشد.</p>

                        <p>• دارای مطالبی که باعث گمراهی افراد برای ورود به سایت اشتراک وردپرس شود، نباشد. به عنوان مثال حاوی لینکی
                            با عنوان 'برای ورود به سایت اصلی اشتراک وردپرس اینجا کلیک کنید' نباشد.</p>

                        <p>• همکاران موظف اند از آوردن نام اشتراک وردپرس در آدرس, عنوان و لوگوی رسانه ی خود(سایت یا شبکه‌ی اجتماعی)
                            خودداری نمایند.</p>

                        <p>• همکاران می‌بایست در جریان باشند که فعالیت بهینه سازی گوگل روی کلمه اشتراک وردپرس ممنوع است.</p>

                        <p>تبصره: لازم به توضیح است که موارد بالا به تشخیص اشتراک وردپرس مورد بررسی می گیرد و در صورت مشاهده،
                            دسترسی کاربر از سیستم همکاری در فروش اشتراک وردپرس گرفته خواهد شد و همکار حق اعتراض برای تجدید نظر را
                            نخواهد داشت. همکار با آگاهی از این امر اقدام به دریافت لینک نموده و نمی تواند ادعای ورود خسارت
                            را داشته باشد.</p>


                        <p class="font-bold">شرایط پرداخت</p>

                        <p>درآمد همکار بر اساس شروط پرداخت و نرخ های اعلام شده در اشتراک وردپرس بعد از هر تراکنش محاسبه و به کیف
                            پول همکاری در فروش همکار واریز می‌گردد، لیکن واریز آن به شماره حساب همکار پس از رسیدن به حد نصاب
                            مشخص شده و در‌خواست واریز از جانب همکار (در پنل خود، درخواست تسویه) به صورت ماهانه
                            انجام می‌شود به این صورت که درخواست های هر ماه در اول تا پنجم ماه بعد انجام خواهند شد. تایید
                            پرداخت ها هم به صورت اتوماتیک طبق همین رویه انجام می‌شود. اشتراک وردپرس در هر زمانی حق دارد که شرایط
                            پرداخت را بر اساس نرخ‌های جدید اصلاح نماید. ادامه فعالیت پس از تغییر نرخ‌ها، به منزله تایید ضمنی
                            همکار می‌باشد.</p>

                        <p>درآمد سایت های همکار از انجام خرید ها تا قبل از رسیدن مبلغ موجودی همکار به حداقل مبلغ معین شده
                            در سامانه همکاری (قسمت تسویه حساب) نزد اشتراک وردپرس به صورت امانت تا هر زمانی که مبلغ به حداقل برسد،
                            باقی خواهد ماند.</p>

                        <p>تبصره 1: با توجه به اینکه کمیسیون فروش در قبال ترغیب مشتری برای خرید محصول از اشتراک وردپرس پرداخت
                            می‌شود، در صورت استفاده مشتری از کد تخفیف برای ثبت سفارش، به جهت اعمال اثر کد تخفیف در خرید
                            مشتری، محاسبه مبلغ کمسیون همکار از مبلغ پرداختی نهایی مشتری انجام خواهد شد.</p>

                        <p>تبصره 2: توسعه دهندگان و فروشندگان اشتراک وردپرس اجازه درج لینک همکاری در فروش خود و یا دیگران را در
                            توضیحات محصولات، پیش نمایش، فایل آموزش محصول، لینک‌های درج شده در داخل محصولات قبل و پس از نصب،
                            دیدگاه محصولات، تیکت های پشتیبانی و هر کانال داخلی اشتراک وردپرس را نداشته و در صورت تخلف از این مسئله
                            اشتراک وردپرس این اجازه را دارد دسترسی همکار مربوط به آن لینک را مسدود کرده و درآمد حاصل از این همکاری در
                            فروش را از فروشنده کسر کند.</p>

                        <p class="font-bold">حل اختلاف</p>

                        <p>طرفین تصریح و توافق دارند که محل انعقاد و اجرای قرارداد شهر تهران می باشد. در صورت بروز اختلاف،
                            مرجع صالح، دادگستری های شهر تهران می باشد. این بند مانع از توافق طرفین، در هر زمانی، برای حل
                            دوستانه و مسالمت آمیز موضوعات نمی باشد.</p>

                        <p class="font-bold">قوه قهریه</p>

                        <p>تمامی شرایط و قوانین مندرج، در شرایط عادی قابل اجرا است و در صورت بروز هرگونه از موارد قوه
                            قهریه، اشتراک وردپرس هیچ گونه مسئولیتی ندارد.</p>
                    </div>
                    <div class="flex justify-end mt-8">
                        <button wire:click="affiliate_verified" class="btn btn-primary">پذیرش قوانین و دریافت لینک
                            همکاری
                        </button>
                    </div>
                @endif
            </div>

            <div class="pt-8" x-show.transition="tab === 'transaction'">
                <div class="grid grid-cols-4 gap-3 dir-rtl">
                    <div
                        class="col-span-4 xl:col-span-1 bg-white rounded-xl p-5 shadow-xl flex gap-4 items-center dark:bg-gray-700 duration-500 text-gray-600 dark:text-white">
                        <i class="fal fa-coins text-3xl"></i>
                        <div>
                            <h3 class="text-xl mb-2">{{ number_format($data['total_affiliate']) }}</h3>
                            <p class="text-sm">درآمد کل</p>
                        </div>
                    </div>
                    <div
                        class="col-span-4 xl:col-span-1 bg-white rounded-xl p-5 shadow-xl flex gap-4 items-center dark:bg-gray-700 duration-500 text-gray-600 dark:text-white">
                        <i class="fal fa-coin text-3xl"></i>
                        <div>
                            <h3 class="text-xl mb-2">{{ number_format($data['current_affiliate']) }}</h3>
                            <p class="text-sm">درآمد جاری قابل دریافت</p>
                        </div>
                    </div>
                    <div
                        class="col-span-4 xl:col-span-1 bg-white rounded-xl p-5 shadow-xl flex gap-4 items-center dark:bg-gray-700 duration-500 text-gray-600 dark:text-white">
                        <i class="fal fa-chart-bar text-3xl"></i>
                        <div>
                            <h3 class="text-xl mb-2">{{ $data['day_affiliate_count'] }}</h3>
                            <p class="text-sm">تراکنش های امروز</p>
                        </div>
                    </div>
                    <div
                        class="col-span-4 xl:col-span-1 bg-white rounded-xl p-5 shadow-xl flex gap-4 items-center dark:bg-gray-700 duration-500 text-gray-600 dark:text-white">
                        <i class="fal fa-money-bill text-3xl"></i>
                        <div>
                            <h3 class="text-xl mb-2">{{ number_format($data['day_affiliate_price']) }}</h3>
                            <p class="text-sm">درآمد امروز</p>
                        </div>
                    </div>
                </div>
                <div class="bg-yellow-100 rounded-md p-5 dark:text-black mt-8 text-sm">
                    اشتراک وردپرس در شنبه هر هفته تمام درآمد های (در انتظار) شما را بررسی میکند و مجموع آن را به (درآمد
                    جاری قابل دریافت) شما اضافه میکند. اگر درآمد جاری شما بیش از 100 هزار تومان باشد میتوانید
                    <a class="text-yellow-500" href="{{ route('profile.withdraws') }}">درخواست تسویه حساب</a>
                    خود را ثبت کنید. کلیه درخواست های تسویه حساب همکاری در فروش ثبت شده در اولین شنبه هر ماه به حساب
                    بانکی شما واریز می‌گردد.
                </div>
                <div class="bg-white p-8 rounded-lg dark:bg-gray-700 duration-500 dark:text-white mt-5">
                    <p class="mb-8 font-bold text-lg">لیست 20 درآمد آخر شما</p>
                    @if(isset($data['lists']) && count($data['lists']) > 0)
                        <table class="border-collapse table-fixed w-full text-sm">
                            <thead>
                            <tr>
                                <th class="border-b dark:border-gray-600 font-medium p-4 pl-8 pt-0 pb-3 text-right dark:text-white">
                                    شناسه فاکتور
                                </th>
                                <th class="border-b dark:border-gray-600 font-medium p-4 pr-8 pt-0 pb-3 text-right dark:text-white">
                                    مبلغ
                                </th>
                                <th class="border-b dark:border-gray-600 font-medium p-4 pr-8 pt-0 pb-3 text-right dark:text-white">
                                    محصول
                                </th>
                                <th class="border-b dark:border-gray-600 font-medium p-4 pr-8 pt-0 pb-3 text-right dark:text-white">
                                    وضعیت
                                </th>
                                <th class="border-b dark:border-gray-600 font-medium p-4 pr-8 pt-0 pb-3 text-right dark:text-white">
                                    تاریخ
                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-700 transition duration-500">
                            @foreach($data['lists'] as $item)
                                <tr>
                                    <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                                        {{ $item['factor']['resNumber'] }}
                                    </td>
                                    <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                                        {{ number_format($item['price']) }}
                                    </td>
                                    <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                                        {{ \App\Models\Product::find($item['product_id'])->fa_title }}
                                    </td>
                                    <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                                        @if($item['status'] == 'completed')
                                            <span class="bg-green-50 text-green-400 text-xs p-2 rounded-md">انجام شده</span>
                                        @elseif($item['status'] == 'pending')
                                            <span
                                                class="bg-orange-50 text-orange-400 text-xs p-2 rounded-md">در انتظار</span>
                                        @else
                                            <span class="bg-red-50 text-red-400 text-xs p-2 rounded-md">رد شده</span>
                                        @endif
                                    </td>
                                    <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                                        {{ f_date($item['created_at']) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="flex flex-col justify-center items-center my-10">
                            <img class="w-16" src="{{ asset('assets/site/images/empty-cart-icon.png') }}">
                            <p class="text-sm text-gray-400 text-center mt-5 dark:text-white">هیچ درآمدی تا این لحظه یافت
                                نشد!</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>


</div>
<x-slot name="script">

</x-slot>


