<x-slot name="style">
    <link rel="stylesheet" href="{{ asset('assets/site/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/scss/uppy.css') }}">
</x-slot>
<div class="dir-rtl">
    <div class="text-center mt-8 lg:mt-20 w-full lg:max-w-3xl mx-auto">
        <img class="mx-auto" width="180px" src="{{ asset('assets/site/images/seller-icon.png') }}" alt="فروشنده شوید">
        <p class="text-xl font-bold text-gray-500 dark:text-white mt-8 mb-3">تایید حساب کاربری</p>
        <p class="text-sm text-gray-500">شما میتوانید با سیستم تایید هویت فروشندگان، حساب کاربری خود را به عنوان فروشنده
            تایید نمایید و فعالیت خود در اشتراک وردپرس را شروع کنید و با ارائه محصولات با کیفیت وردپرسی درآمد میلیونی
            داشته باشید.</p>

        <ul class="my-10">
            <li class="flex items-center gap-3 mb-4">
                <i class="fal fa-check-circle text-lg text-primary-400"></i>
                <span class="text-sm dark:text-white">اسکن پشت و روی کارت ملی خود (فروشنده) را به صورت خوانا و رنگی در فرمت zip در فیلد مدارک آپلود کنید</span>
            </li>
            <li class="flex items-center gap-3 mb-4">
                <i class="fal fa-check-circle text-lg text-primary-400"></i>
                <span class="text-sm dark:text-white">اطلاعات حساب بانکی خود در فرم زیر را با دقت وارد کنید چون جهت تسویه حساب می باشد و قابل تغییر نیست.</span>
            </li>
            <li class="flex items-center gap-3 mb-4">
                <i class="fal fa-check-circle text-lg text-primary-400"></i>
                <span class="text-sm dark:text-white">مشخصات دارنده حساب بانکی با مشخصات هویتی فروشنده باید تطابق داشته باشند.</span>
            </li>
            <li class="flex items-center gap-3 mb-4">
                <i class="fal fa-check-circle text-lg text-primary-400"></i>
                <span class="text-sm dark:text-white">در حال حاضر فقط افراد حقیقی میتوانند به عنوان فروشنده در اشتراک وردپرس ثبت نام کنند.</span>
            </li>
        </ul>
    </div>

    @if(auth()->user()->isAuthor())
        <div class="bg-green-100 rounded-md p-4 text-green-500 text-sm">
            شما هم اکنون در اشتراک وردپرس فروشنده تایید شده هستید، اولین محصول خود را ارسال کنید و از کسب درآمد آنلاین لذت ببرید
            <a href="{{ route('profile.products') }}" class="btn btn-green mr-2">ثبت محصول جدید</a>
        </div>
    @else
        @if($seller && $seller['status'] == 'pending')
            <div class="bg-orange-100 rounded-md p-4 text-orange-500 text-sm">
                شما یک درخواست در دست بررسی دارید، بزودی تا ساعاتی دیگر توسط کارشناسان اشتراک وردپرس درخواستتان بررسی میشود،
                لطفا صبور باشید...
                <p class="text-gray-800 text-xs">زمان ثبت درخواست: {{ d_date($seller->created_at) }}</p>
            </div>
        @else
            @if($seller && $seller['status'] == 'failed')
                <div class="bg-gray-200 rounded-md p-4 text-gray-500 text-sm">
                    آخرین درخواست شما متاسفانه توسط کارشناسان اشتراک وردپرس بررسی و رفع شده است! لطفا پس از بررسی دلیل رد،
                    مجدد درخواست خود را ثبت نمایید
                    <div class="flex items-center justify-between mt-3 text-xs text-gray-800">
                    <span>
                        دلیل رد: {{ $seller->description }}
                    </span>
                        <span>
                        زمان بررسی: {{ d_date($seller->updated_at) }}
                    </span>
                    </div>
                </div>
            @endif
            <div class="bg-yellow-100 rounded-md p-4 text-yellow-500 my-4 text-sm">
                توجه: درخواست فروشندگی شما به منزله مطالعه کامل و پذیرش <a class="text-black" target="_blank" href="{{ route('product-rules') }}">قوانین فروشندگان</a> اشتراک وردپرس است.
            </div>
            <div class="mt-20">
                <form method="POST" wire:submit.prevent="send">
                    @csrf

                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 lg:col-span-6">
                            <div class="flex items-center justify-between">
                                <x-auth.label for="email" value="ایمیل"/>
                                <span class="text-gray-500 text-xs">قابل تغییر نیست</span>
                            </div>

                            <div class="relative">
                                <x-auth.input id="email" disabled class="block mt-1 w-full bg-gray-200" type="email"
                                              :value="$email"/>
                            </div>

                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <div class="flex items-center justify-between">
                                <x-auth.label for="phone" value="موبایل"/>
                                <span class="text-gray-500 text-xs">قابل تغییر نیست</span>
                            </div>

                            <div class="relative">
                                <x-auth.input id="phone" disabled class="block mt-1 w-full bg-gray-200" type="text"
                                              :value="$phone"/>
                                @if(!$phone_verified_at)
                                    <a href="{{ route('profile.edit' , ['type' => 'phone']) }}"
                                       class="btn btn-yellow text-xs absolute left-1.5 top-1.5">ثبت و تایید
                                        موبایل</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <div class="flex items-center justify-between">
                                <x-auth.label for="name" value="نام"/>
                                <span class="text-gray-500 text-xs">ترجیحا فارسی</span>
                            </div>

                            <x-auth.input wire:model.defer="name" id="name" class="block mt-1 w-full" type="text"/>
                            <x-auth.auth-validation-error name="name"/>
                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <div class="flex items-center justify-between">
                                <x-auth.label for="family" value="نام خانوادگی"/>
                                <span class="text-gray-500 text-xs">ترجیحا فارسی</span>
                            </div>

                            <x-auth.input wire:model.defer="family" id="family" class="block mt-1 w-full" type="text"/>
                            <x-auth.auth-validation-error name="family"/>
                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <div class="flex items-center justify-between">
                                <x-auth.label for="author_name" value="نام فروشگاه"/>
                                <span class="text-gray-500 text-xs">فارسی</span>
                            </div>

                            <x-auth.input wire:model.defer="author_name" id="author_name" class="block mt-1 w-full"
                                          type="text"/>
                            <x-auth.auth-validation-error name="author_name"/>
                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <div class="flex items-center justify-between">
                                <x-auth.label for="author_slug" value="آدرس فروشگاه"/>
                                <span class="text-gray-500 text-xs">لاتین</span>
                            </div>

                            <x-auth.input wire:model.lazy="author_slug" id="author_slug" class="block mt-1 w-full"
                                          type="text"/>
                            <p class="text-xs text-gray-500 text-left dir-ltr">
                                https://subwp.ir/web/store/{{ $author_slug }}</p>
                            <x-auth.auth-validation-error name="author_slug"/>
                        </div>

                        <div class="col-span-12 lg:col-span-6">
                            <div class="flex items-center justify-between">
                                <x-auth.label for="card_name" value="نام صاحب حساب"/>
                                <span class="text-gray-500 text-xs">فارسی</span>
                            </div>

                            <x-auth.input wire:model.defer="card_name" id="card_name" class="block mt-1 w-full"
                                          type="text"/>
                            <x-auth.auth-validation-error name="card_name"/>
                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <div class="flex items-center justify-between">
                                <x-auth.label for="card_meli" value="کد ملی صاحب حساب"/>
                            </div>

                            <x-auth.input wire:model.defer="card_meli" id="card_meli" class="block mt-1 w-full"
                                          type="text"/>
                            <x-auth.auth-validation-error name="card_meli"/>
                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <div class="flex items-center justify-between">
                                <x-auth.label for="bank_name" value="نام بانک"/>
                            </div>

                            <select class="select2 form-control" id="bank_name">
                                <option value="">انتخاب بانک ...</option>
                                @foreach(get_bank_list() as $key => $item)
                                    <option
                                        {{ $key == $bank_name ? 'selected' : '' }} value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <x-auth.auth-validation-error name="bank_name"/>
                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <div class="flex items-center justify-between">
                                <x-auth.label for="card_serial" value="شماره حساب"/>
                            </div>

                            <x-auth.input wire:model.defer="card_serial" id="card_serial" class="block mt-1 w-full"
                                          type="text"/>
                            <x-auth.auth-validation-error name="card_serial"/>
                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <div class="flex items-center justify-between">
                                <x-auth.label for="card_number" value="شماره کارت"/>
                            </div>

                            <x-auth.input wire:model.defer="card_number" id="card_number" class="block mt-1 w-full"
                                          type="text"/>
                            <x-auth.auth-validation-error name="card_number"/>
                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <div class="flex items-center justify-between">
                                <x-auth.label for="card_sheba" value="شماره شبا"/>
                                <span class="text-gray-500 text-xs">بدون IR وارد شود</span>
                            </div>

                            <x-auth.input wire:model.defer="card_sheba" id="card_sheba" class="block mt-1 w-full"
                                          type="text"/>
                            <x-auth.auth-validation-error name="card_sheba"/>
                        </div>
                    </div>

                    <div class="ticket-files flex items-center my-5 gap-4">
                        <span id="select-files" class="btn btn-gray cursor-pointer">+ انتخاب مدرک</span>

                        @foreach($files as $key => $file)
                            <div class="bg-gray-200 rounded-md py-2 px-3 relative">
                                <i wire:click="removeFile({{ $key }})"
                                   class="fal fa-times cursor-pointer absolute text-xs -top-2 -left-2 text-white bg-red-400 rounded-full py-0.5 px-1"></i>
                                <a href="{{ $file['url'] }}" target="_blank" class="text-xs">{{ $file['name'] }}</a>
                            </div>
                        @endforeach
                    </div>
                    <x-auth.auth-validation-error name="files"/>

                    <div class="flex justify-end mt-8">
                        @if(!$phone_verified_at)
                            <a href="{{ route('profile.edit' , ['type' => 'phone']) }}" class="text-red-500 text-sm">ابتدا شماره موبایل خود را ثبت و تایید کنید</a>
                        @else
                            <button class="btn btn-primary" type="submit">ثبت اطلاعات</button>
                        @endif
                    </div>

                </form>
            </div>
        @endif
    @endif

</div>
<x-slot name="script">
    <script src="{{ asset('assets/site/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/uppy.js') }}"></script>

    <script>
        window.initSelectStationDrop = () => {
            $("#bank_name").select2({
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

        $('#bank_name').on('change', function (e) {
            var data = $('#bank_name').select2("val");
            @this.set('bank_name', data);
        });
    </script>
</x-slot>

