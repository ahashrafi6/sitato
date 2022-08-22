<x-slot name="style">

</x-slot>
<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
        <div class="col-span-12 lg:col-span-10 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">درخواست ها</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">لیست درخواست های شما</p>
        </div>
        <div class="col-span-12 lg:col-span-2">
            <select wire:model="status"
                    class="w-full rounded-md bg-white dark:bg-gray-600 dark:text-white transition duration-500 p-4 pr-10 border-0 focus:ring-primary-400 focus:shadow-xl focus:outline-none">
                <option value="all">همه</option>
                <option value="pending">در انتظار</option>
                <option value="completed">انجام شده</option>
                <option value="fail">رد شده</option>
            </select>
        </div>
    </div>
    <p class="dark:text-white" wire:loading>صبور باشید...</p>

    @if($refunds)
        <div wire:loading.remove>
            @foreach($refunds as $item)
                <div class="rounded-lg p-5 bg-white dark:bg-gray-700 hover:shadow-xl duration-200 relative mb-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-8">
                            @if($item['type'] == 'cash_back')
                                <span class="text-sm">بازگشت فروش محصول</span>
                            @elseif($item['type'] == 'support_back')
                                <span class="tex-sm">بازگشت فروش پشتیبانی</span>
                            @elseif($item['type'] == 'quick_support_back')
                                <span class="tex-sm">بازگشت فروش پشتیبانی سریع</span>
                            @elseif($item['type'] == 'install_back')
                                <span class="tex-sm">بازگشت فروش سرویس نصب</span>
                            @endif

                            <span class="text-md font-bold dark:text-white">{{ small_price($item['price']) }} <span
                                    class="text-xs text-gray-500">هزار تومان</span>
                            </span>

                            <span class="text-xs text-gray-500">{{ \App\Models\Product::find($item['product_id'])->fa_title }}</span>

                        </div>

                        <div class="flex items-center gap-8">
                            @if($item['status'] == 'pending')
                                <span class="text-orange-500">در انتظار</span>
                            @elseif($item['status'] == 'completed')
                                <span class="text-green-500">انجام شده</span>
                            @else
                                <span class="text-red-500">رد شده</span>
                            @endif
                        </div>
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
                            <span class="dark:text-white">{{ $last_page }}</span>
                        </div>
                    </div>


                </div>
            @endif
        </div>
    @else
        <div class="flex flex-col justify-center items-center my-10">
            <img class="w-16" src="{{ asset('assets/site/images/empty-cart-icon.png') }}">
            <p class="text-sm text-gray-400 text-center mt-5 dark:text-white">هیچ درخواستی تا این لحظه نداشتید!</p>
        </div>
    @endif
</div>

<x-slot name="script">

</x-slot>
