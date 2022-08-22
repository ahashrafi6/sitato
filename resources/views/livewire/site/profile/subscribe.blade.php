<x-slot name="style">

</x-slot>
<div class="dir-rtl">
    <div class="grid grid-cols-12 mt-5 mb-8">
        <div class="col-span-12 lg:col-span-10 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">اشتراک ها</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">اشتراک های خریداری شده شما</p>
        </div>
        @if($subscribes)
            <div class="col-span-12 lg:col-span-2">
                <select wire:model="count"
                        class="w-full rounded-md bg-white dark:bg-gray-600 dark:text-white transition duration-500 p-4 pr-10 border-0 focus:ring-primary-400 focus:shadow-xl focus:outline-none">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </select>
            </div>
        @endif
    </div>

    <div class="text-left my-5">
        <a href="{{ route('subscribe') }}" class="btn btn-primary">خرید اشتراک جدید</a>
    </div>

    <p class="dark:text-white" wire:loading>صبور باشید...</p>

    @if($subscribes)
        <div wire:loading.remove>
            @foreach($subscribes as $key => $item)
                <div class="rounded-lg hover:shadow-xl duration-200 relative mb-5">
                    @if($item['expire_at'] > now())
                        <div class="absolute left-3 top-5 text-sm">
                            <span class="text-green-500 hidden xl:inline-block">{{ f_date($item['expire_at']) }}</span>
                            <span
                                class="text-sm text-white bg-green-400 rounded-lg p-2">اعتبار تا: {{ d_date($item['expire_at']) }}</span>
                        </div>
                    @else
                        <div class="absolute left-3 top-5 text-sm">
                            <span class="text-red-500 hidden xl:inline-block">{{ f_date($item['expire_at']) }}</span>
                            <span class="text-white bg-red-400 rounded-lg p-2 animate-pulse">منقضی شده</span>
                        </div>
                    @endif

                    <div class="p-5 bg-white dark:bg-gray-700 rounded-t-lg transition duration-500">
                        <p class="text-lg dark:text-white">دامنه: <span class="font-bold">{{ $item['domain'] }}</span>
                        </p>
                        <div class="mt-5 flex flex-wrap gap-3 items-center">
                            <x-site.info-modal :name="4">
                                <x-slot name="button">
                                    <a href="#" class="btn btn-primary">تغییر دامنه</a>
                                </x-slot>

                                <x-slot name="title">تغییر دامنه</x-slot>

                                <p class="text-sm text-primary-500 mb-3">دامنه
                                    فعلی: {{ $item['domain'] }}</p>

                                <p class="mb-3 text-yellow-500">تعداد دفعات مجاز تغییر دامنه: {{ $item['switch_count'] }} از {{ env('SUBSCRIBE_DOMAIN_CHANGE') }}</p>


                                @if($item['switch_count'] < env('SUBSCRIBE_DOMAIN_CHANGE'))
                                    <ul>
                                        <li class="dark:text-gray-300 text-sm mb-3">1- دامنه را بدون (www) و بدون (//:https
                                            یا //:http) وارد نمایید
                                        </li>
                                        <li class="text-red-500 text-sm mb-3"><span class="font-bold">توجه:</span>
                                            دامنه خود را با دقت فراوان وارد نمایید چون محدودیت تغییر وجود دارد.
                                        </li>
                                        <li class="dark:text-gray-300 text-gray-400 text-sm">نمونه صحیح:
                                            domain.com
                                        </li>
                                    </ul>
                                    <form method="POST"
                                          wire:submit.prevent="Domain({{ $item['id'] }})">
                                        @csrf
                                        <div class="mt-4">
                                            <x-auth.input wire:model.defer="domain" class="block w-full"
                                                          placeholder="دامنه"
                                                          type="text"
                                                          name="domain"
                                                          required/>
                                        </div>

                                        <div class="flex justify-between mt-2 items-center">
                                            <span><x-auth.auth-validation-error name="domain"/></span>
                                            <button type="submit" class="btn btn-green cursor-pointer">ثبت</button>
                                        </div>
                                    </form>
                                @else
                                    <div class="bg-red-100 p-3 rounded-md text-red-500 text-sm">
                                        تعداد دفعات تغییر دامنه مجاز شما به اتمام رسیده است و امکان تغییر دامنه برای این لایسنس نیست، در صورت نیاز باید لایسنس اشتراکی جدید خریداری کنید.
                                    </div>
                                @endif


                            </x-site.info-modal>
                            <x-site.info-modal :name="4">
                                <x-slot name="button">
                                    <a href="#" class="btn btn-yellow">افزایش اعتبار</a>
                                </x-slot>

                                <x-slot name="title">افزایش اعتبار</x-slot>


                                @if($item['expire_at'] > now())
                                    <p class="text-sm text-blue-500 mb-3">اعتبار خریداری شده به اعتبار فعلی شما اضافه می
                                        شود.</p>
                                @endif

                                <form method="POST"
                                      wire:submit.prevent="Renew({{ $item['id'] }})">
                                    @csrf
                                    <div class="mt-4">
                                        @foreach($plans as $plan)
                                            <div class="flex flex-col">
                                                <label class="cursor-pointer mb-3">
                                                    <input wire:model.defer="plan" type="radio" name="plan"
                                                           value="{{ $plan->en_title }}"
                                                           class="cursor-pointer focus:outline-none text-primary-400 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus:text-primary-400">
                                                    <span class="text-sm text-gray-600 mr-1 dark:text-gray-200">
                                                        {{ $plan->fa_title }}
                                                        /
                                                        + <span class="text-lg font-bold">{{ $plan->gift }}</span> روز هدیه
                                                        /
                                                        <span>
                                                            @if(!is_null($plan->offPrice))
                                                                @if($discount_percent > 0)
                                                                    <span
                                                                        class="text-lg line-through">{{ small_price($plan->offPrice) }}</span>
                                                                    <span
                                                                        class="text-2xl font-bold">{{ small_price($plan->offPrice - (($plan->offPrice * $discount_percent) / 100)) }}</span>
                                                                @else
                                                                    <span
                                                                        class="text-lg line-through">{{ small_price($plan->price) }}</span>
                                                                    <span
                                                                        class="text-2xl font-bold">{{ small_price($plan->offPrice) }}</span>
                                                                @endif
                                                            @else
                                                                @if($discount_percent > 0)
                                                                    <span
                                                                        class="text-lg line-through">{{ small_price($plan->price) }}</span>
                                                                    <span
                                                                        class="text-2xl font-bold">{{ small_price($plan->price - (($plan->price * $discount_percent) / 100)) }}</span>
                                                                @else
                                                                    <span
                                                                        class="text-2xl font-bold">{{ small_price($plan->price) }}</span>
                                                                @endif
                                                            @endif
                                                        </span> هزار تومان
                                                    </span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div x-data="{discount: false}" class="mt-4">
                                        <label for="discount" class="inline-flex items-center">
                                            <input @click="discount = !discount" id="discount" type="checkbox"
                                                   class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                                                   name="remember">
                                            <span class="mr-2 text-sm text-gray-600 dark:text-white">کدتخفیف دارم</span>
                                        </label>
                                        <div class="relative mt-2" x-show="discount">
                                            <input type="text" wire:model.lazy="discount_code"
                                                   class="text-sm rounded-md py-3 shadow-sm border-gray-300 focus:border-primary-100 transition block w-full"
                                                   placeholder="اگر کد تخفیف دارید وارد نمایید">
                                            <span wire:click="applyDiscount"
                                                  class="cursor-pointer bg-blue-400 rounded-md absolute left-2 top-2 py-1.5 px-3 text-sm text-white hover:bg-blue-500 focus:outline-none">اعمال تخفیف</span>
                                            @if (session()->has('error'))
                                                <div class="flex items-center dir-rtl mt-1">
                                                    <i class="fad fa-exclamation-circle text-sm text-red-300 pl-1"></i>
                                                    <p class="text-red-500 text-xs">{{ session('error') }}</p>
                                                </div>
                                            @endif
                                            @if (session()->has('success'))
                                                <div
                                                    class="flex items-center dir-rtl mt-1 bg-green-100 p-3 rounded-md border-2 border-green-300">
                                                    <p class="text-success-500 text-xs">{{ session('success') }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex justify-end mt-2 items-center">
                                        <button type="submit" class="btn btn-green cursor-pointer">پرداخت</button>
                                    </div>
                                </form>


                            </x-site.info-modal>
                            <x-site.info-modal :name="4">
                                <x-slot name="button">
                                    <a href="#" class="btn btn-orange">
                                        <i class="fal fa-download"></i>
                                        دانلود محصول
                                    </a>
                                </x-slot>

                                <x-slot name="title">دانلود محصول</x-slot>

                                <p class="text-sm text-blue-500 mb-3">جهت دانلود محصول بخشی از عنوان محصول را جستجو
                                    کنید</p>

                                <form method="POST"
                                      wire:submit.prevent="Download">
                                    @csrf

                                    <div class="flex items-center gap-2">
                                        <input
                                            class="rounded-md p-3 shadow-sm bg-gray-100 border-gray-300 focus:border-0 focus:outline-none focus:ring-0 transition block mt-1 w-full"
                                            wire:model.defer="search" required="required"
                                            placeholder="عنوان محصول مورد نظر شما ...">
                                        <button type="submit" class="btn btn-green p-4 text-xs">جستجو</button>
                                    </div>
                                </form>

                                @if(!is_null($downloads))
                                    @foreach($downloads as $item)
                                        <div class="bg-gray-100 rounded-md p-3 mt-3 flex flex-col">
                                            <p class="mb-2">{{ $item->fa_title }}</p>
                                            <div class="flex items-center gap-2">
                                                <a href="{{ download_s3($item->files['main_file']['key']) }}"
                                                   class="btn btn-green text-xs">فایل اصلی</a>
                                                <a href="{{ download_s3($item->files['cash_file']['key']) }}"
                                                   class="btn btn-gray text-xs">فایل بروزرسانی</a>
                                                <a href="{{ download_s3($item->files['help_file']['key']) }}"
                                                   class="btn btn-gray text-xs">فایل راهنما</a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <p wire class="text-gray-500 text-sm mt-3">چیزی یافت نشد! عنوان محصول را دقیق جستجو کنید</p>
                                @endif

                            </x-site.info-modal>
                        </div>
                    </div>
                    <div
                        class="bg-gray-200 dark:bg-gray-500 rounded-b-lg p-3 transition duration-500 block lg:flex flex-wrap items-center justify-between">
                        <div>
                            <i class="fal fa-lock-open-alt"></i>
                            <span class="text-sm">توکن فعالسازی: </span>
                            <span id="copy-subscribe-token-{{ $key }}"
                                  class="text-xs break-words">{{ $item['token'] }}</span>
                        </div>
                        <i data-id="copy-subscribe-token-{{ $key }}"
                           class="fal fa-copy copy-btn-text text-lg text-gray-800 cursor-pointer"></i>
                    </div>
                </div>
            @endforeach
            @if($last_page > 1)
                <div class="mt-5 flex justify-end items-center gap-3">

                    <div x-data="{ enable: @entangle('enable_prev') }">
                        <div x-show="enable">
                            <span class="dark:text-white">1</span>
                            <span wire:click="prev()" class="btn btn-gray cursor-pointer"><i
                                    class="fal fa-chevron-right"></i></span>
                        </div>
                    </div>

                    <span class="font-bold text-lg text-primary-400">{{ $current_page }}</span>

                    <div x-data="{ enable: @entangle('enable_next') }">
                        <div x-show="enable">
                              <span wire:click="next()" class="btn btn-gray cursor-pointer"><i
                                      class="fal fa-chevron-left"></i></span>
                            <spanzzsu>{{ $last_page }}</spanzzsu>
                        </div>
                    </div>


                </div>
            @endif
        </div>
    @else
        <div class="flex flex-col justify-center items-center my-10">
            <img class="w-16" src="{{ asset('assets/site/images/empty-cart-icon.png') }}">
            <p class="text-sm text-gray-400 text-center mt-5 dark:text-white">هیچ اشتراکی تا این لحظه خریداری
                نکردید!</p>
        </div>
    @endif
</div>

@if(request()->has('trial-subscribe'))
    <span id="trial-subscribe"></span>
@endif

<x-slot name="script">

</x-slot>
