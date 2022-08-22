<x-slot name="style">

</x-slot>

<div class="dir-rtl">
    <div class="flex justify-end mt-5">
        <a href="{{ route('order') }}" class="btn btn-primary">برنامه جدید</a>
    </div>

    <div class="grid grid-cols-12 mt-5 mb-8">
        <div class="col-span-12 lg:col-span-10 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">برنامه ها</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">برنامه های خریداری شده شما</p>
        </div>
        @if($projects)
        <div class="col-span-12 lg:col-span-2">
            <select wire:model="count"
                class="w-full rounded-md bg-white dark:bg-gray-600 dark:text-white transition duration-500 p-4 pr-10 border-0 focus:ring-primary-400 focus:shadow-xl focus:outline-none">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
            </select>
        </div>

        @endif

    </div>


    <p class="dark:text-white" wire:loading>صبور باشید...</p>

    @if(count($projects) > 0)
    <div wire:loading.remove>
        @foreach($projects as $key => $item)

        <div class="rounded-lg hover:shadow-xl duration-200 relative mb-5">
            <div class="absolute left-3 top-3 flex items-center gap-3">
                @if($item->support_at > now())
                <span class="text-sm text-white bg-green-400 rounded-lg p-2">پشتیبانی تا: {{ d_date($item->support_at)
                    }}</span>
                @else
                <span class="text-sm text-white bg-red-400 rounded-lg p-2">اتمام پشتیبانی</span>
                @endif
            </div>



            <div class="p-5 bg-white dark:bg-gray-700 rounded-lg transition duration-500 relative">

                @if ($item->status == 'install')
                <div class="flex items-center absolute bottom-2 left-4 badge-item gap-1">
                    <img width="30px" src="{{ asset('assets/site/images/loading-icon.gif') }}" alt="loading">
                    <span class="text-xs text-gray-500 dark:text-white">در حال راه اندازی</span>
                    <span class="tooltip absolute -top-8 left-0 bg-primary-400 text-white text-sm rounded-full w-max py-1 px-3 transition duration-500">حدودا ۱۰ دقیقه زمانبر است</span>
                </div>
                @endif
        

                <div class="flex flex-col lg:flex-row">
                    <img width="85px" height="85px" src="{{ img_url($item->product->icon) }}">
                    <div class="m-0 lg:mr-5">
                        @if ($item->status != 'install' && $item->status != 'delete' && !is_null($item->username))
                        <a class="dark:text-white text-lg"
                        href="{{  route('project' , ['project' => $item->username]) }}">{{
                        $item->product->fa_title }}</a>
                        @else
                            <span class="dark:text-white text-lg">{{ $item->product->fa_title }}</span>
                            @if ($item->status == 'delete')
                            <span class="bg-red-400 py-1 px-2 text-xs text-white rounded-sm">حذف شده</span>
                            @endif
                     
                        @endif
                        
                        <div class="mt-5 flex flex-wrap gap-3 items-center">

                            @if(!is_null($item->username))

                            <span class="dark:text-gray-400 text-sm">شناسه برنامه: {{ $item->username }}</span>
                            <span class="dark:text-gray-400 text-sm">پلن برنامه: {{ $item->plan->fa_title }}</span>
                            <span class="dark:text-gray-400 text-sm">سرور برنامه: {{ $item->server->fa_title }}</span>

                            @endif

                            <x-site.info-modal :name="4">
                                <x-slot name="button">
                                    @if(is_null($item->username))
                                   <div class="flex flex-col gap-4">
                                    <div>
                                        <a href="#" class="btn btn-primary">افزودن شناسه</a>
                                    </div>
                                    <span class="text-gray-500 text-xs">ابتدا برای این برنامه یک شناسه اضافه نمایید تا فرآیند نصب و راه اندازی آن خودکار انجام شود</span>
                                   </div>
                                    @endif
                                </x-slot>

                                @if(is_null($item->username))
                                <x-slot name="title">افزودن شناسه</x-slot>
                                @endif

                                @if(is_null($item->username))
                                <p class="text-sm text-gray-500 mb-3">جهت فعالسازی برنامه باید یک شناسه برای آن در نظر
                                    بگیرید</p>
                                @endif


                                <ul>
                                    <li class="dark:text-gray-300 text-sm mb-3">
                                        توجه: شناسه باید به لاتین (انگلیسی) و منحصر به فرد باشد
                                    </li>
                                    <li class="dark:text-gray-300 text-sm mb-3">

                                        هر برنامه باید شناسه‌ای یکتا داشته باشد. شناسه‌ی برنامه، همان Subdomain
                                        برنامه‌ی‌تان خواهد بود که از طریق آن
                                        می‌توانید به برنامه دسترسی داشته باشید. برای مثال، اگر شناسه را my-website وارد
                                        کنید، از طریق
                                        my-website.iran.sitato.ir به آن دسترسی خواهید داشت. بعد از ایجاد برنامه
                                        می‌توانید دامنه‌ی دلخواه‌تان را نیز به آن اضافه کنید

                                    </li>
                                </ul>
                                <form method="POST" wire:submit.prevent="Username('add', {{ $item->id }})">
                                    @csrf

                                    <div class="grid grid-cols-12 gap-3 plans-holder mt-5 w-full">
                                        <div class="col-span-12">
                                            <div class="flex items-center">
                                                <div class="bg-gray-200 p-3 text-sm dir-ltr rounded-r-md">
                                                    .iran.sitato.ir</div>
                                                <x-auth.input wire:model.defer="username" class="block w-full dir-ltr"
                                                    type="text" required placeholder="شناسه" />
                                                <div class="bg-gray-200 p-3 text-sm dir-ltr rounded-l-md">https://</div>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="flex justify-between mt-2 items-center">
                                        <span>
                                            <x-auth.auth-validation-error name="username" />
                                        </span>
                                        @if ($username_exist)
                                        <span class="text-sm text-red-400">
                                            شناسه تکراری است! شناسه دیگری انتخاب نمایید
                                        </span>
                                        @endif
                                       

                                        <div>
                                            <span wire:loading wire:target="Username"
                                                class="text-gray-500 text-xs">منتظر باشید...</span>
                                            <button wire:loading.remove wire:target="Username" type="submit"
                                                class="btn btn-green cursor-pointer">ثبت
                                            </button>
                                        </div>
                                    </div>
                                </form>



                            </x-site.info-modal>

                            @if(!is_null($item->username))
                            @if($item->support_at < now()) <x-site.info-modal :name="4">
                                <x-slot name="button">
                                    <a href="#" class="btn btn-gray">تمدید پشتیبانی</a>
                                </x-slot>

                                <x-slot name="title">تمدید پشتیبانی</x-slot>

                                <p class="text-sm text-gray-500 mb-3">محصول: <span class="font-bold">{{
                                        $item->product->fa_title }}</span></p>
                                <p class="text-sm text-gray-500 mb-5 dark:text-white">مدت زمان اعتبار:
                                    <span class="font-bold text-lg">{{ $item->plan->support }} ماه</span>
                                </p>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500 dark:text-white">مبلغ: <span
                                            class="text-dark font-bold text-lg">{{ number_format($item->plan->price * 15
                                            /
                                            100) }}</span> هزار تومان</span>


                                    <div>
                                        <span wire:loading.remove wire:target="support"
                                            wire:click="support({{ $item->id }})"
                                            class="btn btn-green cursor-pointer">پرداخت</span>
                                        <span wire:loading wire:target="support" class="منتظر باشید..."></span>
                                    </div>
                                </div>

                                </x-site.info-modal>


                                @endif

                                @endif

                        </div>

                        @if ($item->status == 'delete')
                        <div class="mt-5">
                            <livewire:site.profile.project.renew :project="$item" wire:key="project_{{ $item->id }}" />
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="flex flex-col justify-center items-center my-10">
        <img class="w-16" src="{{ asset('assets/site/images/empty-cart-icon.png') }}">
        <p class="text-sm text-gray-400 text-center mt-5 dark:text-white">هیچ برنامه‌ای تا این لحظه خریداری نکردید!</p>
    </div>
    @endif
</div>

<x-slot name="script">

</x-slot>

@if(request()->has('success-payment'))
<span id="success-payment"></span>
@endif

@if(request()->has('success-support'))
<span id="success-support"></span>
@endif

@if(request()->has('success-renew'))
<span id="success-renew"></span>
@endif

