<x-slot name="style">

</x-slot>

<div class="dir-rtl">

    <form method="POST" wire:submit.prevent="addToCart">
        @csrf

        <p class="text-xl lg:text-2xl font-yekan-black mb-5 dark:text-white text-center mt-16">سفارش برنامه جدید</p>

        <p class="lg:text-xl font-bold mb-5 dark:text-white">انتخاب نوع برنامه</p>
        <ul class="flex items-center gap-3 mb-16">
            <li class="bg-primary-400 rounded-md py-3 px-4 flex items-center gap-1.5 cursor-pointer">
                <i class="fal fa-code text-white text-lg"></i>
                <span class="text-white text-sm font-bold">سیستم اختصاصی (اسکریپت)</span>
            </li>
            <li class="bg-white dark:bg-gray-700 rounded-md py-3 px-4 flex items-center gap-1.5">
                <i class="fal fa-code text-gray-400 dark:text-bg-gray-200 text-lg"></i>
                <span class="text-gray-700 dark:text-white text-sm">وردپرس (بزودی)</span>
            </li>
        </ul>

        <p class="lg:text-xl font-bold mb-5 dark:text-white">انتخاب برنامه</p>
        <div class="grid grid-cols-12 gap-3">

            <div class="col-span-12 md:col-span-6 lg:col-span-4">
                <div
                    class="bg-white dark:bg-gray-700 dark:text-white rounded-xl p-8 flex flex-col items-center text-center">
                    <img width="50px" class="mb-5" src="{{ asset('assets/site/images/learnato-icon.png') }}" alt="">
                    <p class="text-lg lg:text-xl font-yekan-black">پلتفرم جامع آموزشی لِـــرناتو</p>
                    <p class="text-lg text-gray-500 mt-2">Learnato LMS</p>

                    <p class="my-8">اولین سایت ساز آموزشی ایرانی با امکانات کامل و بی‌نظیر</p>

                    <span class="text-gray-500">دارای ۲ پلن</span>

                    <i class="fal fa-check-circle text-3xl text-primary-400 mt-5"></i>
                    <span class="text-primary-400 text-sm">انتخاب شده</span>
                </div>

            </div>
            <div class="col-span-12 md:col-span-6 lg:col-span-4">

                <div
                    class="bg-gray-200 dark:bg-gray-700 dark:text-white rounded-xl p-8 flex flex-col justify-center text-center h-full">
                    <p class="text-lg lg:text-xl font-yekan-black">سایر اسکریپت ها</p>
                    <p class="text-lg text-gray-500 mt-2">بزودی</p>
                </div>
            </div>
        </div>

        <p class="lg:text-xl font-bold mt-16 dark:text-white">انتخاب پلن</p>
        <div class="my-5 bg-gray-200 text-center p-3 rounded-lg"><a href=""
                class="text-sm lg:text-md text-blue-500">مشاهده امکانات کامل پلن ها</a></div>
        <div class="grid grid-cols-12 gap-3 plans-holder">

            @foreach ($plans as $key => $plan)
            <div class="col-span-12 md:col-span-6 lg:col-span-3">

                <input type="radio" id="plan_{{ $key }}" wire:model="plan_select" value="{{ $plan->id }}">
                <label for="plan_{{ $key }}"
                    class="bg-white dark:bg-gray-700 dark:text-white rounded-xl p-5 flex flex-col items-center text-center cursor-pointer relative">

                    <p class="text-lg lg:text-xl font-yekan-black">پلن {{ $plan->fa_title }}</p>
                    <p class="text-lg text-gray-500 mt-2">{{ $plan->en_title }} plan</p>

                    <ul class="text-sm text-gray-500 dark:text-white flex flex-col gap-3 my-5">
                        @foreach (explode(',' , $plan->description) as $li)
                        <li>{{ $li }}</li>
                        @endforeach
                       
                    </ul>

                    <div class="flex flex-col gap-2">
                        <span class="text-xl lg:text-2xl font-yekan-black text-primary-400">
                        
                            @if ($plan->isOff())
                                {{   number_format($plan->offPrice)  }}
                            @else
                            {{   number_format($plan->price)  }}
                            @endif

                            <span class="text-sm font-bold text-gray-500">تومان</span>
                        </span>
                    </div>

                    <i class="fal fa-check-circle text-3xl text-primary-400 mt-5 absolute top-2 left-5"
                        style="display: none"></i>
                </label>

            </div>
            @endforeach
    
        </div>


        <p class="lg:text-xl font-bold mt-16 dark:text-white mb-5">انتخاب سرور میزبانی</p>

        <p class="text-lg font-bold dark:text-white mb-2">دوره تمدید</p>
        <div class="grid grid-cols-12 gap-3 plans-holder">
            <div class="col-span-12 lg:col-span-4">
                <select wire:model="per_select" class="border-0 rounded-md">
                    @foreach ($per as $key => $item)
                    <option value="{{ $key }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>

        </div>


        <div class="grid grid-cols-12 gap-3 plans-holder">

            @foreach ($servers as $key => $item)
            <div class="col-span-12 md:col-span-6">

                <input type="radio" id="server_{{ $key }}" wire:model="server_select" value="{{ $item->id }}">
                <label for="server_{{ $key }}"
                    class="bg-white dark:bg-gray-700 dark:text-white rounded-xl p-5 flex flex-col items-center text-center cursor-pointer relative">

                    <p class="text-lg lg:text-xl font-yekan-black">{{ $item->fa_title }}</p>
                    <p class="text-lg text-gray-500 mt-2 mb-3">موقیعت: ایران</p>

                    <p class="my-3 text-lg font-bold">{{ $item->sum }}</p>

                    <div class="flex items-center flex-col lg:flex-row gap-3 lg:gap-10">

                        <div>
                            <p>منابع برنامه</p>
                            <ul class="text-sm text-gray-500 dark:text-white flex flex-col gap-3 my-5">
                                @foreach (explode(',' , $item->server) as $server)
                                <li>{{ $server }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div>
                            <p>منابع دیتابیس</p>
                            <ul class="text-sm text-gray-500 dark:text-white flex flex-col gap-3 my-5">
                                @foreach (explode(',' , $item->database) as $server)
                                <li>{{ $server }}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>

                    <div class="flex flex-col gap-2">
                        @switch($per_select)
                        @case(3)
                        <span>مبلغ ۳ ماهه</span>
                        @break
                        @case(12)
                        <span>مبلغ سالانه</span>
                        @break

                        @default
                        <span>مبلغ ماهانه</span>

                        @endswitch

                        <span class="text-xl lg:text-2xl font-yekan-black text-primary-400">{{
                            number_format($item->price * (int)$per_select) }} <span
                                class="text-sm font-bold text-gray-500">تومان</span></span>
                    </div>

                    <i class="fal fa-check-circle text-3xl text-primary-400 mt-5 absolute top-2 left-5"
                        style="display: none"></i>

                    @if ($item->isSpecial)
                    <span
                        class="text-sm text-white bg-blue-400 rounded-md py-2 px-3 absolute top-2 right-2">پیشنهادی</span>
                    @endif


                </label>

            </div>
            @endforeach

        </div>



{{--         <p class="lg:text-xl font-bold mt-16 dark:text-white mb-5">انتخاب شناسه برنامه</p>
        <div class="my-5 bg-gray-200 text-center p-3 rounded-lg text-sm">
            هر برنامه باید شناسه‌ای یکتا داشته باشد. شناسه‌ی برنامه، همان Subdomain برنامه‌ی‌تان خواهد بود که از طریق آن
            می‌توانید به برنامه دسترسی داشته باشید. برای مثال، اگر شناسه را my-website وارد کنید، از طریق
            my-website.iran.sitato.ir به آن دسترسی خواهید داشت. بعد از ایجاد برنامه می‌توانید دامنه‌ی دلخواه‌تان را نیز
            به آن اضافه کنید.
        </div>
        <div class="grid grid-cols-12 gap-3 plans-holder">
            <div class="col-span-12 lg:col-span-6">
                <div class="flex items-center">
                    <div class="bg-gray-200 p-2.5 text-sm dir-ltr rounded-r-md">.iran.sitato.ir</div>
                    <x-auth.input wire:model.debounce.500ms="username" class="block w-full dir-ltr" type="text"
                        placeholder="یک شناسه منحصر به فرد به انگلیسی وارد کنید" />
                    <div class="bg-gray-200 p-2.5 text-sm dir-ltr rounded-l-md">https://</div>
                </div>
                <x-auth.auth-validation-error name="username" />
            </div>

        </div> --}}


        <p class="lg:text-xl font-bold mt-16 dark:text-white mb-5">آیتم‌های انتخابی</p>
        <div class="bg-white dark:bg-gray-700 p-8 flex flex-col lg:flex-row gap-5 items-center justify-between rounded-lg">
           
            <div>
                <div class="flex flex-col lg:flex-row mb-5 gap-1 items-center">
                    <span class="text-lg font-bold">مبلغ پلن انتخابی: {{ number_format($this->getPlanPrice()) }} <span class="text-xs">تومان</span></span>
                    <span class="text-sm text-blue-400">( یکبار پرداخت، دسترسی مادام العمر )</span>
                </div>
                <div class="flex flex-col lg:flex-row gap-1 items-center">
                    <span class="text-lg font-bold">مبلغ سرور انتخابی: {{ number_format($this->getServerPrice() * $per_select) }} <span class="text-xs">تومان</span></span>
                    <span class="text-sm text-blue-400">
                        (
                            @switch($per_select)
                            @case(3)
                            <span>دوره پرداخت ۳ ماهه</span>
                            @break
                            @case(12)
                            <span>دوره پرداخت سالانه</span>
                            @break
    
                            @default
                            <span>دوره پرداخت ماهانه</span>
    
                            @endswitch
                        )
                    </span>
                </div>
            </div>

            <div class="flex justify-center flex-col gap-4">
                <span class="text-2xl font-yekan-black text-primary-400">{{ number_format($this->getServerPrice() * $per_select + $this->getPlanPrice())  }}<span class="text-sm text-gray-500">تومان</span></span>
                <span>مبلغ کل</span>
            </div>
        </div>
        
        <div class="flex justify-end mt-5">
            <span wire:loading wire:target="addToCart" class="text-xs text-primary-500">منتظر باشید...</span>
            <button wire:loading.remove wire:target="addToCart" type="submit" class="btn btn-primary">افزودن به سبد خرید</button>
        </div>
    </form>

  
</div>

<x-slot name="script">

</x-slot>