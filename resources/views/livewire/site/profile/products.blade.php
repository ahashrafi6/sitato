<x-slot name="style">

</x-slot>
<div>
    <div class="dir-rtl">
        <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
            <div class="col-span-10 lg:col-span-9 mb-3 lg:mb-0">
                <h4 class="text-2xl font-bold mb-2 dark:text-white">محصولات</h4>
                <p class="text-sm text-gray-500 dark:text-gray-400">لیست محصولات شما</p>
            </div>
            <div class="col-span-12 lg:col-span-3">
                <select wire:model="status"
                        class="w-full rounded-md bg-white dark:bg-gray-600 dark:text-white transition duration-500 p-4 pr-10 border-0 focus:ring-primary-400 focus:shadow-xl focus:outline-none">
                    <option value="all">همه</option>
                    @foreach(\App\Models\Product::STATUS as $key => $type)
                        <option value="{{ $key }}">{{ $type }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @if (session()->has('success'))
            <div class="flex items-center dir-rtl mt-1 bg-green-100 p-3 rounded-md border-2 border-green-300 mb-3">
                <p class="text-success-500 text-sm">{{ session('success') }}</p>
            </div>
        @endif

        <a href="{{ route('profile.products.create') }}" class="my-5 bg-white flex justify-center rounded-md">
            <img src="{{ asset('assets/site/images/add-new-product.jpg') }}">
        </a>

        <p class="dark:text-white" wire:loading>صبور باشید...</p>

        @if(count($products) > 0)
            <div wire:loading.remove>
                <div class="grid grid-cols-12 gap-8">
                    @foreach($products as $item)
                        <div class="col-span-12 lg:col-span-4">
                            <div
                                class="bg-white dark:bg-gray-700 p-4 rounded-md flex flex-col gap-8 duration-500 relative">

                                @switch($item->status)
                                    @case('published')
                                    <span
                                        class="absolute left-8 top-8 bg-green-100 rounded-md py-1 px-3 text-green-500 text-sm">منتشر شده</span>
                                    @break
                                    @case('draft')
                                    <span
                                        class="absolute left-8 top-8 bg-gray-100 rounded-md py-1 px-3 text-gray-500 text-sm">پیش نویس</span>
                                    @break
                                    @case('pending')
                                    <span
                                        class="absolute left-8 top-8 bg-orange-100 rounded-md py-1 px-3 text-orange-500 text-sm">در انتظار بررسی</span>
                                    @break
                                    @case('stop')
                                    <span
                                        class="absolute left-8 top-8 bg-red-100 rounded-md py-1 px-3 text-red-500 text-sm">توقف فروش</span>
                                    @break
                                @endswitch
                                @if($item->mini_cover)
                                    <img src="{{ img_url($item->mini_cover) }}">
                                @else
                                    <img src="{{ asset('assets/site/images/placeholder.jpg') }}">
                                @endif

                                @if($item->status == 'published' || $item->status == 'stop')
                                    <a class="dark:text-white" href="{{ $item->path() }}"
                                       target="_blank">{{ $item->fa_title }}</a>
                                @else
                                    <p class="dark:text-white">{{ $item->fa_title }}</p>
                                @endif
                                <div>
                                    <div class="flex items-center">

                                    </div>

                                    @if($item->status == 'pending')
                                        <p class="text-center text-xs text-gray-500">تا بررسی کارشناسان اشتراک وردپرس
                                            منتظر باشید</p>
                                    @elseif($item->status == 'draft')
                                    <x-site.info-modal :name="4">
                                        <x-slot name="button">
                                            <a href="#" class="btn btn-green block text-center py-3">مدیریت
                                                محصول</a>
                                        </x-slot>

                                        <x-slot name="title">{{ $item->fa_title }}</x-slot>

                                        <div class="flex gap-4">
                                            
                                            <a href="{{ route('profile.products.edit' , ['product' => $item->slug]) }}"
                                               class="w-1/2 bg-white shadow-md p-5 rounded-md hover:shadow-lg duration-200 flex flex-col items-center justify-center">
                                                <i class="fal fa-pencil"></i>
                                                <span class="text-sm mt-2 text-gray-500">ویرایش محصول</span>
                                            </a>

                                            <a href="{{ route('profile.products.license', ['product' => $item->slug]) }}"
                                                class="w-1/2 bg-white shadow-md p-5 rounded-md hover:shadow-lg duration-200 flex flex-col items-center justify-center">
                                                 <i class="fal fa-file-certificate"></i>
                                                 <span class="text-sm mt-2 text-gray-500">لایسنس گذاری</span>
                                             </a>

                                        </div>
                                    
                                        
                                    </x-site.info-modal>
                                    @else
                                        <x-site.info-modal :name="4">
                                            <x-slot name="button">
                                                <a href="#" class="btn btn-green block text-center py-3">مدیریت
                                                    محصول</a>
                                            </x-slot>

                                            <x-slot name="title">{{ $item->fa_title }}</x-slot>

                                            <div class="flex gap-4">
                                                
                                                <a href="{{ route('profile.products.body-edit' , ['product' => $item->slug]) }}"
                                                   class="w-1/2 bg-white shadow-md p-5 rounded-md hover:shadow-lg duration-200 flex flex-col items-center justify-center">
                                                    <i class="fal fa-pencil"></i>
                                                    <span class="text-sm mt-2 text-gray-500">ویرایش محتوا</span>
                                                </a>

                                                <a href="{{ route('profile.products.detail.create', ['product' => $item->slug ]) }}"
                                                   class="w-1/2 bg-white shadow-md p-5 rounded-md hover:shadow-lg duration-200 flex flex-col items-center justify-center">
                                                    <i class="fal fa-list-alt"></i>
                                                    <span class="text-sm mt-2 text-gray-500">بروزرسانی جزئیات</span>
                                                </a>

                                            </div>
                                            <div class="flex gap-4 mt-4">
                                                <a href="{{ route('profile.products.version.create', ['product' => $item->slug]) }}"
                                                   class="w-1/2 bg-white shadow-md p-5 rounded-md hover:shadow-lg duration-200 flex flex-col items-center justify-center">
                                                    <i class="fal fa-sync-alt"></i>
                                                    <span class="text-sm mt-2 text-gray-500">ارسال بروزرسانی</span>
                                                </a>
                                                <a href="{{ route('profile.products.license', ['product' => $item->slug]) }}"
                                                   class="w-1/2 bg-white shadow-md p-5 rounded-md hover:shadow-lg duration-200 flex flex-col items-center justify-center">
                                                    <i class="fal fa-file-certificate"></i>
                                                    <span class="text-sm mt-2 text-gray-500">لایسنس گذاری</span>
                                                </a>
                                            </div>
                                            <div class="flex gap-4 mt-4">
                                                <a href="{{ $item->access == 'subscribe' ? '#' : route('profile.products.service' , ['product' => $item->slug]) }}"
                                                   class="{{ $item->access == 'subscribe' ? 'bg-gray-100' : 'bg-white' }} w-1/2 shadow-md p-5 rounded-md hover:shadow-lg duration-200 flex flex-col items-center justify-center">
                                                    <i class="fal fa-cube"></i>
                                                    <span class="text-sm mt-2 text-gray-500">سرویس ها</span>
                                                    @if($item->access == 'subscribe')
                                                        <span class="text-red-400 text-xs">ویژه لایسنس نقدی</span>
                                                    @endif
                                                </a>
                                                <a href="{{ route('profile.products.faq', ['product' => $item->slug]) }}"
                                                   class="w-1/2 bg-white shadow-md p-5 rounded-md hover:shadow-lg duration-200 flex flex-col items-center justify-center">
                                                    <i class="fal fa-question"></i>
                                                    <span class="text-sm mt-2 text-gray-500">سوالات متداول</span>
                                                </a>
                                            </div>
                                        </x-site.info-modal>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            </div>
        @endif

    </div>
</div>
<x-slot name="script">

</x-slot>

