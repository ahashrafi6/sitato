<x-slot name="style">

</x-slot>
<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
        <div class="col-span-12 lg:col-span-3 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">درآمد ها</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">لیست درآمد های شما</p>
        </div>
        <div class="col-span-12 lg:col-span-3">
            <select wire:model="type"
                    class="w-full rounded-md bg-white dark:bg-gray-600 dark:text-white transition duration-500 p-4 pr-10 border-0 focus:ring-primary-400 focus:shadow-xl focus:outline-none">
                <option value="all">همه نوع ها</option>
                <option value="cash">فروش محصول</option>
                <option value="cash_back">بازگشت فروش محصول</option>
                <option value="support">فروش پشتیبانی</option>
                <option value="support_back">بازگشت فروش پشتیبانی</option>
                <option value="quick_support">فروش پشتیبانی سریع</option>
                <option value="quick_support_back">بازگشت فروش پشتیبانی سریع</option>
                <option value="gift">هدیه پلکانی</option>
                <option value="gift_back">بازگشت هدیه پلکانی</option>
                <option value="install">فروش سرویس نصب</option>
                <option value="install_back">بازگشت فروش سرویس نصب</option>
                <option value="subscribe">اشتراک</option>
            </select>
        </div>
        <div class="col-span-12 lg:col-span-3">
            <select wire:model="status"
                    class="w-full rounded-md bg-white dark:bg-gray-600 dark:text-white transition duration-500 p-4 pr-10 border-0 focus:ring-primary-400 focus:shadow-xl focus:outline-none">
                <option value="all">همه وضعیت ها</option>
                <option value="pending">در انتظار</option>
                <option value="completed">انتقال داده شده</option>
                <option value="returned">برگشت داده شده</option>
            </select>
        </div>
        <div class="col-span-12 lg:col-span-3">
            <select wire:model="count"
                    class="w-full rounded-md bg-white dark:bg-gray-600 dark:text-white transition duration-500 p-4 pr-10 border-0 focus:ring-primary-400 focus:shadow-xl focus:outline-none">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
            </select>
        </div>
    </div>

    <p class="dark:text-white" wire:loading>صبور باشید...</p>

    @if($incomes)

        <table wire:loading.remove class="border-collapse table-fixed w-full text-sm">
            <thead>
            <tr>
                <th class="border-b dark:border-gray-600 font-medium p-4 pl-8 pt-0 pb-3 text-right dark:text-white">
                    نوع
                </th>
                <th class="border-b dark:border-gray-600 font-medium p-4 pt-0 pb-3 text-right dark:text-white">
                    شناسه سفارش
                </th>
                <th class="border-b dark:border-gray-600 font-medium p-4 pr-8 pt-0 pb-3 text-right dark:text-white">
                    کاربر
                </th>
                <th class="border-b dark:border-gray-600 font-medium p-4 pr-8 pt-0 pb-3 text-right dark:text-white">
                    مبلغ
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
            @foreach($incomes as $item)
                <tr>
                    <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                        @if($item['type'] == 'cash')
                            <span>فروش محصول</span>
                        @elseif($item['type'] == 'cash_back')
                            <span>بازگشت فروش محصول</span>
                        @elseif($item['type'] == 'support')
                            <span>فروش پشتیبانی</span>
                        @elseif($item['type'] == 'support_back')
                            <span>بازگشت فروش پشتیبانی</span>
                        @elseif($item['type'] == 'quick_support')
                            <span>فروش پشتیبانی سریع</span>
                        @elseif($item['type'] == 'quick_support_back')
                            <span>بازگشت فروش پشتیبانی سریع</span>
                        @elseif($item['type'] == 'gift')
                            <span>هدیه پلکانی</span>
                        @elseif($item['type'] == 'gift_back')
                            <span>بازگشت هدیه پلکانی</span>
                        @elseif($item['type'] == 'install')
                            <span>فروش سرویس نصب</span>
                        @elseif($item['type'] == 'install_back')
                            <span>بازگشت فروش سرویس نصب</span>
                        @elseif($item['type'] == 'affiliate')
                            <span>بازاریابی</span>
                        @elseif($item['type'] == 'subscribe')
                            <span>فروش اشتراکی محصول</span>
                        @endif

                        @if($item['product_id'])
                            <span
                                class="text-blue-400 text-xs">{{ \App\Models\Product::find($item['product_id'])->fa_title }}</span>
                        @endif
                    </td>
                    <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                        @if($item['factor'])
                            <span>{{ $item['factor']['resNumber'] }}</span>
                        @endif
                    </td>
                    <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                        @if($item['factor'])
                            <span
                                class="text-xs">{{ \App\Models\User::find($item['factor']['user_id'])->get_display_name() }}</span>
                        @endif
                    </td>
                    <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                        <span>{{ number_format($item['price']) }}</span>
                    </td>
                    <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                        @if($item['status'] == 'completed')
                            <span class="bg-green-50 text-green-400 text-xs p-2 rounded-md">انتقال یافته</span>
                        @elseif($item['status'] == 'pending')
                            <span class="bg-orange-50 text-orange-400 text-xs p-2 rounded-md">در انتظار</span>
                        @else
                            <span class="bg-red-50 text-red-400 text-xs p-2 rounded-md">برگشت داده شده</span>
                        @endif
                    </td>
                    <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                        <span class="text-xs">{{ f_date($item['created_at']) }}</span>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
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


    @else
        <div class="flex flex-col justify-center items-center my-10">
            <img class="w-16" src="{{ asset('assets/site/images/empty-cart-icon.png') }}">
            <p class="text-sm text-gray-400 text-center mt-5 dark:text-white">هیچ درآمدی تا این لحظه یافت نشد!</p>
        </div>
    @endif
</div>
<x-slot name="script">

</x-slot>
