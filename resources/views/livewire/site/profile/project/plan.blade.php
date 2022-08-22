<div class="dir-rtl">

    <div class="bg-white dark:bg-gray-700 dark:text-white p-5 rounded-lg flex flex-col gap-2 mb-10">
        <p class="text-primary-400">پلن فعلی برنامه</p>
        <p class="text-lg font-yekan-black">{{ $project->plan->fa_title }}</p>
    </div>

    @if (count($plans))
        
    <div>

        <p class="mb-5">شما میتوانید برنامه خود را به پلن های زیر ارتقا دهید</p>

        <div class="my-5 bg-gray-200 text-center p-3 rounded-lg"><a href=""
                class="text-sm lg:text-md text-blue-500">مشاهده امکانات کامل پلن ها</a></div>

        <div class="grid grid-cols-12 gap-3 plans-holder">

            @foreach ($plans as $key => $plan)
            <div class="col-span-12 md:col-span-6 lg:col-span-3">

                <div
                    class="bg-white dark:bg-gray-700 dark:text-white rounded-xl p-5 flex flex-col items-center text-center cursor-pointer relative">

                    <p class="text-lg lg:text-xl font-yekan-black">پلن {{ $plan->fa_title }}</p>
                    <p class="text-lg text-gray-500 mt-2">{{ $plan->en_title }} plan</p>

                    <ul class="text-sm text-gray-500 dark:text-white flex flex-col gap-3 my-5">
                        @foreach (explode(',' , $plan->description) as $li)
                        <li>{{ $li }}</li>
                        @endforeach

                    </ul>

                    <div class="flex flex-col gap-2">
                        <span class="text-xl lg:text-2xl font-yekan-black text-primary-400">

                            @if ($plan->isOff())
                            {{ number_format($plan->offPrice - $project->plan->price) }}
                            @else
                            {{ number_format($plan->price - $project->plan->price) }}
                            @endif

                            <span class="text-sm font-bold text-gray-500">تومان</span>
                        </span>
                    </div>



                    <x-site.info-modal :name="4">
                        <x-slot name="button">
                            <div class="btn btn-blue mt-3 w-full">
                                ارتقا
                            </div>
                        </x-slot>

                        <x-slot name="title">ارتقا به پلن {{ $plan->fa_title }}</x-slot>

                        <p class="text-sm text-gray-500 mb-5 dark:text-white">دسترسی:
                            <span class="font-bold text-lg">مادام العمر</span>
                        </p>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-500 dark:text-white">مبلغ: <span
                                    class="text-dark font-bold text-xl">@if ($plan->isOff())
                                    {{ number_format($plan->offPrice - $project->plan->price) }}
                                    @else
                                    {{ number_format($plan->price - $project->plan->price) }}
                                    @endif
                                    </span> تومان</span>


                            <div>
                                <span wire:loading.remove wire:target="Upgrade" wire:click="Upgrade({{ $plan->id }})"
                                    class="btn btn-green cursor-pointer">پرداخت</span>
                                <span wire:loading wire:target="Upgrade" class="منتظر باشید..."></span>
                            </div>
                        </div>

                    </x-site.info-modal>

                </div>

            </div>
            @endforeach

        </div>


    </div>

    @else
    <p class="mt-5 text-blue-500">آخرین پلن برای این برنامه فعال است</p>
    @endif
    

</div>