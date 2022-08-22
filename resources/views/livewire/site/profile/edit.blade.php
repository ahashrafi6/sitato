<x-slot name="style">

</x-slot>
<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
        <div class="col-span-12 lg:col-span-10 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">ویرایش پروفایل</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">مشاهده و تغییر اطلاعات کاربری</p>
        </div>

    </div>

    <div>
        <div x-data="{ tab: @entangle('type') }">

            <div class="flex items-center gap-5 mb-8">
                <button class="bg-gray-200 rounded-md py-2 w-1/4  focus:ring-0 focus:outline-none"
                        :class="{ 'bg-primary-400 text-white': tab === 'account' }" @click="tab = 'account'">
                    <i class="fal fa-user-edit text-lg"></i>
                    <span>اطلاعات حساب</span>
                </button>
                <button class="bg-gray-200 rounded-md py-2 w-1/4 focus:ring-0 focus:outline-none"
                        :class="{ 'bg-primary-400 text-white': tab === 'phone' }" @click="tab = 'phone'">
                    <i class="fal fa-phone text-lg"></i>
                    <span>مدیریت شماره موبایل</span>
                </button>
                <button class="bg-gray-200 rounded-md py-2 w-1/4 focus:ring-0 focus:outline-none"
                        :class="{ 'bg-primary-400 text-white': tab === 'password' }" @click="tab = 'password'">
                    <i class="fal fa-lock text-lg"></i>
                    <span>تغییر رمز عبور</span>
                </button>
                <button class="bg-gray-200 rounded-md py-2 w-1/4 focus:ring-0 focus:outline-none"
                        :class="{ 'bg-primary-400 text-white': tab === 'session' }" @click="tab = 'session'">
                    <i class="fal fa-sign-in text-lg"></i>
                    <span>مدیریت ورود به سایت</span>
                </button>
                <button class="bg-gray-200 rounded-md py-2 w-1/4 focus:ring-0 focus:outline-none"
                        :class="{ 'bg-primary-400 text-white': tab === 'notification' }" @click="tab = 'notification'">
                    <i class="fal fa-bell text-lg"></i>
                    <span>مدیریت اطلاع رسانی</span>
                </button>
            </div>

            <div class="pt-8" x-show.transition="tab === 'account'">
                <div class="flex flex-col gap-3 justify-center items-center mb-10">
                   <img class="rounded-full border-2" src="{{ img_url($avatar) }}">
                   <label for="uploadAvatar" class="btn btn-gray text-xs cursor-pointer">تغییر آواتار</label>

                   <form class="hidden" action="{{ route('avatar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" class="d-none" id="uploadAvatar" name="avatar">
                </form>
                </div>
                <form method="POST" wire:submit.prevent="update">
                    @csrf

                    <div class="grid grid-cols-12 gap-5">
                        <div class="col-span-12 lg:col-span-6">
                            <div class="flex items-center justify-between">
                                <x-auth.label for="username" value="نام کاربری"/>
                                <span class="text-gray-500 text-xs">قابل تغییر نیست</span>
                            </div>

                            @if(is_null($username))
                                <x-auth.input wire:model.defer="username" id="username" class="block mt-1 w-full"
                                              type="text"
                                              required/>
                            @else
                                <x-auth.input disabled id="username" class="block mt-1 w-full bg-gray-200"
                                              type="text"
                                              :value="$username"
                                              required/>
                            @endif
                            <x-auth.auth-validation-error name="username"/>
                        </div>
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
                                    <button @click="tab = 'phone'" class="btn btn-yellow text-xs absolute left-1.5 top-1.5">ثبت و تایید
                                        موبایل</button>
                                @endif
                            </div>
                        </div>
                        <div class="col-span-12 lg:col-span-6">

                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <div class="flex items-center justify-between">
                                <x-auth.label for="username" value="نام"/>
                                <span class="text-gray-500 text-xs">ترجیحا فارسی</span>
                            </div>

                            <x-auth.input wire:model.defer="name" id="name" class="block mt-1 w-full" type="text"/>
                            <x-auth.auth-validation-error name="name"/>
                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <div class="flex items-center justify-between">
                                <x-auth.label for="username" value="نام خانوادگی"/>
                                <span class="text-gray-500 text-xs">ترجیحا فارسی</span>
                            </div>

                            <x-auth.input wire:model.defer="family" id="family" class="block mt-1 w-full" type="text"/>
                            <x-auth.auth-validation-error name="family"/>
                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <x-auth.label for="full-name" value="نام کامل"/>

                            <x-auth.input id="full-name" disabled class="block mt-1 w-full bg-gray-200" type="text"
                                          :value="$name . ' ' . $family"/>
                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <x-auth.label for="display_name_type" value="نام نمایشی"/>

                            <select wire:model.defer="display_name_type"
                                    class="w-full mt-1 rounded-md bg-white transition p-2.5 pr-10 border-gray-300 focus:border-primary-100 focus:shadow-xl focus:outline-none"
                                    id="display_name_type">
                                <option value="full">نام کامل</option>
                                <option value="username">نام کاربری</option>
                            </select>
                            <x-auth.auth-validation-error name="display_name_type"/>
                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <x-auth.label for="gender" value="جنسیت"/>

                            <select wire:model.defer="gender"
                                    class="w-full mt-1 rounded-md bg-white transition p-2.5 pr-10 border-gray-300 focus:border-primary-100 focus:shadow-xl focus:outline-none"
                                    id="gender">
                                <option value="male">مرد</option>
                                <option value="female">زن</option>
                            </select>
                            <x-auth.auth-validation-error name="gender"/>
                        </div>
                        <div class="col-span-12 lg:col-span-6">
                            <div class="flex items-center justify-between">
                                <x-auth.label for="website" value="وبسایت"/>
                                <span class="text-gray-500 text-xs">آدرس وبسایت اصلی شما</span>
                            </div>

                            <x-auth.input wire:model.defer="website" id="website" class="block mt-1 w-full"
                                          type="text"/>
                            <x-auth.auth-validation-error name="website"/>
                        </div>
                    </div>
                    <div class="flex justify-end mt-8">
                        <button class="btn btn-primary" type="submit">ثبت تغییرات</button>
                    </div>

                </form>
            </div>

            <div class="pt-8" x-show.transition="tab === 'phone'">
                <livewire:site.profile.phone/>
            </div>

            <div class="pt-8" x-show.transition="tab === 'password'">
                <livewire:site.profile.password/>
            </div>

            <div class="pt-8" x-show.transition="tab === 'session'">
                <livewire:site.profile.session/>
            </div>
            <div class="pt-8" x-show.transition="tab === 'notification'">
                <livewire:site.profile.notification/>
            </div>
        </div>
    </div>

</div>
<x-slot name="script">

</x-slot>


