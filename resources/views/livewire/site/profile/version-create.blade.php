<x-slot name="style">
    <link rel="stylesheet" href="{{ asset('assets/site/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/scss/uppy.css') }}">
</x-slot>

<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
        <div class="col-span-12 lg:col-span-8 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">ارسال بروزرسانی</h4>
            <a href="{{ $product->path() }}" target="_blank" class="text-sm text-gray-500 dark:text-gray-400">{{ $product->fa_title }}</a>
        </div>
    </div>

    <form method="POST" wire:submit.prevent="send">
        @csrf

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12 lg:col-span-6 mb-3 lg:mb-0">
                <x-auth.label for="version" class="mb-1" value="نسخه"/>

                <x-auth.input wire:model.defer="version" class="block mt-1 w-full" type="text"/>
                <x-auth.auth-validation-error name="version"/>
            </div>
            <div wire:ignore class="col-span-12 lg:col-span-6 mb-3 lg:mb-0">
                <x-auth.label class="mb-1" value="نوع لایسنس"/>
                <select class="select2 form-control h-10" id="access">
                    <option value="cash" {{ $access == 'cash' ? 'selected' : '' }}>نقدی</option>
                    <option value="subscribe" {{ $access == 'subscribe' ? 'selected' : '' }}>اشتراک</option>
                    <option value="full" {{ $access == 'full' ? 'selected' : '' }}>نقدی + اشتراک</option>
                </select>
                <x-auth.auth-validation-error name="access"/>
            </div>
        </div>

        <p class="text-center border-b mt-8 mb-3 pb-3 dark:text-primary-400">فایل ها</p>
        <div class="grid grid-cols-12 gap-5 my-5">
            <div class="col-span-12 lg:col-span-4">
                <div class="bg-white rounded-lg p-4 relative">
                    <span id="select-main-file" class="cursor-pointer btn btn-gray absolute top-4 left-4 text-xs">
                        @if($main_file)
                            تغییر فایل
                        @else
                            انتخاب فایل
                        @endif
                    </span>
                    <p class="mb-3">فایل اصلی</p>
                    <ul class="text-xs text-gray-500">
                        <li class="mb-2">پسوند فایل: zip</li>
                        <li>حجم فایل: حداکثر 700 مگابایت</li>
                    </ul>
                    @if($main_file)
                        <div class="mt-3 bg-green-400 gap-3 rounded-md p-2 flex items-center text-white">
                            <i class="fal fa-check text-md"></i>
                            <span class="text-xs">فایل با موفقیت آپلود شد</span>
                        </div>
                        <span class="text-xs text-gray-500 mt-1">{{ $main_file['name'] }}</span>
                    @endif
                    <x-auth.auth-validation-error name="main_file"/>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-4">
                <div class="bg-white rounded-lg p-4 relative">
                    <span id="select-cash-file" class="cursor-pointer btn btn-gray absolute top-4 left-4 text-xs">
                        @if($cash_file)
                            تغییر فایل
                        @else
                            انتخاب فایل
                        @endif
                    </span>
                    <p class="mb-3">فایل بروزرسانی</p>
                    <ul class="text-xs text-gray-500">
                        <li class="mb-2">پسوند فایل: zip</li>
                        <li>حجم فایل: حداکثر 50 مگابایت</li>
                    </ul>
                    @if($cash_file)
                        <div class="mt-3 bg-green-400 gap-3 rounded-md p-2 flex items-center text-white">
                            <i class="fal fa-check text-md"></i>
                            <span class="text-xs">فایل با موفقیت آپلود شد</span>
                        </div>
                        <span class="text-xs text-gray-500 mt-1">{{ $cash_file['name'] }}</span>
                    @endif
                    <x-auth.auth-validation-error name="cash_file"/>
                </div>
            </div>


            <div class="col-span-12 lg:col-span-4">
                <div class="bg-white rounded-lg p-4 relative">
                    <span id="select-help-file" class="cursor-pointer btn btn-gray absolute top-4 left-4 text-xs">
                        @if($help_file)
                            تغییر فایل
                        @else
                            انتخاب فایل
                        @endif
                    </span>
                    <p class="mb-3">فایل راهنما</p>
                    <ul class="text-xs text-gray-500">
                        <li class="mb-2">پسوند فایل: pdf</li>
                        <li>حجم فایل: حداکثر 10 مگابایت</li>
                    </ul>
                    @if($help_file)
                        <div class="mt-3 bg-green-400 gap-3 rounded-md p-2 flex items-center text-white">
                            <i class="fal fa-check text-md"></i>
                            <span class="text-xs">فایل با موفقیت آپلود شد</span>
                        </div>
                        <span class="text-xs text-gray-500 mt-1">{{ $help_file['name'] }}</span>
                    @endif
                    <x-auth.auth-validation-error name="help_file"/>
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
    <script src="{{ asset('assets/site/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/uppy.js') }}"></script>

    <script>
        // select2
        window.initSelectStationDrop = () => {
            $("#access").select2({
                dropdownAutoWidth: true,
                width: '100%',
                language: "fa",
                dir: "rtl",
            });
        }
        initSelectStationDrop();
        window.livewire.on('select2', () => {
            initSelectStationDrop();
        });


        $('#access').on('change', function (e) {
            var data = $('#access').select2("val");
        @this.set('access', data);
        });

    </script>
</x-slot>
