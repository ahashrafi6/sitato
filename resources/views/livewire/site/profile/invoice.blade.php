<x-slot name="style">

</x-slot>
<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
        <div class="col-span-12 lg:col-span-10 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">صورتحساب</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">لیست صورتحساب‌های شما</p>
        </div>
        <div class="col-span-12 lg:col-span-2">
            <select wire:model="type"
                class="w-full rounded-md bg-white dark:bg-gray-600 dark:text-white transition duration-500 p-4 pr-10 border-0 focus:ring-primary-400 focus:shadow-xl focus:outline-none">
                <option value="all">همه</option>
                <option value="factor">سفارش برنامه</option>
                <option value="server">تمدید یا ارتقا سرور</option>
                <option value="plan">ارتقا پلن برنامه</option>
                <option value="plan">تمدید پشتیبانی</option>
            </select>
        </div>
    </div>
    <p class="dark:text-white" wire:loading>صبور باشید...</p>

    @if($invoices)
    <div wire:loading.remove>
        @foreach($invoices as $item)
        <div class="rounded-lg p-5 bg-white dark:bg-gray-700 hover:shadow-xl duration-200 relative mb-5">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-8">
                    @if($item['status'])
                    <span class="text-green-500">پرداخت شده</span>
                    @else
                    @if ($item['expire_at'] > now())
                    <span class="text-orange-500">در انتظار پرداخت</span>
                    @else
                    <span class="text-red-500">منتضی شده</span>
                    @endif

                    @endif

                    <div class="text-sm dark:text-white">شماره سفارش: <span class="text-md font-bold">{{
                            $item['resNumber'] }}</span></div>

                    <div class="text-gray-500 text-sm">{{ f_date($item['created_at']) }}</div>
                </div>

                <div class="flex items-center gap-8">
                    <span class="text-xl font-bold dark:text-white">{{ number_format($item['final_price']) }} <span
                            class="text-xs text-gray-500">تومان</span></span>

                    @if ($item['expire_at'] > now())
                    <a target="_blank" href="{{  route('invoice' , ['factor' => $item['resNumber']]) }}" class="btn btn-primary">پرداخت</a>
                    @endif

                    @if($item['status'])
                    <x-site.info-modal name="9">
                        <x-slot name="button">
                            <a href="#" class="btn btn-gray">جزئیات</a>
                        </x-slot>

                        <x-slot name="title">شرح سفارش: {{ $item['resNumber'] }}</x-slot>

                        <div class="grid grid-cols-12 gap-3">
                            <div class="col-span-12 lg:col-span-4 hidden lg:block">
                                <p class="dark:text-white mb-3">{{ $user->get_display_name() }}</p>
                                <p class="text-gray-500 mb-3">{{ $user->email }}</p>
                            </div>
                            <div class="col-span-8 lg:col-span-4">
                                <p class="dark:text-white mb-3">{{ f_date($item['created_at']) }}</p>
                                <p class="text-gray-500 mb-3">
                                    @switch($item['type'])
                                    @case('factor')
                                    نوع سفارش: سفارش برنامه
                                    @break
                                    @case('server')
                                    نوع سفارش: تمدید یا ارتقا سرور
                                    @break
                                    @case('plan')
                                    نوع سفارش: ارتقا پلن برنامه
                                    @break
                                    @case('support')
                                    نوع سفارش: تمدید پشتیبانی
                                    @break
                                    @endswitch
                                </p>
                                @if($item['terminal'])
                                <p class="text-gray-500 mb-3">ترمینال: {{ $item['terminal'] }}</p>
                                @endif
                                @if($item['refNumber'])
                                <p class="text-gray-500 mb-3">کد رهگیری: {{ $item['refNumber'] }}</p>
                                @endif
                                <p class="text-gray-500">{{ $user->phone }}</p>
                            </div>
                            <div class="col-span-4 lg:col-span-4">
                                <div class="flex flex-col items-center">
                                    <i class="fal fa-check-circle text-green-500" style="font-size: 40px;"></i>
                                    <span class="text-green-500">وضعیت: پرداخت شده</span>
                                </div>
                            </div>
                        </div>

                        @if($item['type'] == 'factor')
                        <div class="overflow-auto" style="max-height: 320px;">
                            @foreach($item['items'] as $factor_item)
                            <div
                                class="flex flex-col lg:flex-row justify-center items-center lg:justify-between gap-3 bg-gray-100 rounded-lg p-4 mb-3">
                                <div class="flex items-center">
                                    @php
                                    $product = \App\Models\Product::find($factor_item['product_id']);
                                    @endphp
                                    <img width="60px" src="{{ img_url($product->icon) }}">
                                    <div class="mr-3 flex flex-col gap-2">
                                        <span>{{ $product->fa_title }} - پلن: {{ $factor_item['plan']['fa_title']
                                            }}</span>
                                        <span class="text-sm">+‌ سرور پلن: {{ $factor_item['server']['fa_title'] }} ( {{
                                            number_format($factor_item['server']['price']) }} تومان )</span>
                                    </div>
                                </div>

                                <div class="flex items-center">
                                    <div class="flex justify-center items-center flex-col">
                                        <span class="font-bold text-xl">{{ number_format($factor_item['price'])
                                            }}</span>
                                        <span class="text-sm text-gray-500">تومان</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif

                        @if($item['type'] == 'support')
                        <div class="bg-gray-100 rounded-lg p-4 flex gap-8">
                            <span>ارتقا پشتیبانی برنامه {{
                                \App\Models\Project::find($item['items']['project_id'])->username }} به مدت {{
                                $item['items']['support']['month'] }} ماه</span>
                        </div>
                        @endif

                        @if($item['type'] == 'plan')
                        <div class="bg-gray-100 rounded-lg p-4 flex gap-8">
                            <span>ارتقا برنامه {{ \App\Models\Project::find($item['items']['project_id'])->username }}
                                به پلن {{ $item['items']['plan']['fa_title'] }}</span>
                        </div>
                        @endif


                        @if($item['type'] == 'server')
                        <div class="bg-gray-100 rounded-lg p-4 flex gap-8">
                            <span>ارتقا سرور برنامه {{ \App\Models\Project::find($item['items']['project_id'])->username
                                }} به پلن {{ $item['items']['server']['fa_title'] }}</span>
                        </div>
                        @endif


                        <div
                            class="flex flex-col lg:flex-row justify-center items-center lg:justify-between py-5 gap-3">
                            <div class="flex items-center gap-8">

                                @if($item['price'])
                                <span class="dark:text-white">مبلغ کل: <span class="font-bold text-xl">{{
                                        number_format($item['price']) }}</span> <span
                                        class="text-gray-500 text-xs">تومان</span></span>
                                @endif

                                @if(!is_null($item['discount']))
                                <span class="dark:text-white">تخفیف: <span class="font-bold text-xl text-red-500">{{
                                        number_format($item['discount']['price']) }}</span> <span
                                        class="text-gray-500 text-xs">تومان</span></span>
                                @endif
                            </div>
                            <div>
                                <span class="dark:text-white">مبلغ قابل پرداخت: <span
                                        class="font-bold text-2xl text-green-500">{{ number_format($item['final_price'])
                                        }}</span> <span class="text-gray-500 text-xs">تومان</span></span>
                            </div>
                        </div>

                    </x-site.info-modal>
                    @endif

                </div>
            </div>
        </div>
        @endforeach

        <div class="">
            {{ $invoices->links() }}
        </div>
    </div>
    @else
    <div class="flex flex-col justify-center items-center my-10">
        <img class="w-16" src="{{ asset('assets/site/images/empty-cart-icon.png') }}">
        <p class="text-sm text-gray-400 text-center mt-5 dark:text-white">هیچ سفارشی تا این لحظه نداشتید!</p>
    </div>
    @endif
</div>

<x-slot name="script">

</x-slot>