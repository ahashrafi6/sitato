<x-slot name="style">

</x-slot>
<div>
    <div class="dir-rtl">
        <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
            <div class="col-span-10 mb-3 lg:mb-0">
                <h4 class="text-2xl font-bold mb-2 dark:text-white">مدیریت تیکت ها</h4>
                <p class="text-sm text-gray-500 dark:text-gray-400">مدیریت تمام تیکت های سایت</p>
            </div>
            <div class="col-span-2 flex justify-end items-center">
                <a class="btn btn-primary" href="{{ route('admin.tickets.create') }}">ارسال تیکت مدیریت</a>
            </div>

        </div>

        @if (session()->has('success'))
            <div class="flex items-center dir-rtl mt-1 bg-green-100 p-3 rounded-md border-2 border-green-300 mb-3">
                <p class="text-success-500 text-sm">{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-12 gap-3 my-5">
            <div wire:model.lazy="tracking" class="col-span-12 lg:col-span-2">
                <input
                    class="w-full rounded-md bg-white dark:bg-gray-600 dark:text-white transition duration-500 p-4 border-0 focus:ring-primary-400 focus:shadow-xl focus:outline-none"
                    type="text" placeholder="شناسه">
            </div>
            <div class="col-span-12 lg:col-span-2">
                <select wire:model="status"
                        class="w-full rounded-md bg-white dark:bg-gray-600 dark:text-white transition duration-500 p-4 pr-10 border-0 focus:ring-primary-400 focus:shadow-xl focus:outline-none">
                    <option value="all">همه وضعیت ها</option>
                    @foreach(\App\Models\Ticket::STATUS as $key => $type)
                        <option value="{{ $key }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 lg:col-span-2">
                <select wire:model="department"
                        class="w-full rounded-md bg-white dark:bg-gray-600 dark:text-white transition duration-500 p-4 pr-10 border-0 focus:ring-primary-400 focus:shadow-xl focus:outline-none">
                    <option value="all">همه دپارتمان ها</option>
                    @foreach(\App\Models\Ticket::DEPARTMENT as $key => $type)
                        <option value="{{ $key }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 lg:col-span-2">
                <select wire:model="type"
                        class="w-full rounded-md bg-white dark:bg-gray-600 dark:text-white transition duration-500 p-4 pr-10 border-0 focus:ring-primary-400 focus:shadow-xl focus:outline-none">
                    <option value="all">همه نوع ها</option>
                    @foreach(\App\Models\Ticket::TYPE as $key => $type)
                        <option value="{{ $key }}">{{ $type['title'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 lg:col-span-2">
                <select wire:model="count"
                        class="w-full rounded-md bg-white dark:bg-gray-600 dark:text-white transition duration-500 p-4 pr-10 border-0 focus:ring-primary-400 focus:shadow-xl focus:outline-none">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="20">30</option>
                    <option value="20">50</option>
                </select>
            </div>
        </div>

        @if(count($tickets) > 0)
            <div class="grid grid-cols-12 gap-3 mb-2 p-5 dark:text-gray-500 text-sm">
                <div class="col-span-12 lg:col-span-5 flex items-center gap-8">
                    <span>شناسه</span>
                    <span>عنوان</span>
                </div>
                <div class="hidden lg:block lg:col-span-5">
                    <span>محصول</span>
                </div>
                <div class="hidden lg:flex lg:col-span-2 items-center gap-10">
                    <span>آخرین آپدیت</span>
                    <span>نمایش</span>
                </div>
            </div>
        @endif


        <p class="dark:text-white" wire:loading>صبور باشید...</p>
        @if(count($tickets) > 0)
            <div wire:loading.remove>
                @foreach($tickets as $item)
                    <div class="bg-white dark:bg-gray-700 rounded-lg hover:shadow-xl duration-500 mb-3 p-5">
                        <div class="grid grid-cols-12 gap-3">
                            <div class="col-span-12 lg:col-span-5 flex items-center gap-5 text-gray-500 dark:text-white">
                                <span>{{ $item->tracking }}</span>
                                <a class="text-sm" href="{{ $item->path() }}">{{ $item->title }}</a>
                                @switch($item->status)
                                    @case('waiting')
                                    <span
                                        class="bg-orange-50 text-orange-400 text-xs p-2 rounded-md">در انتظار پاسخ</span>
                                    @break
                                    @case('pending')
                                    <span class="bg-blue-50 text-blue-400 text-xs p-2 rounded-md">در حال بررسی</span>
                                    @break
                                    @case('answer')
                                    <span class="bg-green-50 text-green-400 text-xs p-2 rounded-md">پاسخ داده شده</span>
                                    @break
                                    @case('close')
                                    <span class="bg-red-50 text-red-400 text-xs p-2 rounded-md">بسته شده</span>
                                    @break
                                    @case('admin')
                                    <span class="bg-primary-50 text-primary-400 text-xs p-2 rounded-md">از طرف مدیریت</span>
                                    @break
                                    @case('product-install')
                                    <span
                                        class="bg-primary-50 text-primary-400 text-xs p-2 rounded-md">نصب محصول</span>
                                    @break
                                @endswitch
                            </div>
                            <div class="hidden lg:flex lg:col-span-5 text-gray-500 text-sm items-center">
                                @if($item->project)
                                    <a target="_blank"
                                       href="#">{{ $item->project->product->fa_title }}</a>
                                @endif
                            </div>
                            <div class="hidden lg:flex lg:col-span-2 items-center gap-3 text-gray-500 text-sm">
                                <span class="text-xs">{{ f_date($item->updated_at) }}</span>
                                <a href="{{ $item->path() }}"
                                   class="border-b border-dotted pb-1 border-gray-300 dark:text-white">نمایش</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="">
                    {{ $tickets->links() }}
                </div>
            </div>
        @else
            <div class="flex flex-col justify-center items-center my-10">
                <img class="w-16" src="{{ asset('assets/site/images/empty-cart-icon.png') }}">
                <p class="text-sm text-gray-400 text-center mt-5 dark:text-white">هیچ تیکتی تا این لحظه یافت نشد!</p>
            </div>
        @endif
    </div>
</div>
<x-slot name="script">

</x-slot>

