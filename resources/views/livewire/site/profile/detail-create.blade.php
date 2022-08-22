<x-slot name="style">
    <link rel="stylesheet" href="{{ asset('assets/site/scss/uppy.css') }}">
</x-slot>

<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
        <div class="col-span-12 lg:col-span-8 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">ارسال بروزرسانی جزئیات</h4>
            <a href="{{ $product->path() }}" target="_blank" class="text-sm text-gray-500 dark:text-gray-400">{{ $product->fa_title }}</a>
        </div>
    </div>

    <form method="POST" wire:submit.prevent="send">
        @csrf

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12 lg:col-span-6 mb-3 lg:mb-0">
                <x-auth.label for="demo" class="mb-1" value="لینک دمو"/>

                <x-auth.input wire:model.defer="demo" class="block mt-1 w-full" type="text"/>
                <x-auth.auth-validation-error name="demo"/>
            </div>
        </div>

        <p class="text-center border-b mt-8 mb-3 pb-3 dark:text-primary-400">تصاویر</p>
        <div class="bg-orange-100 text-orange-400 p-4 rounded-md text-xs">
            تمام تصاویر باید در سایز مورد نظر و پسوند png باشند، در غیر اینصورت مورد تایید نیست. قبل از آپلود، تصاویر را
            در سایت <a href="https://tinypng.com" target="_blank" class="text-black bold">tinypng.com</a> بهینه کنید.
        </div>
        <div class="flex items-center gap-5 mt-4">
            <x-auth.auth-validation-error name="icon"/>
            <x-auth.auth-validation-error name="mini_cover"/>
            <x-auth.auth-validation-error name="cover"/>
            <x-auth.auth-validation-error name="cover2"/>
        </div>
        <div class="grid grid-cols-12 gap-5 my-5">
            <div class="col-span-6 lg:col-span-1">
                <div id="select-icon"
                     class="bg-gray-200 rounded-md cursor-pointer flex items-center justify-center relative overflow-hidden"
                     style="width:80px; height: 80px;">
                    <div class="flex flex-col items-center text-gray-600">
                        <i class="fal fa-image text-xl mb-2"></i>
                        <span class="text-sm mb-1">آیکون</span>
                        <span class="text-xs">80*80</span>
                    </div>

                    @if($icon)
                        <div class="absolute top-0 bottom-0 left-0 right-0">
                            <img src="{{ img_url($icon) }}">
                            <span
                                class="bg-green-400 rounded-full p-1 text-xs text-white text-center absolute top-1 left-1">آپلود شد</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-span-12 lg:col-span-3">
                <div id="select-mini-cover"
                     class="bg-gray-200 rounded-md cursor-pointer flex items-center justify-center relative overflow-hidden"
                     style="height: 230px">
                    <div class="flex flex-col items-center text-gray-600">
                        <i class="fal fa-image text-3xl mb-2"></i>
                        <span class="text-sm mb-1">تصویر کوچک</span>
                        <span class="text-xs">400*400</span>
                    </div>
                    @if($mini_cover)
                        <div class="absolute top-0 bottom-0 left-0 right-0">
                            <img class="w-full h-full object-cover"
                                 src="{{ img_url($mini_cover) }}">
                            <span
                                class="bg-green-400 rounded-full py-1 px-3 text-sm text-white text-center absolute top-4 left-4">آپلود شد</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-span-12 lg:col-span-4">
                <div id="select-cover"
                     class="bg-gray-200 rounded-md cursor-pointer flex items-center justify-center relative overflow-hidden"
                     style="height: 330px">
                    <div class="flex flex-col items-center text-gray-600">
                        <i class="fal fa-image text-3xl mb-2"></i>
                        <span class="text-sm mb-1">کاور اول</span>
                        <span class="text-xs">700*700</span>
                    </div>

                    @if($cover)
                        <div class="absolute top-0 bottom-0 left-0 right-0">
                            <img class="w-full h-full object-cover"
                                 src="{{ img_url($cover) }}">
                            <span
                                class="bg-green-400 rounded-full py-1 px-3 text-sm text-white text-center absolute top-4 left-4">آپلود شد</span>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-span-12 lg:col-span-4">
                <div id="select-cover2"
                     class="bg-gray-200 rounded-md cursor-pointer flex items-center justify-center relative overflow-hidden"
                     style="height: 330px">
                    <div class="flex flex-col items-center text-gray-600">
                        <i class="fal fa-image text-3xl mb-2"></i>
                        <span class="text-sm mb-1">کاور دوم</span>
                        <span class="text-xs">700*700</span>
                    </div>

                    @if($cover2)
                        <div class="absolute top-0 bottom-0 left-0 right-0">
                            <img class="w-full h-full object-cover"
                                 src="{{ img_url($cover2) }}">
                            <span
                                class="bg-green-400 rounded-full py-1 px-3 text-sm text-white text-center absolute top-4 left-4">آپلود شد</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="flex flex-col mt-8">
            <div>
                <span wire:loading wire:target="send" class="text-xs text-primary-500">در حال ثبت، منتظر باشید...</span>
                <button wire:loading.remove wire:target="send" type="submit" class="btn btn-primary">ارسال</button>
            </div>
        </div>
    </form>

</div>

<x-slot name="script">
    <script src="{{ asset('assets/site/js/uppy.js') }}"></script>
</x-slot>
