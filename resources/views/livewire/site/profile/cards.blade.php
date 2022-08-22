<x-slot name="style">

</x-slot>
<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
        <div class="col-span-7 lg:col-span-3 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">حساب های بانکی</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">لیست حساب های بانکی شما</p>
        </div>
        <div class="col-span-5 lg:col-span-9 mb-3 lg:mb-0 text-left">
            <a href="{{ route('cards.create') }}" class="btn btn-primary">ایجاد حساب جدید</a>
        </div>
    </div>

    @if (session()->has('success'))
        <div class="flex items-center dir-rtl mt-1 bg-green-100 p-3 rounded-md border-2 border-green-300 mb-3">
            <p class="text-success-500 text-sm">{{ session('success') }}</p>
        </div>
    @endif

    <p class="dark:text-white" wire:loading>صبور باشید...</p>

    @if(count($cards) > 0)

        <table wire:loading.remove class="border-collapse table-fixed w-full text-sm">
            <thead>
            <tr>
                <th class="border-b dark:border-gray-600 font-medium p-4 pl-8 pt-0 pb-3 text-right dark:text-white">
                    عنوان
                </th>
                <th class="border-b dark:border-gray-600 font-medium p-4 pl-8 pt-0 pb-3 text-right dark:text-white">
                    نام بانک
                </th>
                <th class="border-b dark:border-gray-600 font-medium p-4 pt-0 pb-3 text-right dark:text-white">
                    شماره حساب
                </th>
                <th class="border-b dark:border-gray-600 font-medium p-4 pr-8 pt-0 pb-3 text-right dark:text-white">
                    شماره کارت
                </th>
                <th class="border-b dark:border-gray-600 font-medium p-4 pr-8 pt-0 pb-3 text-right dark:text-white">
                    عملیات
                </th>
            </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-700 transition duration-500">
            @foreach($cards as $key => $item)
                <tr>
                    <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                        {{ $item->title }}
                    </td>
                    <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                        {{ get_bank_list()[$item->bank_name] }}
                    </td>
                    <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                        {{ $item->card_serial }}
                    </td>
                    <td class="border-b dark:border-gray-600 p-4 dark:text-white">
                        {{ $item->card_number }}
                    </td>
                    <td class="border-b dark:border-gray-600 p-4 dark:text-white flex gap-3">
                        @if($key == 0)
                            <span class="text-xs bg-yellow-200 rounded py-2 px-3 text-black">حساب پیش فرض</span>
                        @else
                            <a href="{{ route('cards.edit' , ['card' => $item->id]) }}" class="text-blue-400">ویرایش</a>
                            <span wire:click="alertConfirm({{ $item->id }})" class="cursor-pointer">حذف</span>
                        @endif
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>

    @else
        <div class="flex flex-col justify-center items-center my-10">
            <img class="w-16" src="{{ asset('assets/site/images/empty-cart-icon.png') }}">
            <p class="text-sm text-gray-400 text-center mt-5 dark:text-white">هیچ حسابی تا این لحظه یافت نشد!</p>
        </div>
    @endif
</div>
<x-slot name="script">
    <script src="{{ asset('assets/site/js/sweetalert2.min.js') }}"></script>

    <script>
        window.addEventListener('swal:confirm', event => {

            Swal.fire({
                title: event.detail.message,
                text: event.detail.text,
                icon: event.detail.type,
                showCancelButton: true,
                confirmButtonColor: '#34c7ec',
                cancelButtonColor: '#acacac',
                confirmButtonText: 'پاک کردن',
                cancelButtonText: 'لغو',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('remove', event.detail.id);
                }
            })

        });
    </script>
</x-slot>
