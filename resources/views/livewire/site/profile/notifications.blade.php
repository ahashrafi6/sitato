<x-slot name="style">

</x-slot>
<div class="dir-rtl">
    <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
        <div class="col-span-7 lg:col-span-3 mb-3 lg:mb-0">
            <h4 class="text-2xl font-bold mb-2 dark:text-white">اعلانات</h4>
            <p class="text-sm text-gray-500 dark:text-gray-400">لیست اعلانات مرتبط به شما</p>
        </div>
        <div class="col-span-5 lg:col-span-9 mb-3 lg:mb-0 text-left">
            <a href="{{ route('edit' , ['type' => 'notification']) }}" class="btn btn-primary">
                <i class="fal fa-bell"></i>
                تنظیمات اعلانات
            </a>
        </div>
    </div>

    <div x-data="{notifyTab: 'unread'}">
        <div class="flex items-center gap-3 mb-5">
                    <span @click="notifyTab = 'unread'" class="bg-white rounded py-2 px-4 cursor-pointer"
                          :class="{'bg-primary-400 text-white': notifyTab === 'unread'}">
                        <i class="fal fa-comment-alt"></i>
                        اعلانات خوانده نشده
                    </span>
            <span @click="notifyTab = 'read'" class="bg-white rounded py-2 px-4 cursor-pointer"
                  :class="{'bg-primary-400 text-white': notifyTab === 'read'}">
                 <i class="fal fa-comment-alt-dots"></i>
                        اعلانات خوانده شده
            </span>
        </div>

        <div x-show="notifyTab === 'unread'">
            <livewire:site.profile.notifications-unread/>
        </div>
        <div x-show="notifyTab === 'read'">
            <livewire:site.profile.notifications-read/>
        </div>
    </div>

</div>
<x-slot name="script">

</x-slot>

