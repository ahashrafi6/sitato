<x-slot name="style">
    <link rel="stylesheet" href="{{ asset('assets/site/css/select2.min.css') }}">
</x-slot>

<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
        <div class="col-span-12 lg:col-span-8 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">ایجاد حساب جدید</h4>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-700 dark:text-white text-sm duration-500 rounded-md p-5 mb-8">
        <p class="font-bold text-xl">توجه</p>
        <ul>
            <li>- لطفا شماره های حساب را بدون فاصله و خط تیره وارد نمایید</li>
            <li>- برای دریافت شماره شبای حساب خود می توانید به سایت بانک خود مراجعه فرماید</li>
        </ul>
        <div class="bg-yellow-100 rounded-md p-3 text-black mt-3">
            مسئولیت اشتباه بودن اطلاعات بر عهده ما نیست و مبلغ واریزی قابل بازگشت نمیباشد
        </div>
    </div>

    <form method="POST" wire:submit.prevent="send">
        @csrf

        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12 lg:col-span-6">
                <div class="flex items-center justify-between">
                    <x-auth.label for="title" value="عنوان حساب"/>
                    <span class="text-gray-500 text-xs">فارسی</span>
                </div>

                <x-auth.input wire:model.defer="title" id="title" class="block mt-1 w-full"
                              type="text"/>
                <x-auth.auth-validation-error name="title"/>
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


        <div class="flex flex-col mt-8">
            <div>
                <span wire:loading wire:target="send" class="text-xs text-primary-500">در حال ثبت، منتظر باشید...</span>
                <button wire:loading.remove wire:target="send" type="submit" class="btn btn-primary">ثبت</button>
            </div>
        </div>
    </form>

</div>

<x-slot name="script">
    <script src="{{ asset('assets/site/js/select2.min.js') }}"></script>

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
