<x-slot name="style">

</x-slot>
<div>
    <div class="dir-rtl">
        <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
            <div class="col-span-12 lg:col-span-5 mb-3 lg:mb-0">
                <h4 class="text-2xl font-bold mb-2 dark:text-white">پرسش و پاسخ</h4>
                <p class="text-sm text-gray-500 dark:text-gray-400">لیست پرسش و پاسخ محصولات شما</p>
            </div>
            <div class="col-span-12 lg:col-span-5">
                <select wire:model="product"
                        class="w-full rounded-md bg-white dark:bg-gray-600 dark:text-white transition duration-500 p-4 pr-10 border-0 focus:ring-primary-400 focus:shadow-xl focus:outline-none">
                    <option value="all">محصول...</option>
                    @foreach($products as $item)
                        <option value="{{ $item['id'] }}">{{ $item['fa_title'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 lg:col-span-2">
                <select wire:model="count"
                        class="w-full rounded-md bg-white dark:bg-gray-600 dark:text-white transition duration-500 p-4 pr-10 border-0 focus:ring-primary-400 focus:shadow-xl focus:outline-none">
                    <option value="10">10</option>
                    <option value="20">20</option>
                </select>
            </div>
        </div>

        <p class="dark:text-white" wire:loading>صبور باشید...</p>

        @if(count($discussions) > 0)
            <div wire:loading.remove>
                @foreach($discussions as $item)
                    <div class="bg-white dark:bg-gray-700 rounded-lg hover:shadow-xl duration-500 mb-3 p-5">
                        <div class="flex items-center">
                            <img class="rounded-full ml-5" width="50px" src="{{ img_url($item->user->avatar) }}" alt="{{ $item->user->get_display_name() }}">
                            <div class="w-full">
                                <div class="flex items-center justify-between mb-2">
                                    <span>{{ $item->user->get_display_name() }}</span>
                                    <div class="flex items-center gap-5">
                                        <span class="text-gray-500 text-sm hidden lg:block">{{ d_date($item->created_at) }}</span>
                                        <a href="{{ $item->path() }}" class="btn btn-gray">جزئیات</a>
                                    </div>
                                </div>
                                <a target="_blank" class="text-gray-500 text-sm" href="{{ $item->discussable->path() }}">
                                    <i class="fal fa-link ml-2 text-md"></i>
                                    {{ $item->discussable->fa_title }}
                                </a>
                            </div>
                        </div>
                        <div class="bg-gray-100 rounded-md p-3 text-gray-600 text-sm leading-loose mt-8">
                            {!! nl2br($item->body) !!}
                        </div>
                    </div>
                @endforeach

                <div class="">
                    {{ $discussions->links() }}
                </div>
            </div>
        @else
            <div class="flex flex-col justify-center items-center my-10">
                <img class="w-16" src="{{ asset('assets/site/images/empty-cart-icon.png') }}">
                <p class="text-sm text-gray-400 text-center mt-5 dark:text-white">هیچ پرسش و پاسخی تا این لحظه یافت نشد!</p>
            </div>
        @endif
    </div>
</div>
<x-slot name="script">

</x-slot>
