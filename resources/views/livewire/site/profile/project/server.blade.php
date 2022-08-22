<div class="dir-rtl">
    <div class="bg-white dark:bg-gray-700 dark:text-white p-3 rounded-lg mb-5 text-sm">
        <span class="text-orange-500">صرفا جهت اطلاع: </span>
        <span>تمام برنامه ها به صورت یکپارچه در سرویس لیارا مستقر و نگهداری می‌شوند</span>
    </div>
    <div
        class="bg-white dark:bg-gray-700 dark:text-white p-5 rounded-lg flex items-center flex-col lg:flex-row justify-between mb-10">
        <div class="flex flex-col gap-2">
            <p class="text-primary-400">پلن فعلی سرور</p>
            <p class="text-lg font-yekan-black">{{ $project->server->fa_title }}  <span class="text-sm">منابع کل: {{ $project->server->sum }}</span></p>

            <p>سر رسید تمدید: <span class="text-blue-500">{{ verta($project->payment_end)->formatDifference(); }}</span>
            </p>
            <p>اعتبار باقی مانده استفاده نشده: <span class="text-blue-500">{{ number_format($wallet) }} تومان</span></p>
        </div>

        <div class="items-center gap-10 hidden lg:flex">
            <div>
                <p class="text-sm font-bold mb-2">منابع برنامه:</p>
                <ul class="text-sm text-gray-500 dark:text-white flex flex-col gap-2">
                    @foreach (explode(',' , $project->server->server) as $server)
                    <li>{{ $server }}</li>
                    @endforeach
                </ul>
            
            </div>
            <div>
                <p class="text-sm font-bold mb-2">منابع دیتابیس:</p>
                <ul class="text-sm text-gray-500 dark:text-white flex flex-col gap-2">
                    @foreach (explode(',' , $project->server->database) as $server)
                    <li>{{ $server }}</li>
                    @endforeach
                </ul>
            
            </div>
        </div>
    </div>
    <div>

        @if (count($servers))

        <p class="mb-5">شما میتوانید سرور برنامه خود را به پلن های زیر ارتقا دهید</p>
        <div class="my-5 bg-gray-200 text-center p-3 rounded-lg">توجه نمایید امکان بازگشت به پلن پایین تر وجود ندارد
        </div>

        <p class="text-lg font-bold dark:text-white mb-2">دوره تمدید</p>
        <div class="grid grid-cols-12 gap-3 plans-holder">
            <div class="col-span-12 lg:col-span-4">
                <select wire:model="per_select" class="border-0 rounded-md">
                    @foreach ($per as $key => $item)
                    <option value="{{ $key }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>

        </div>


        <div class="grid grid-cols-12 gap-3 plans-holder">

            @foreach ($servers as $key => $item)
            <div class="col-span-12 md:col-span-6 mt-4">

                <div
                    class="bg-white dark:bg-gray-700 dark:text-white rounded-xl p-5 flex flex-col items-center text-center cursor-pointer relative">

                    <p class="text-lg lg:text-xl font-yekan-black">{{ $item->fa_title }}</p>
                    <p class="text-lg text-gray-500 mt-2 mb-3">موقیعت: ایران</p>

                    <p class="my-3 text-lg font-bold">{{ $item->sum }}</p>

                    <div class="flex items-center flex-col lg:flex-row gap-3 lg:gap-10">

                        <div>
                            <p>منابع برنامه</p>
                            <ul class="text-sm text-gray-500 dark:text-white flex flex-col gap-3 my-5">
                                @foreach (explode(',' , $item->server) as $server)
                                <li>{{ $server }}</li>
                                @endforeach
                            </ul>
                        </div>

                        <div>
                            <p>منابع دیتابیس</p>
                            <ul class="text-sm text-gray-500 dark:text-white flex flex-col gap-3 my-5">
                                @foreach (explode(',' , $item->database) as $server)
                                <li>{{ $server }}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>

                    <div class="flex flex-col gap-2">
                        @switch($per_select)
                        @case(3)
                        <span>مبلغ ۳ ماهه</span>
                        @break
                        @case(12)
                        <span>مبلغ سالانه</span>
                        @break

                        @default
                        <span>مبلغ ماهانه</span>

                        @endswitch

                        <span class="text-xl lg:text-2xl font-yekan-black text-primary-400">{{
                            number_format(($item->price * (int)$per_select) - $wallet) }} <span
                                class="text-sm font-bold text-gray-500">تومان</span></span>
                    </div>

                    <x-site.info-modal :name="4">
                        <x-slot name="button">
                            <div class="btn btn-blue mt-3 w-full">
                                ارتقا
                            </div>
                        </x-slot>

                        <x-slot name="title">ارتقا به سرور {{ $item->fa_title }}</x-slot>

                        <p class="text-sm text-gray-500 mb-5 dark:text-white">دوره پرداخت:
                            @switch($per_select)
                            @case(3)
                            <span>۳ ماهه</span>
                            @break
                            @case(12)
                            <span>سالانه</span>
                            @break

                            @default
                            <span>ماهانه</span>

                            @endswitch

                            <span class="font-bold text-lg"></span>
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500 dark:text-white">مبلغ: <span
                                    class="text-dark font-bold text-xl">
                                    {{ number_format(($item->price * (int)$per_select) - $wallet) }}

                                </span> تومان</span>

                            <div>
                                <span  wire:loading.remove wire:target="Upgrade" wire:click="Upgrade({{ $item->id }})"
                                    class="btn btn-green cursor-pointer">پرداخت</span>
                                <span wire:loading wire:target="Upgrade" class="منتظر باشید..."></span>
                            </div>
                        </div>

                    </x-site.info-modal>

                    @if ($item->isSpecial)
                    <span
                        class="text-sm text-white bg-blue-400 rounded-md py-2 px-3 absolute top-2 right-2">پیشنهادی</span>
                    @endif


                </div>

            </div>
            @endforeach

        </div>


        @else
        <p class="mt-5 text-blue-500">آخرین پلن سرور برای این برنامه فعال است</p>
        @endif



    </div>


</div>