<x-slot name="style">

</x-slot>
<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
        <div class="col-span-12 lg:col-span-10 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">برنامه {{ $project->username }}</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">مشاهده و تنظیمات برنامه</p>
        </div>

    </div>

    <div>
        <div x-data="{ tab: @entangle('type') }">

            <div class="flex items-center gap-3 mb-8">
                <button class="bg-gray-200 rounded-md py-2 w-1/4  focus:ring-0 focus:outline-none"
                    :class="{ 'bg-primary-400 text-white': tab === 'info' }" @click="tab = 'info'">
                    <i class="fal fa-info text-lg"></i>
                    <span>اطلاعات برنامه</span>
                </button>
                <button class="bg-gray-200 rounded-md py-2 w-1/4 focus:ring-0 focus:outline-none"
                    :class="{ 'bg-primary-400 text-white': tab === 'plan' }" @click="tab = 'plan'">
                    <i class="fal fa-list text-lg"></i>
                    <span>پلن برنامه</span>
                </button>
                <button class="bg-gray-200 rounded-md py-2 w-1/4 focus:ring-0 focus:outline-none"
                    :class="{ 'bg-primary-400 text-white': tab === 'server' }" @click="tab = 'server'">
                    <i class="fal fa-server text-lg"></i>
                    <span>سرور برنامه</span>
                </button>
                <button class="bg-gray-200 rounded-md py-2 w-1/4 focus:ring-0 focus:outline-none"
                    :class="{ 'bg-primary-400 text-white': tab === 'env' }" @click="tab = 'env'">
                    <i class="fal fa-check text-lg"></i>
                    <span>متغییر‌ها</span>
                </button>
                <button class="bg-gray-200 rounded-md py-2 w-1/4 focus:ring-0 focus:outline-none"
                    :class="{ 'bg-primary-400 text-white': tab === 'database' }" @click="tab = 'database'">
                    <i class="fal fa-database text-lg"></i>
                    <span>دیتابیس</span>
                </button>
                <button class="bg-gray-200 rounded-md py-2 w-1/4 focus:ring-0 focus:outline-none"
                    :class="{ 'bg-primary-400 text-white': tab === 'disk' }" @click="tab = 'disk'">
                    <i class="fal fa-hdd text-lg"></i>
                    <span>دیسک ها</span>
                </button>
                <button class="bg-gray-200 rounded-md py-2 w-1/4 focus:ring-0 focus:outline-none"
                    :class="{ 'bg-primary-400 text-white': tab === 'domain' }" @click="tab = 'domain'">
                    <i class="fal fa-bell text-lg"></i>
                    <span>دامنه ها</span>
                </button>
            </div>

            <div class="pt-8" x-show.transition="tab === 'info'">

                <div class="grid grid-cols-12 gap-5">
                    <div class="col-span-12 lg:col-span-4">
                        <div class="flex flex-col justify-center">
                            <img src="" alt="">
                            <div class="bg-white dark:bg-gray-700 rounded-lg p-5">

                                @if ($project->status == 'active' || $project->status == 'disable')
                                <div class="flex items-center justify-center gap-5">
                                    <span class="text-xl cursor-pointer relative badge-item">
                                        <i wire:click="scale" class="fal fa-power-off dark:text-white"></i>
                                        @if ($project->status == 'active' )
                                        <span 
                                            class="tooltip absolute -top-8 right-0 bg-primary-400 text-white text-sm rounded-full w-max py-1 px-3 transition duration-500">خاموش
                                            کردن</span>
                                        @endif
                                        @if ($project->status == 'disable' )
                                        <span 
                                            class="tooltip absolute -top-8 right-0 bg-primary-400 text-white text-sm rounded-full w-max py-1 px-3 transition duration-500">روشن
                                            کردن</span>
                                        @endif
                                    </span>
                                    @if ($project->status == 'active')
                                    <span class="text-xl cursor-pointer relative badge-item">
                                        <i wire:click="restart" class="fal fa-sync dark:text-white"></i>
                                        <span
                                            class="tooltip absolute -top-8 right-0 bg-primary-400 text-white text-sm rounded-full w-max py-1 px-3 transition duration-500">ری‌استارت</span>
                                    </span>
                                    @endif
                                 
                                </div>
                                @endif

                                @if ($project->status == 'freeze')
                                    <p class="text-xs text-gray-500 leading-relaxed">برنامه به علت عدم پرداخت صورتحساب تمدید مسدود (منجمد) شده است، جهت جلوگیری از حذف برنامه هرچه سریع تر اقدام به پرداخت صورتحساب تمدید نمایید</p>
                                @endif

                                <div class="flex items-center justify-between mt-8">
                                    <span class="text-gray-500 text-sm">وضعیت</span>
                                    @switch($project->status)
                                    @case('active')
                                    <span class="bg-primary-400 text-white py-1.5 px-2 rounded-md">روشن</span>
                                    @break
                                    @case('disable')
                                    <span class="bg-red-400 text-white py-1.5 px-2 rounded-md">خاموش</span>
                                    @break
                                    @case('freeze')
                                    <span class="bg-red-400 text-white py-1.5 px-2 rounded-md">منجمد شده</span>
                                    @break
                                    @case('lock')
                                    <span class="bg-red-400 text-white py-1.5 px-2 rounded-md">قفل شده</span>
                                    @break

                                    @endswitch

                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 lg:col-span-4">
                        <div class="bg-white dark:bg-gray-700 rounded-lg py-5">
                            <ul class="text-sm">
                                <li class="flex items-center justify-between py-3 px-5 border-b dark:border-gray-600">
                                    <span class="text-gray-500">آدرس</span>
                                    <a href="{{ $project->url() }}" target="_blank" class="text-blue-500">{{
                                        $project->url() }}</a>
                                </li>
                                <li class="flex items-center justify-between py-3 px-5 border-b dark:border-gray-600">
                                    <span class="text-gray-500">برنامه</span>
                                    <span class="dark:text-white">{{ $project->product->fa_title }} - پلن: {{
                                        $project->plan->fa_title }}</span>
                                </li>
                                <li class="flex items-center justify-between py-3 px-5 border-b dark:border-gray-600">
                                    <span class="text-gray-500">شناسه برنامه (غیر قابل تغییر)</span>
                                    <span class="dark:text-white">{{ $project->username }}</span>
                                </li>
                                <li class="flex items-center justify-between py-3 px-5 border-b dark:border-gray-600">
                                    <span class="text-gray-500">پلن سرور</span>
                                    <span class="dark:text-white">{{ $project->server->fa_title }}</span>
                                </li>
                                <li class="flex items-center justify-between py-3 px-5 border-b dark:border-gray-600">
                                    <span class="text-gray-500">منابع</span>
                                    <span class="dark:text-white">{{ $project->server->sum }}</span>
                                </li>
                                <li class="flex items-center justify-between py-3 px-5 border-b dark:border-gray-600">
                                    <span class="text-gray-500">ترافیک</span>
                                    <span class="dark:text-white">نامحدود</span>
                                </li>
                                <li class="flex items-center justify-between py-3 px-5">
                                    <span class="text-gray-500">تاریخ ایجاد</span>
                                    <span class="dark:text-white">{{ p_date($project->created_at) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-8" x-show.transition="tab === 'plan'">
                <livewire:site.profile.project.plan :project="$project" />
            </div>

            <div class="pt-8" x-show.transition="tab === 'server'">
                <livewire:site.profile.project.server :project="$project" />
            </div>

            <div class="pt-8" x-show.transition="tab === 'env'">
                <livewire:site.profile.project.env :project="$project" />
            </div>
            <div class="pt-8" x-show.transition="tab === 'database'">
                <livewire:site.profile.project.database :project="$project" />
            </div>
            <div class="pt-8" x-show.transition="tab === 'disk'">
                <livewire:site.profile.project.disk :project="$project" />
            </div>
            <div class="pt-8" x-show.transition="tab === 'domain'">
                <livewire:site.profile.project.domain :project="$project" />
            </div>
        </div>
    </div>

</div>
<x-slot name="script">

</x-slot>

@if(request()->has('success-plan'))
<span id="success-plan"></span>
@endif

@if(request()->has('success-server'))
<span id="success-server"></span>
@endif