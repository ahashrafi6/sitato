<div class="text-gray-900 antialiased relative">
    <div wire:loading class="bg-gray-900 bg-opacity-70 fixed top-0 right-0 left-0 bottom-0 z-90 dir-rtl">
        <div class="w-full h-full flex flex-col justify-center items-center">
            <img class="w-14 animate-bounce mb-2" src="{{ asset('assets/site/images/icon.png') }}">
            <span class="text-white text-sm">منتظر باشید...</span>
        </div>
    </div>
    <div class="min-h-screen grid grid-cols-5">

        <div class="xl:min-h-screen col-span-5 xl:col-span-2 p-8 bg-white dark:bg-gray-800 transition duration-500">
            <a href="/">
                <img class="w-12 inline-block" src="{{ asset('assets/site/images/icon.png') }}" alt="اشتراک وردپرس">
            </a>

            <div class="dir-rtl mt-16">
                <div class="flex items-center justify-between mb-5">
                    <span class="md:text-xl font-bold dark:text-white">مجموع</span>
                    <div>
                        <span class="text-xl md:text-3xl font-bold dark:text-white">{{
                            session()->get('cart.total.price') ? number_format(session()->get('cart.total.price')) : 0
                            }}</span>
                        <span class="text-xs text-gray-500">تومان</span>
                    </div>
                </div>

                <div class="mb-5" x-data="{discountShow: {{ $discount > 0 ? 'true' : 'false' }}}">
                    <div x-show="discountShow" class="flex items-center justify-between ">
                        <div>
                            <span class="md:text-xl font-bold dark:text-white">تخفیف</span>
                            <span wire:click="deleteDiscount"
                                class="bg-gray-100 rounded-md py-1 px-3 text-xs cursor-pointer mr-2">حذف</span>
                        </div>
                        <div>
                            <span class="text-xl font-bold text-red-500">- {{ number_format($discount) }}</span>
                            <span class="text-xs text-red-500">تومان</span>
                        </div>
                    </div>
                </div>


                @if($wallet != 0 && ($obj && $obj['total_price'] > 0))
                <div class="mb-5 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <label for="using_wallet" class="inline-flex items-center gap-2">
                            <input wire:model="using_wallet" wire:click="$set('using_gift', !using_gift)"
                                id="using_wallet" type="checkbox"
                                class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                                name="remember">

                            <span class="text-md font-bold dark:text-white">استفاده از اعتبار کیف پول</span>
                            <div class="flex items-center gap-1">
                                <span class="text-lg font-bold text-green-600">{{ number_format($wallet) }}</span>
                                <span class="text-gray-500 text-xs">تومان</span>
                            </div>
                        </label>


                    </div>
                    @if($using_wallet)
                    @if($wallet > $obj['total_price'])
                    <div>
                        <span class="text-xl font-bold text-red-500">- {{ number_format($obj['total_price']) }}</span>
                        <span class="text-xs text-red-500">تومان</span>
                    </div>
                    @else
                    <div>
                        <span class="text-xl font-bold text-red-500">- {{ number_format($wallet) }}</span>
                        <span class="text-xs text-red-500">تومان</span>
                    </div>
                    @endif

                    @endif

                </div>
                @endif

                <div class="flex items-center justify-between mb-5">
                    <span class="md:text-xl font-bold dark:text-white">مبلغ قابل پرداخت</span>
                    @if($using_wallet)
                    <div>
                        <span class="text-xl md:text-3xl font-bold text-green-500">{{ ($obj && $obj['total_price'] > 0)
                            ? ($obj['total_price'] - $wallet) > 0 ? number_format($obj['total_price'] - $wallet) : 0 : 0
                            }}</span>
                        <span class="text-xs text-green-500">تومان</span>
                    </div>
                    @else
                    <div>
                        <span class="text-xl md:text-3xl font-bold text-green-500">{{ ($obj && $obj['total_price'] > 0)
                            ? number_format($obj['total_price']) : 0 }}</span>
                        <span class="text-xs text-green-500">تومان</span>
                    </div>
                    @endif
                </div>
            </div>
            @auth
            @if(session()->get('cart.total.count') > 0)
            <div x-data="{ discountDrop: false}" class="my-4 dir-rtl">
                <label for="discountDrop" class="inline-flex items-center">
                    <input @click="discountDrop = !discountDrop" id="discountDrop" type="checkbox"
                        class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="mr-2 text-sm text-gray-600 dark:text-white">برای خرید، کد تخفیف دارم</span>
                </label>
                <div class="relative mt-2" x-show="discountDrop">
                    <form wire:submit.prevent="applyDiscount">
                        @csrf
                        <input type="text" wire:model.defer="discount_code"
                            class="text-sm rounded-md py-3 shadow-sm border-gray-300 focus:border-primary-100 transition block w-full"
                            placeholder="اگر کد تخفیف دارید وارد نمایید">
                        <span wire:loading class="text-xs text-gray-500 absolute left-2 top-3.5">در حال بررسی...</span>
                        <button wire:loading.remove type="submit"
                            class="cursor-pointer bg-blue-400 rounded-md absolute left-2 top-2 py-1.5 px-3 text-sm text-white hover:bg-blue-500 focus:outline-none">
                            اعمال تخفیف
                        </button>

                        <x-auth.auth-validation-error name="discount_code" />
                    </form>
                    @if (session()->has('error'))
                    <div class="flex items-center dir-rtl mt-1">
                        <i class="fad fa-exclamation-circle text-sm text-red-300 pl-1"></i>
                        <p class="text-red-500 text-xs">{{ session('error') }}</p>
                    </div>
                    @endif
                    @if (session()->has('success'))
                    <div class="flex items-center dir-rtl mt-1 bg-green-100 p-3 rounded-md border-2 border-green-300">
                        <p class="text-success-500 text-xs">{{ session('success') }}</p>
                    </div>
                    @endif
                </div>
            </div>
            <form wire:submit.prevent="createFactor" class="mt-3">
                @csrf

                <button type="submit" class="btn btn-green w-full">تایید و پرداخت</button>
            </form>

            <div class="flex items-center mt-3 dir-rtl">
                <i class="fad fa-exclamation-circle text-md text-green-500 pl-2"></i>
                <span class="text-xs text-gray-500 dark:text-green-500">خرید و استفاده از خدمات، به منزله موافقت شما با
                    <a class="font-bold" target="_blank" href="">قوانین سایتاتو</a> است.
                </span>
            </div>

            @else
            <div class="flex items-center mt-3 dir-rtl">
                <i class="fad fa-exclamation-circle text-md text-yellow-500 pl-2"></i>
                <span class="text-xs text-gray-500 dark:text-green-500">جهت ادامه خرید ابتدا باید محصول مورد نظر را به
                    سبد خرید اضافه کنید.</span>
            </div>
            @endif
            @else
            <div class="flex items-center mt-3 dir-rtl">
                <i class="fad fa-exclamation-circle text-md text-yellow-500 pl-2"></i>
                <span class="text-xs text-gray-500 dark:text-green-500">جهت ادامه خرید ابتدا باید وارد حساب کاربری خود
                    شده یا عضو شوید.</span>
            </div>
            <x-site.login-modal>
                <button class="btn btn-primary w-full mt-3">ورود به حساب کاربری</button>
            </x-site.login-modal>
            @endauth


        </div>
        <div
            class="xl:min-h-screen col-span-5 xl:col-span-3 bg-gray-100 dark:bg-gray-900 overflow-hidden p-8 transition duration-500">
            @if(session()->get('cart.total.count') > 0)
            <div class="flex items-center justify-between dir-rtl mb-8">
                <h4 class="text-xl md:text-2xl font-bold dark:text-white">سبد خرید</h4>
                <div x-data="{cartClear: false}" class="relative">
                    <div @click="cartClear = !cartClear" @click.away="cartClear = false"
                        class="cursor-pointer flex items-center gap-2 text-sm relative">
                        <i class="fal fa-trash text-lg dark:text-white"></i>
                        <span class="dark:text-white">حذف کامل سبد</span>
                    </div>
                    <div x-show.transition="cartClear"
                        class="absolute -bottom-8 left-0 bg-white w-40 shadow-md rounded-md p-2">
                        <p class="text-xs text-gray-500 mb-2">آیا مطمئن هستید؟</p>
                        <button wire:click="cartClear" class="btn btn-red py-1 px-2 float-left text-xs">بلــه
                        </button>
                    </div>
                </div>

            </div>
            @foreach($products as $item)
            <div class="mb-5">

                <div
                    class=" bg-white dark:bg-gray-800 rounded-xl p-4 shadow-md hover:shadow-lg grid md:grid-cols-4 dir-rtl transition duration-500">
                    <div class="flex items-center col-span-2 gap-3">
                        @php
                        $product = App\Models\Product::find($item['plan']->product_id);
                        @endphp
                        <a href="#" target="_blank">
                            <img class="w-icon" src="{{ img_url($product->icon) }}" alt="{{ $product->fa_title }}">
                        </a>
                        <div>
                            <h3 class="dark:text-white text-sm md:text-base font-bold mb-3">
                                <a target="_blank" href="#">{{ $product->fa_title }}</a>
                            </h3>
                            <div class="text-xs text-gray-500">
                                <span>نوع پلن:</span>
                                <span>{{ $item['plan']->fa_title }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <ul>
                            <li class="text-xs mb-3 flex items-center gap-2">
                                <i class="fal fa-check-circle text-lg text-green-500"></i>
                                <span class="dark:text-white">دسترسی مادام‌العمر به محصول</span>
                            </li>
                        </ul>
                    </div>
                    <div class="flex flex-col items-end justify-center gap-y-3">

                        <span wire:click="delete({{ $item['plan']->id }})"
                            class="cursor-pointer bg-gray-200 rounded py-2 px-3 text-xs">
                            <i class="fal fa-trash text-md"></i>
                            حذف
                        </span>

                        <div>
                            @if(session()->has("cart.discounts.{$item['plan']->id}"))
                            <span class="text-xl md:text-xl dark:text-white line-through">{{
                                number_format($item['price']) }} </span>
                            <span class="text-xl md:text-3xl font-bold dark:text-white">{{ number_format($item['price']
                                - session()->get("cart.discounts.{$item['plan']->id}.price")) }}</span>
                            @else
                            <span class="text-xl md:text-3xl font-bold dark:text-white">{{ number_format($item['price'])
                                }}</span>
                            @endif
                            <span class="text-xs text-gray-400">تومان</span>
                        </div>
                    </div>
                </div>


                <div class="dir-rtl flex align-center gap-5 px-3">

                    <div class="text-xs flex items-center bg-blue-400 rounded-b-md p-2">
                        <span class="text-white">+ سرور پلن {{  $item['server']->fa_title }} (
                            @switch($item['per'])
                            @case(3)
                            <span>دوره تمدید ۳ ماهه</span>
                            @break
                            @case(12)
                            <span>دوره تمدید سالانه</span>
                            @break
    
                            @default
                            <span>دوره تمدید ماهانه</span>
    
                            @endswitch
                        )</span>
                    </div>

                </div>
            </div>
            @endforeach
            @else
            <div class="flex flex-col dir-rtl items-center gap-4 pt-10">
                <img class="w-20" src="http://localhost:8000/assets/site/images/empty-cart-icon.png"
                    alt="سبد خرید خالی است">
                <h4 class="text-sm lg:text-lg text-gray-700 dark:text-white">محصولی در سبد خرید شما وجود ندارد!</h4>
                <a href="/order" class="btn btn-primary">مشاهده محصولات</a>
            </div>
            @endif

        </div>

    </div>
</div>

@if(request()->has('fail-payment'))
<span id="fail-payment"></span>
@endif