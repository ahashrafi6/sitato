<div x-data="{ renewModal: @entangle('renewModal').defer }">

    <a @click="renewModal = true" href="#" class="btn btn-blue text-sm">راه اندازی مجدد</a>

    <div x-show="renewModal" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="fixed top-0 bottom-0 right-0 w-full h-full bg-black bg-opacity-60 z-80">



        <div
            class="bg-white dark:bg-gray-700 rounded-lg overflow-hidden shadow-xl transform transition-all w-11/12 lg:w-9/12 mx-auto mt-8 xl:mt-16 py-8 px-6 dir-rtl relative">
            <div class="flex items-center justify-between mb-5">
                <span class="text-lg font-bold dark:text-white">راه اندازی مجدد {{ $project->username }}</span>
                <i @click="renewModal = false"
                    class="fal fa-times text-gray text-xl cursor-pointer dark:text-white"></i>
            </div>


            <ul class="text-sm text-gray-500 dark:text-white flex flex-col gap-3 my-5">

                <li>- دوره تمدید و پلن مورد نظر خود را انتخاب نمایید تا به درگاه پرداخت منتقل شوید</li>

            </ul>

            <p class="font-bold dark:text-white mb-2">دوره تمدید</p>
        <div class="grid grid-cols-12 gap-3 plans-holder">
            <div class="col-span-12 lg:col-span-4">
                <select wire:model="per_select" class="rounded-md">
                    @foreach ($per as $key => $item)
                    <option value="{{ $key }}">{{ $item }}</option>
                    @endforeach
                </select>
            </div>

        </div>

            <div class="grid grid-cols-12 gap-3 plans-holder h-96 overflow-y-scroll">

                @foreach ($servers as $key => $item)
                <div class="col-span-12 md:col-span-4 mt-4">
    
                    <div
                        class="bg-gray-100 dark:bg-gray-700 dark:text-white rounded-xl p-5 flex flex-col items-center text-center cursor-pointer relative">
    
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
                                number_format(($item->price * (int)$per_select)) }} <span
                                    class="text-sm font-bold text-gray-500">تومان</span></span>
                        </div>
    
                        <x-site.info-modal :name="4">
                            <x-slot name="button">
                                <div class="btn btn-blue mt-3 w-full">
                                    انتخاب
                                </div>
                            </x-slot>
    
                            <x-slot name="title">پلن {{ $item->fa_title }}</x-slot>
    
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
                                        {{ number_format(($item->price * (int)$per_select)) }}
    
                                    </span> تومان</span>
    
                                <div>
                                    <span  wire:loading.remove wire:target="Renew" wire:click="Renew({{ $item->id }})"
                                        class="btn btn-green cursor-pointer">پرداخت</span>
                                    <span wire:loading wire:target="Renew" class="text-gray-500 text-sm">منتظر باشید...</span>
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

        </div>


    </div>
</div>