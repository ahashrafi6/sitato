<x-slot name="style">

</x-slot>
<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
        <div class="col-span-12 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">پشتیبانی های سریع</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">لیست پشتیبانی های سریع شما</p>
        </div>
    </div>
    <p class="dark:text-white" wire:loading>صبور باشید...</p>

    @if($supports)
        <div wire:loading.remove>
            @foreach($supports as $item)
                <div class="rounded-lg p-5 bg-white dark:bg-gray-700 hover:shadow-xl duration-200 relative mb-5">
                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center gap-8">

                            <div class="dark:text-white">محصول: <span
                                    class="text-md font-bold">{{ \App\Models\Product::find($item['product_id'])->fa_title }}</span>
                            </div>

                            <span class="text-gray-500">سرویس پشیبانی سریع</span>

                            <span
                                class="text-md font-bold dark:text-white">{{ small_price($item['price']) }} <span
                                    class="text-xs text-gray-500">هزار تومان</span></span>

                            @if($item['support_at'] > now())
                                <span class="text-green-400 bold">فعال</span>
                            @else
                                <span class="ext-red-400 bold">منقضی شده</span>
                            @endif

                            <span class="text-gray-500">از تاریخ: {{ f_date($item['from_at']) }}</span>
                            <span class="text-gray-500">تا تاریخ: {{ f_date($item['support_at']) }}</span>
                        </div>

                        <div class="flex items-center gap-8">

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
            <p class="text-sm text-gray-400 text-center mt-5 dark:text-white">هیچ پشتیبانی تا این لحظه خریداری نکردید!</p>
        </div>
    @endif
</div>

<x-slot name="script">

</x-slot>
