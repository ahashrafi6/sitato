<x-slot name="style">
    <link rel="stylesheet" href="{{ asset('assets/site/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/site/scss/uppy.css') }}">
</x-slot>

<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
        <div class="col-span-12 lg:col-span-8 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">ارسال تیکت</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">دریافت پشتیبانی با ثبت تیکت</p>
        </div>
    </div>


    <div x-data="{ supportModal: @entangle('supportModal').defer }">

        <div x-show="supportModal" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="fixed top-0 bottom-0 right-0 w-full h-full bg-black bg-opacity-60 z-80">

            @if ($licence_select)

            <div
                class="bg-white dark:bg-gray-700 rounded-lg overflow-hidden shadow-xl transform transition-all w-11/12 lg:w-4/12 mx-auto mt-8 xl:mt-16 py-8 px-6 dir-rtl relative">
                <div class="flex items-center justify-between mb-5">
                    <span class="text-lg font-bold dark:text-white">اتمام پشتیبانی</span>
                    <i @click="supportModal = false"
                        class="fal fa-times text-gray text-xl cursor-pointer dark:text-white"></i>
                </div>

                <p class="text-xs text-gray-500 mb-3">مدت زمان پشتیبانی شما تمام شده است، جهت ارسال تیکت باید پشتیبانی
                    خود را تمدید نمایید.</p>
                <p class="text-sm text-gray-500 mb-3">محصول: <span class="font-bold">{{
                        $licence_select->product->fa_title }}</span></p>
                <p class="text-sm text-gray-500 mb-5">مدت زمان: <span class="font-bold text-lg">{{ $licence_select->plan->support }} ماه</span>
                </p>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500">مبلغ: <span class="text-dark font-bold text-lg">{{
                            number_format($licence_select->plan->price * 15 / 100) }}</span>تومان</span>

                    <div>
                        <span wire:loading.remove wire:target="support" wire:click="support( {{ $licence_select->id }})"
                            class="btn btn-green cursor-pointer">پرداخت</span>
                        <span wire:loading wire:target="support" class="text-gray-500 text-xs">منتظر باشید...</span>
                    </div>

                </div>
            </div>

            @endif

        </div>
    </div>



    <div x-data="{ domainModal: @entangle('domainModal').defer }">

        <div x-show="domainModal" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="fixed top-0 bottom-0 right-0 w-full h-full bg-black bg-opacity-60 z-80">

            <div
                class="bg-white dark:bg-gray-700 rounded-lg overflow-hidden shadow-xl transform transition-all w-11/12 lg:w-4/12 mx-auto mt-8 xl:mt-16 py-8 px-6 dir-rtl relative">
                <div class="flex items-center justify-between mb-5">
                    <span class="text-lg font-bold dark:text-white">افزودن شناسه</span>
                    <i @click="domainModal = false"
                        class="fal fa-times text-gray text-xl cursor-pointer dark:text-white"></i>
                </div>

                <p class="text-sm text-gray-500 mb-3">امکان ارسال تیکت پشتیبانی در حال حاضر برای این برنامه فعال نیست. ابتدا در بخش برنامه ها، یک شناسه برای این برنامه در نظر بگیرید تا فرآیند راه اندازی آن خودکار آغاز شود</p>


            </div>

        </div>
    </div>

    <form method="POST" wire:submit.prevent="save">
        @csrf

        <div class="grid grid-cols-12 gap-3">
            <div wire:ignore class="col-span-12 lg:col-span-6 mb-3 lg:mb-0">
                <x-auth.label class="mb-1" value="دپارتمان" />
                <select class="select2 form-control h-10" id="department">
                    <option value="">انتخاب دپارتمان ...</option>
                    <option value="product">پشتیبانی محصول</option>
                    <option value="subwp">ارتباط با سایتاتو</option>
                </select>
                <x-auth.auth-validation-error name="department" />
            </div>
            <div class="col-span-12 lg:col-span-6 mb-3 lg:mb-0">
                <x-auth.label class="mb-1" value="بخش" />
                <select class="select2 form-control h-10" id="type">
                    <option value="">انتخاب بخش ...</option>
                    @foreach(\App\Models\Ticket::TYPE as $key => $item)
                    @if($item['department'] == $department)
                    <option {{ $type==$key ? 'selected' : '' }} value="{{ $key }}">{{ $item['title'] }}</option>
                    @endif
                    @endforeach
                </select>
                <x-auth.auth-validation-error name="type" />
            </div>

{{--             <div class="{{ $search_products_status ? 'block' : 'hidden' }} col-span-12 lg:col-span-6 mb-3 lg:mb-0">
                @if($product)
                <p class="bg-white p-4 rounded-md">محصول مورد نظر انتخاب شد</p>
                @else
                <x-auth.label class="mb-1" value="محصول (نام یک محصول را تایپ کنید)" />
                <select class="select2-data-ajax-products form-control" id="search-products"></select>
                @error('product')
                <div class="flex items-center dir-rtl mt-1">
                    <i class="fad fa-exclamation-circle text-sm text-red-300 pl-1"></i>
                    <p class="text-red-500 text-xs">فیلد محصول الزامی است</p>
                </div>
                @enderror
                @endif
            </div> --}}

            <div class="{{ $bought_products_status ? 'block' : 'hidden' }} col-span-12 lg:col-span-6 mb-3 lg:mb-0">
                <x-auth.label class="mb-1" value="لایسنس (محصول)" />
                <select class="select2 form-control" id="bought-products">
                    <option value="">انتخاب لایسنس ...</option>
                    @foreach($bought_products as $item)
                    <option {{ $item->id == $licence ? 'selected' : ''}} value="{{ $item->id }}">{{
                        $item->product->fa_title . '-شناسه: ' . $item->username}}</option>
                    @endforeach
                </select>
                @error('licence')
                <div class="flex items-center dir-rtl mt-1">
                    <i class="fad fa-exclamation-circle text-sm text-red-300 pl-1"></i>
                    <p class="text-red-500 text-xs">فیلد لایسنس (محصول) الزامی است</p>
                </div>
                @enderror
            </div>
            {{--
            <div class="{{ $author_products_status ? 'block' : 'hidden' }} col-span-12 lg:col-span-6 mb-3 lg:mb-0">
                <x-auth.label class="mb-1" value="محصول" />
                <select class="select2 form-control" id="author-products">
                    <option value="">انتخاب محصول ...</option>
                    @if($author_products)
                    @foreach($author_products as $item)
                    <option {{ $item->id == $product ? 'selected' : ''}} value="{{ $item->id }}">{{ $item->fa_title }}
                    </option>
                    @endforeach
                    @endif
                </select>
                @error('product')
                <div class="flex items-center dir-rtl mt-1">
                    <i class="fad fa-exclamation-circle text-sm text-red-300 pl-1"></i>
                    <p class="text-red-500 text-xs">فیلد محصول الزامی است</p>
                </div>
                @enderror
            </div> --}}


            <div class="col-span-12 mb-3 lg:mb-0">
                <x-auth.label for="username" class="mb-1" value="عنوان تیکت" />

                <x-auth.input wire:model.defer="title" class="block mt-1 w-full" type="text" />
                <x-auth.auth-validation-error name="title" />
            </div>

            <div class="col-span-12 mb-3 lg:mb-0">
                <x-auth.label for="body" class="mb-1" value="متن تیکت" />

                <textarea rows="6" wire:model.defer="body"
                    class="w-full rounded-md focus:ring-0 border-gray-200 transition text-sm leading-loose text-gray-500"
                    placeholder="توضیح ..."></textarea>
                <x-auth.auth-validation-error name="body" />
            </div>
        </div>


        <div class="ticket-files flex items-center my-5 gap-4">
            <span id="select-files" class="btn btn-gray cursor-pointer">+ پیوست فایل</span>

            @foreach($files as $key => $file)
            <div class="bg-gray-200 rounded-md py-2 px-3 relative">
                <i wire:click="removeFile({{ $key }})"
                    class="fal fa-times cursor-pointer absolute text-xs -top-2 -left-2 text-white bg-red-400 rounded-full py-0.5 px-1"></i>
                <a href="{{ img_url($file['url']) }}" target="_blank" class="text-xs">{{ $file['name'] }}</a>
            </div>
            @endforeach
        </div>


        <div class="flex justify-end">
            <span wire:loading wire:target="save" class="text-xs text-primary-500">در حال ثبت، منتظر باشید...</span>
            <button wire:loading.remove wire:target="save" type="submit" class="btn btn-primary">ثبت تیکت</button>
        </div>
    </form>

</div>

<x-slot name="script">
    <script src="{{ asset('assets/site/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/site/js/uppy.js') }}"></script>

    <script>
        //select2


        window.initSelectStationDrop = () => {
            $("#department").select2({
                dropdownAutoWidth: true,
                width: '100%',
                language: "fa",
                dir: "rtl",
            });
            $("#type").select2({
                dropdownAutoWidth: true,
                width: '100%',
                language: "fa",
                dir: "rtl",
            });
            $("#bought-products").select2({
                dropdownAutoWidth: true,
                width: '100%',
                language: "fa",
                dir: "rtl",
            });
        /*     $("#author-products").select2({
                dropdownAutoWidth: true,
                width: '100%',
                language: "fa",
                dir: "rtl",
            }); */

            //ajax data select2 products
            $(".select2-data-ajax-products").select2({
                dropdownAutoWidth: true,
                width: '100%',
                language: "fa",
                dir: "rtl",
                ajax: {
                    url: "/dashboard/products-search",
                    dataType: 'json',
                    data: function (params) {
                        return {
                            q: params.term,
                        };
                    },
                    processResults: function (data, params) {
                        return {
                            results: data.items,
                        };
                    },
                },
                placeholder: 'نام یک محصول را جستجو کنید',
                escapeMarkup: function (markup) {
                    return markup;
                },
                minimumInputLength: 1,
                templateResult: formatRepo_title,
                templateSelection: formatRepoSelection_title
            });

            function formatRepo_title(repo) {
                if (repo.loading) return repo.text;

                var markup = "<div class='select2-result-repository clearfix'>" + repo.fa_title + "</div>";

                return markup;
            }

            function formatRepoSelection_title(repo) {
                return repo.fa_title;
            }
        }
        initSelectStationDrop();
        window.livewire.on('select2', () => {
            initSelectStationDrop();
        });

        $('#search-products').on('change', function (e) {
            var data = $('#search-products').select2("val");
        @this.set('product', data);
        });
        $('#bought-products').on('change', function (e) {
            var data = $('#bought-products').select2("val");
        @this.set('licence', data);
        });
   /*      $('#author-products').on('change', function (e) {
            var data = $('#author-products').select2("val");
        @this.set('product', data);
        }); */

        $('#type').on('change', function (e) {
            var data = $('#type').select2("val");
        @this.set('type', data);
        });

        $('#department').on('change', function (e) {
            var data = $('#department').select2("val");
        @this.set('department', data);
        });

    </script>
</x-slot>