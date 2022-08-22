<x-slot name="style">
    <link rel="stylesheet" href="{{ asset('assets/site/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/scss/uppy.css') }}">
</x-slot>

<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
        <div class="col-span-12 lg:col-span-8 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">محصول جدید</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">ارسال محصول جدید برای فروش در اشتراک وردپرس</p>
        </div>
    </div>

    <form method="POST" wire:submit.prevent="send">
        @csrf

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12 lg:col-span-6 mb-3 lg:mb-0">
                <x-auth.label for="fa_title" class="mb-1" value="نام محصول"/>

                <x-auth.input wire:model.defer="fa_title" class="block mt-1 w-full" type="text"/>
                <x-auth.auth-validation-error name="fa_title"/>
            </div>
            <div class="col-span-12 lg:col-span-6 mb-3 lg:mb-0">
                <x-auth.label for="en_title" class="mb-1" value="نام انگلیسی محصول"/>

                <x-auth.input wire:model.defer="en_title" class="block mt-1 w-full" type="text"/>
                <x-auth.auth-validation-error name="en_title"/>
            </div>
            <div class="col-span-12 lg:col-span-6 mb-3 lg:mb-0">
                <x-auth.label class="mb-1" value="دسته بندی"/>
                <div wire:ignore>
                    <select class="select2 form-control h-10" id="category">
                        <option value="">انتخاب دسته ...</option>
                        @foreach($categories as $item)
                            <option value="{{ $item->id }}">{{ $item->fa_title }}</option>
                        @endforeach
                    </select>
                </div>
                <x-auth.auth-validation-error name="category"/>
            </div>
            <div class="col-span-12 mb-3 lg:mb-0">
                <x-auth.label for="body" class="mb-1" value="محتوا"/>

                <div wire:ignore>
                    <textarea wire:model.defer="body" class="sub-editor"></textarea>
                </div>

                <x-auth.auth-validation-error name="body"/>
            </div>

            <div class="col-span-12 lg:col-span-6 mb-3 lg:mb-0">
                <x-auth.label for="demo" class="mb-1" value="لینک دمو"/>

                <x-auth.input wire:model.defer="demo" class="block mt-1 w-full" type="text"/>
                <x-auth.auth-validation-error name="demo"/>
            </div>
            <div class="col-span-12 lg:col-span-6 mb-3 lg:mb-0">
                <x-auth.label for="version" class="mb-1" value="نسخه"/>

                <x-auth.input wire:model.defer="version" class="block mt-1 w-full" type="text"
                              placeholder="مثال: 1.0.0"/>
                <x-auth.auth-validation-error name="version"/>
            </div>
            <div class="col-span-12 lg:col-span-6 mb-3 lg:mb-0">
                <x-auth.label for="price" class="mb-1" value="قیمت پیشنهادی (تومان)"/>

                <x-auth.input wire:model.defer="price" class="block mt-1 w-full" type="text"/>
                <x-auth.auth-validation-error name="price"/>
            </div>
            <div wire:ignore class="col-span-12 lg:col-span-6 mb-3 lg:mb-0">
                <x-auth.label class="mb-1" value="نوع لایسنس"/>
                <select class="select2 form-control h-10" id="access">
                    <option value="cash">نقدی</option>
                    <option value="subscribe">اشتراک</option>
                    <option value="full">نقدی + اشتراک</option>
                </select>
                <x-auth.auth-validation-error name="access"/>
            </div>
        </div>

        <p class="text-center border-b mt-8 mb-3 pb-3 dark:text-primary-400">تصاویر</p>
        <div class="bg-orange-100 text-orange-400 p-4 rounded-md text-xs">
            <p class="text-sm font-bold">راهنما تصاویر</p>
            <p>تمام تصاویر باید در سایز مورد نظر و پسوند png باشند، در غیر اینصورت مورد تایید نیست. قبل از آپلود، تصاویر را
                در سایت <a href="https://tinypng.com" target="_blank" class="text-black bold">tinypng.com</a> بهینه کنید.</p>
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

        <p class="text-center border-b mt-8 mb-3 pb-3 dark:text-primary-400">فایل ها</p>
        <div class="bg-orange-100 p-4 rounded-md mb-3">
            <p class="font-bold text-orange-400 text-sm">استاندارد فایل های محصول</p>
            <div class="flex items-center">
                <p class="text-xs text-orange-400">ساختار فایل های محصول باید کاملا مطابق استاندارد اشتراک وردپرس باشد.</p>
                <x-site.info-modal :name="8">
                    <x-slot name="button">
                        <span class="font-bold cursor-pointer text-black text-sm">(مشاهده استاندارد فایل های محصول)</span>
                    </x-slot>

                    <x-slot name="title">استاندارد محصول</x-slot>

                   <div class="overflow-y-scroll h-96">
                       <p class="mb-4 dark:text-white">- فروشندگان محترم توجه داشته باشند  لازم است قبل از ارسال، محصول خود را در محیط استاندارد تست و سپس مطابق استاندارد هر دسته برای محصول پکیج دانلودی ایجاد نمایند و قبل از ارسال محصول فایل پکیج ایجاد شده را در سایت
                           <a class="text-primary-400" href="https://virustotal.com">virustotal.com</a> اسکن نموده و سپس اقدام به ارسال محصول نمایند.</p>
                       <p class="mb-4 dark:text-white">- قبل از ارسال محصول از موجود نبودن محصول در سایت راست چین مطمئن شوید و سپس اقدام به رزرو و ارسال محصول نمایید، هر محصول فقط قابلیت ارائه توسط یک فروشنده دارد.</p>
                       <p class="font-bold text-primary-400 text-center my-4">استاندارد دسته قالب وردپرس</p>
                       <img src="{{ asset('assets/site/images/theme-structure.png') }}" alt="">
                       <p class="font-bold text-primary-400 text-center my-4">استاندارد دسته افزونه وردپرس</p>
                       <img src="{{ asset('assets/site/images/plugin-structure.png') }}" alt="">
                   </div>

                </x-site.info-modal>
            </div>
        </div>
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
            <div class="bg-orange-100 text-orange-400 p-4 rounded-md text-xs mb-3">
                <p class="text-sm font-bold">راهنما لایسنس گذاری</p>
                <p>برای لایسنس گذاری محصول قبل از ارسال محصول برای اشتراک وردپرس جهت بررسی و انتشار، ابتدا محصول را ذخیره کرده و به <span class="font-bold">لیست محصولات -> تب لایسنس گذاری</span> بروید و پس از قرار دادن لایسنس روی محصول، سپس فایل های محصول را آپلود و جهت انتشار ارسال نمایید.</p>
            </div>
            <div class="mb-2">
                <label for="publish" class="inline-flex items-center gap-2">
                    <input wire:model.defer="publish" id="publish"
                           type="checkbox"
                           class="rounded border-gray-300 text-primary-600 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50"
                           name="remember">

                    <span class="text-sm dark:text-white">محصول برای فروش به اشتراک وردپرس ارسال شود</span>
                </label>
            </div>
            <div>
                <span wire:loading wire:target="send" class="text-xs text-primary-500">در حال ثبت، منتظر باشید...</span>
                <button wire:loading.remove wire:target="send" type="submit" class="btn btn-primary">ذخیره محصول
                </button>
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
            $("#category").select2({
                dropdownAutoWidth: true,
                width: '100%',
                language: "fa",
                dir: "rtl",
            });
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
        $('#category').on('change', function (e) {
            var data = $('#category').select2("val");
        @this.set('category', data);
        });

    </script>


    <script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '.sub-editor',
            plugins: 'image code print preview directionality link table hr advlist lists textcolor wordcount colorpicker',
            toolbar: 'undo redo | formatselect fontsizeselect | bold italic strikethrough forecolor backcolor | link image | alignleft aligncenter alignright alignjustify ltr rtl | numlist bullist outdent indent | code |',
            menubar: 'edit format',
            directionality: 'rtl',
            min_height: 450,


            image_title: true,
            automatic_uploads: true,
            images_upload_url: '/tiny/upload',
            file_picker_types: 'image',

            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');


                input.onchange = function () {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function () {

                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);


                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            },


            setup: function (ed) {
                ed.on('change', function(e) {
                @this.set('body', ed.getContent());
                });
            }
        });
    </script>
</x-slot>
