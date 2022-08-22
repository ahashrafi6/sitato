<x-slot name="style">

</x-slot>
<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-5 mt-8 lg:mt-20">
        <div class="col-span-12 lg:col-span-4 bg-white rounded-lg p-8 dark:bg-gray-700 relative">

            <p class="dark:text-white mb-10">درخواست واریز</p>


            <div x-data="{depositTab: @entangle('deposit').defer, cateTab: @entangle('cate')}">

                @if($isCate)
                    <div class="bg-gray-100 rounded-md p-2 flex items-center justify-around my-5">
                        <button @click="cateTab = 'income'"
                                class="rounded text-sm focus:outline-none transition duration-500 py-1.5 px-5 text-gray-700"
                                :class="{'text-gray-900 bg-white shadow': cateTab === 'income'}">درآمد
                        </button>
                        <button @click="cateTab = 'affiliate'"
                                class="rounded text-sm focus:outline-none transition duration-500 py-1.5 px-5 text-gray-700"
                                :class="{'text-gray-900 bg-white shadow': cateTab === 'affiliate'}">همکاری در فروش
                        </button>
                    </div>
                @endif

                <div class="flex items-center gap-3">
                    <img width="58px" src="{{ asset('assets/site/images/withdraw-wallet-icon.png') }}">
                    <div>
                        <p class="text-sm text-gray-500 mb-2">موجودی فعلی</p>
                        <div>
                            @if($cate == 'income')
                                <span class="text-xl dark:text-white">{{ number_format($income) }}</span>
                            @else
                                <span class="text-xl dark:text-white">{{ number_format($affiliate) }}</span>
                            @endif
                            <span class="text-sm text-gray-500">تومان</span>
                        </div>
                    </div>
                </div>


                <div class="bg-gray-100 rounded-md p-2 flex items-center justify-around my-5">
                    <button @click="depositTab = 'all'"
                            class="rounded text-sm focus:outline-none transition duration-500 py-1.5 px-5 text-gray-700"
                            :class="{'text-gray-900 bg-white shadow': depositTab === 'all'}">کل موجودی
                    </button>
                    <button @click="depositTab = 'desired'"
                            class="rounded text-sm focus:outline-none transition duration-500 py-1.5 px-5 text-gray-700"
                            :class="{'text-gray-900 bg-white shadow': depositTab === 'desired'}">مبلغ دلخواه
                    </button>
                </div>

                <form wire:submit.prevent="send">
                    @csrf

                    <div x-show="cateTab === 'income'">
                        <div x-show="depositTab === 'all'" class="flex items-center relative">
                    <span class="bg-gray-200 p-4 rounded-r flex items-center justify-center">
                        <i class="fal fa-coins text-lg text-gray-600"></i>
                    </span>
                            <input value="{{ number_format($income) }}" type="text" disabled
                                   class="bg-gray-100 border-0 focus:border-0 focus:ring-0 py-3 rounded-l w-full">
                            <span class="text-sm text-gray-500 absolute left-3 top-3">تومان</span>
                        </div>
                        <div x-show="depositTab === 'desired'" class="flex items-center relative">
                    <span class="bg-gray-200 p-4 rounded-r flex items-center justify-center">
                        <i class="fal fa-coins text-lg text-gray-600"></i>
                    </span>
                            <input wire:model.defer="income_desired" type="text"
                                   class="bg-gray-100 border-0 focus:border-0 focus:ring-0 py-3 rounded-l w-full">
                            <span class="text-sm text-gray-500 absolute left-3 top-3">تومان</span>
                        </div>
                    </div>
                    <div x-show="cateTab === 'affiliate'">
                        <div x-show="depositTab === 'all'" class="flex items-center relative">
                    <span class="bg-gray-200 p-4 rounded-r flex items-center justify-center">
                        <i class="fal fa-coins text-lg text-gray-600"></i>
                    </span>
                            <input value="{{ number_format($affiliate) }}" type="text" disabled
                                   class="bg-gray-100 border-0 focus:border-0 focus:ring-0 py-3 rounded-l w-full">
                            <span class="text-sm text-gray-500 absolute left-3 top-3">تومان</span>
                        </div>
                        <div x-show="depositTab === 'desired'" class="flex items-center relative">
                    <span class="bg-gray-200 p-4 rounded-r flex items-center justify-center">
                        <i class="fal fa-coins text-lg text-gray-600"></i>
                    </span>
                            <input wire:model.defer="affiliate_desired" type="text"
                                   class="bg-gray-100 border-0 focus:border-0 focus:ring-0 py-3 rounded-l w-full">
                            <span class="text-sm text-gray-500 absolute left-3 top-3">تومان</span>
                        </div>
                    </div>


                    @if($cards)
                        <div class="mt-5 {{ count($cards) > 1 ? 'h-60 overflow-y-scroll' : '' }} radio-plan withdraw">
                            @foreach($cards as $item)
                                <label id="card-{{ $item->id }}"
                                       class="bg-gray-100 rounded border block mb-2 cursor-pointer">
                                    <input wire:model.defer="card"
                                           {{ $card == $item->id ? 'checked' : '' }} value="{{ $item->id }}"
                                           type="radio"
                                           name="card" id="card-{{ $item->id }}" class="custom-radio">
                                    <div class="bg-white flex items-center justify-between p-3 pr-8 text-gray-500">
                                        <span class="text-sm">{{ $item->title }}</span>
                                        <span class="text-xs">{{ $item->card_name }}</span>
                                    </div>
                                    <ul class="text-xs p-5">
                                        <li class="flex items-center justify-between mb-4">
                                            <span>نام بانک</span>
                                            <span
                                                class="text-gray-600">{{ get_bank_list()[$item->bank_name] }}</span>
                                        </li>
                                        <li class="flex items-center justify-between mb-4">
                                            <span>شماره کارت</span>
                                            <span class="text-gray-600">{{ $item->card_number }}</span>
                                        </li>
                                        <li class="flex items-center justify-between">
                                            <span>شماره شبا</span>
                                            <span class="text-gray-600">IR{{ $item->card_sheba }}</span>
                                        </li>
                                    </ul>
                                </label>
                            @endforeach
                        </div>
                    @else
                        <p class="text-xs text-red-400">هیچ شماره حسابی یافت نشد!</p>
                    @endif
                    <p class="text-xs leading-loose text-gray-500 mt-5 text-justify pb-4 border-b">تمام واریزها با حواله
                        پایا انجام می شود، زمان واریز میتواند تا 72 ساعت کاری طول بکشد.
                        توجه داشته باشید که حواله پایا در روزهای تعطیل توسط بانک مرکزی تایید و به حساب شما واریز نخواهد
                        شد.</p>

                    <ul class="text-xs text-gray-500 mt-3">
                        <li class="mb-2">حداقل مبلغ قابل برداشت: 100,000 تومان</li>
                    </ul>

                    <input type="hidden" wire:model="cate">
                    <input type="hidden" wire:model="deposit">


                    @if($cards)
                        @if($cate == 'income' ? ($income > 100000) : ($affiliate > 100000))
                            <p wire:loading wire:target="send" class="text-xs text-green-400 text-center mt-5 mb-1">
                                منتظر
                                باشید...</p>
                            <button wire:loading.remove wire:target="send" type="submit"
                                    class="btn btn-green text-center w-full mt-5 mb-1">ثبت درخواست
                            </button>
                        @else
                            <div class="btn btn-gray text-center w-full mt-5 mb-1">موجودی فعلی کافی نیست
                            </div>
                        @endif
                    @else
                        <a href="{{ route('profile.cards') }}" class="btn btn-red text-center mt-5 mb-1 block">ابتدا یک
                            شماره حساب ایجاد کنید
                        </a>
                    @endif

                    <x-auth.auth-validation-error name="income_desired"/>
                    <x-auth.auth-validation-error name="affiliate_desired"/>
                </form>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-8 bg-white rounded-lg p-8 dark:bg-gray-700">
            <div class="flex items-center justify-between">
                <span class="dark:text-white">لیست درخواست ها</span>

                <div class="flex items-center gap-1">
                    <input wire:model="all" type="checkbox" id="show-all"
                           class="cursor-pointer rounded border-gray-300 text-primary-400 shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50">
                    <label for="show-all" class="text-gray-600 mr-1 dark:text-gray-200 text-sm">مشاهد همه</label>
                </div>
            </div>

            @if(count($lists) > 0)

                <p class="dark:text-white" wire:loading>صبور باشید...</p>

                <div wire:loading.remove>
                    @foreach($lists as $item)
                        <div class="rounded-lg p-3 bg-gray-100 mt-5">
                            <div class="flex items-center justify-between">
                                <span>{{ number_format($item->amount) }}</span>
                                <span>نوع: {{ \App\Models\Withdraw::CATE[$item->cate] }}</span>
                                <span>{{ \App\Models\Withdraw::TYPE[$item->type] }}</span>
                                @if($item['status'] == 'completed')
                                    <span class="bg-green-50 text-green-400 text-xs p-2 rounded-md">انجام شده</span>
                                @elseif($item['status'] == 'pending')
                                    <span class="bg-orange-50 text-orange-400 text-xs p-2 rounded-md">در انتظار</span>
                                @else
                                    <span class="bg-red-50 text-red-400 text-xs p-2 rounded-md">رد شده</span>
                                @endif
                                <span class="text-xs">{{ f_date($item->created_at) }}</span>
                                @if($item->payment_at)
                                    <span class="text-xs">{{ f_date($item->payment_at) }}</span>
                                @endif
                            </div>
                        </div>

                    @endforeach
                </div>

                <div class="">
                    {{ $lists->links() }}
                </div>
            @else
                <div class="flex flex-col justify-center items-center my-10">
                    <img class="w-16" src="{{ asset('assets/site/images/empty-cart-icon.png') }}">
                    <p class="text-sm text-gray-400 text-center mt-5 dark:text-white">هیچ درخواستی تا این لحظه یافت
                        نشد!</p>
                </div>
            @endif
        </div>
    </div>
</div>
<x-slot name="script">

</x-slot>
