<x-slot name="style">

</x-slot>
<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
        <div class="col-span-12 lg:col-span-10 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">تراکنش ها</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">لیست تراکنش های شما</p>
        </div>
        @if($transactions)
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
    <p class="dark:text-white" wire:loading>صبور باشید...</p>

    @if($transactions)
        <div wire:loading.remove>
            @foreach($transactions as $item)
                <div class="{{ $item['type'] == 'desc' ? 'border-red-500' : 'border-green-500' }} border-r-4 rounded-lg p-5 bg-white dark:bg-gray-700 hover:shadow-xl duration-200 relative mb-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            @if($item['type'] == 'desc')
                                <i class="fal fa-minus text-2xl text-red-500"></i>
                            @else
                                <i class="fal fa-plus text-2xl text-green-500"></i>
                            @endif
                            <span class="mr-4 dark:text-white">شماره: {{ $item['id'] }}</span>
                        </div>
                        <div>
                            <span class="text-sm text-gray-500">{{ f_date($item['created_at']) }}</span>
                            <span class="mr-4 text-primary-500">
                               @switch($item['source'])
                                    @case('wallet')
                                    اعتبار
                                    @break
                                    @case('gift')
                                    اعتبار هدیه
                                    @break
                                    @case('income')
                                    درآمد
                                    @break
                                    @case('affiliate')
                                    همکاری در فروش
                                    @break
                                @endswitch
                           </span>

                        </div>
                    </div>
                    <div class="py-8 flex items-center justify-between gap-5 dark:text-white">
                        <p>{{ $item['title'] }}</p>
                        <div class="text-xl">{{ number_format($item['price']) }} <span class="text-gray-500 text-sm">تومان</span></div>
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
            <p class="text-sm text-gray-400 text-center mt-5 dark:text-white">هیچ تراکنشی تا این لحظه یافت نشد!</p>
        </div>
    @endif
</div>
<x-slot name="script">

</x-slot>
