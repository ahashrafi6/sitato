<x-slot name="style">

</x-slot>
<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
        <div class="col-span-12 lg:col-span-9 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">بروزرسانی جزئیات</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">لیست بروزرسانی جزئیات محصولات شما</p>
        </div>
        <div class="col-span-12 lg:col-span-3">
            <select wire:model="status"
                    class="w-full rounded-md bg-white dark:bg-gray-600 dark:text-white transition duration-500 p-4 pr-10 border-0 focus:ring-primary-400 focus:shadow-xl focus:outline-none">
                <option value="all">همه وضعیت ها</option>
                @foreach(\App\Models\Detail::STATUS as $key => $item)
                    <option value="{{ $key }}">{{ $item }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="flex items-center dir-rtl mt-1 bg-green-100 p-3 rounded-md border-2 border-green-300 mb-3">
            <p class="text-success-500 text-sm">{{ session('success') }}</p>
        </div>
    @endif

    <p class="dark:text-white" wire:loading>صبور باشید...</p>

    @if(count($details) > 0)
        <div wire:loading.remove>
            @foreach($details as $item)
                <div
                    class="rounded-lg p-5 bg-white dark:bg-gray-700 hover:shadow-xl duration-200 relative mb-5 flex items-center justify-between">
                    <span class="dark:text-white">{{ $item->product->fa_title }}</span>
                    <div class="flex items-center gap-5">
                        <span class="text-sm text-gray-500">{{ f_date($item->created_at) }}</span>
                        @switch($item->status)
                            @case('pending')
                            <span class="text-orange-400 text-sm bold">در انتظار تایید</span>
                            @break
                            @case('verified')
                            <span class="text-green-400 text-sm bold">تایید شده</span>
                            @break
                            @case('fail')
                            <span class="text-red-400 text-sm bold">رد شده</span>
                            @break
                        @endswitch
                    </div>
                </div>
            @endforeach


            <div class="">
                {{ $details->links() }}
            </div>
        </div>
    @else
        <div class="flex flex-col justify-center items-center my-10">
            <img class="w-16" src="{{ asset('assets/site/images/empty-cart-icon.png') }}">
            <p class="text-sm text-gray-400 text-center mt-5 dark:text-white">هیچ بروزرسانی تا این لحظه یافت نشد!</p>
        </div>
    @endif
</div>
<x-slot name="script">

</x-slot>
