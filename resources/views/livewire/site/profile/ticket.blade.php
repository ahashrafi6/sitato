<x-slot name="style">
    <link rel="stylesheet" href="{{ asset('assets/site/scss/uppy.css') }}">
</x-slot>
<div class="mt-8 lg:mt-20">
 
    <div class="grid grid-cols-12 gap-8 dir-rtl">
        <div class="col-span-12 lg:col-span-4">
            <div class="bg-white dark:bg-gray-700 rounded-xl p-5 duration-500 sticky top-5 z-80">
                
                <div class="dark:text-white mb-2">
                    <span><span class="text-sm text-gray-500 dark:text-white">شناسه تیکت:</span> {{ $ticket->tracking }}</span>
                </div>
                <div class="flex items-center gap-3">
                    @switch($ticket->status)
                        @case('waiting')
                        <span
                            class="bg-orange-50 text-orange-400 text-xs p-2 rounded-md">در انتظار پاسخ</span>
                        @break
                        @case('pending')
                        <span class="bg-blue-50 text-blue-400 text-xs p-2 rounded-md">در حال بررسی</span>
                        @break
                        @case('answer')
                        <span class="bg-green-50 text-green-400 text-xs p-2 rounded-md">پاسخ داده شده</span>
                        @break
                        @case('close')
                        <span class="bg-red-50 text-red-400 text-xs p-2 rounded-md">بسته شده</span>
                        @break
                        @case('admin')
                        <span
                            class="bg-primary-50 text-primary-400 text-xs p-2 rounded-md">از طرف مدیریت</span>
                        @break
                    @endswitch
                    @if($ticket->status == 'waiting' && $ticket->user_id == $user->id && !is_null($ticket->expire_at))
                        <div class="badge-item relative cursor-pointer">
                            <span
                                class="bg-red-50 text-red-400 text-xs p-2 rounded-md">{{ fp_date($ticket->expire_at) }}</span>
                            <span
                                class="tooltip absolute -top-8 left-0 bg-primary-400 text-white text-xs rounded-full w-max py-1 px-3 transition duration-500">حداکثر زمان پاسخ دهی</span>
                        </div>
                    @endif
                </div>
                <p class="my-5 dark:text-white">{{ $ticket->title }}</p>
                <ul class="text-gray-500 text-sm dark:text-gray-400">
                    <li class="mb-4 flex items-center">
                        <i class="fal fa-reply ml-2"></i>
                        <span>بروز شده: {{ f_date($ticket->updated_at) }}</span>
                    </li>
                    <li class="mb-4 flex items-center">
                        <i class="fal fa-clock ml-2"></i>
                        <span>تاریخ ایجاد: {{ f_date($ticket->created_at) }}</span>
                    </li>
                    @if($ticket->product)
                        <li class="mb-4 flex items-center">
                            <i class="fal fa-box ml-2"></i>
                            <a href="{{ $ticket->product->path() }}">{{ $ticket->product->fa_title }}</a>
                        </li>
                    @endif
                </ul>

                @if($ticket->status != 'close')
                    <div class="flex items-center gap-4">
                        <a href="#send-reply" class="btn btn-green cursor-pointer">پاسخ</a>

                        <div x-data="{ infoModal: @entangle('settingModal').defer }"
                             x-init="$watch('infoModal', toggleOverflow)">
                            <div @click="infoModal = !infoModal">
                                <span
                                    class="bg-gray-100 p-3 rounded-md flex items-center justify-center cursor-pointer">
                                    <i class="fal fa-cog text-gray-700 text-lg"></i>
                                </span>
                            </div>
                            <div x-show="infoModal"
                                 x-transition:enter="ease-out duration-300"
                                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                 x-transition:leave="ease-in duration-200"
                                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                 class="fixed top-0 bottom-0 right-0 w-full h-full bg-black bg-opacity-60 z-80">

                                <div
                                    class="bg-white dark:bg-gray-700 rounded-lg overflow-hidden shadow-xl transform transition-all w-11/12 lg:w-2/12 mx-auto mt-8 xl:mt-16 py-8 px-6 dir-rtl relative">
                                    <div class="flex items-center justify-between mb-5">
                                        <span class="text-lg font-bold dark:text-white">تنظیمات</span>
                                        <i @click="infoModal = false"
                                           class="fal fa-times text-gray text-xl cursor-pointer dark:text-white"></i>
                                    </div>

                                    <form method="POST" wire:submit.prevent="changeStatus">
                                        @csrf

                                        <div class="flex gap-4">
                                            @if($ticket->status != 'pending')
                                                <label for="pending">
                                                    <input wire:model.defer="status" name="status" type="radio"
                                                           value="pending"
                                                           id="pending">
                                                    <span>در حال بررسی</span>
                                                </label>
                                            @endif
                                            <label for="close">
                                                <input wire:model.defer="status" name="status" type="radio"
                                                       value="close"
                                                       id="close">
                                                <span>بستن</span>
                                            </label>
                                        </div>

                                        <div class="text-center mt-8">
                                            <button type="submit" class="btn btn-green">ذخیره</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
        <div class="col-span-12 lg:col-span-8">
            <div>
                @foreach($ticket->replies as $item)
                    @if($user->id == $item->user_id)
                        <div class="grid grid-cols-12 gap-2 mb-10">
                            <div class="col-span-2">
                                <div class="flex flex-col items-center">
                                    <img class="rounded-full border mb-2" width="50px"
                                         src="{{ img_url($user->avatar) }}">
                                    <span class="text-gray-500 text-xs">{{ $user->get_display_name() }}</span>
                                </div>
                            </div>
                            <div class="col-span-10">
                                <div class="bg-primary-400 rounded-xl p-4 text-white text-sm relative leading-loose">
                                    {!! nl2br($item->body) !!}

                                    @if($item->files)
                                        <div class="flex justify-end mt-3">
                                            <div
                                                class="bg-gray-100 rounded-md flex items-center gap-4 py-1 px-3">
                                                <span class="text-gray-700 text-xs">پیوست ها: </span>
                                                @foreach($item->files as $file)
                                                    <a href="{{ img_url($file['url']) }}" target="_blank"><i
                                                            class="fal fa-file text-gray-700"></i></a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="grid grid-cols-12 gap-2 mb-10">
                            <div class="col-span-10">
                                <div
                                    class="bg-white dark:bg-gray-700 rounded-xl p-4 text-gray-700 dark:text-white text-sm leading-loose">
                                    {!! nl2br($item->body) !!}

                                    @if($item->files)
                                        <div class="flex justify-end mt-3">
                                            <div
                                                class="bg-gray-100 rounded-md flex items-center gap-4 py-1 px-3">
                                                <span class="text-gray-700 text-xs">پیوست ها: </span>
                                                @foreach($item->files as $file)
                                                    <a href="{{ $file['url'] }}" target="_blank"><i
                                                            class="fal fa-file text-gray-700"></i></a>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-span-2">
                                <div class="flex flex-col items-center">
                                    <img class="rounded-full border mb-2" width="50px"
                                         src="{{ img_url($item->user->avatar) }}">
                                    <span class="text-gray-500 text-xs">{{ $item->user->get_display_name() }}</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

            </div>
            @if($ticket->status == 'close')
                <div class="bg-red-100 rounded-md text-red-500 text-sm text-center p-4">
                    تیکت بسته شده است و امکان ارسال پاسخ جدید وجود ندارد
                </div>
            @else
                <form method="POST" wire:submit.prevent="send">
                    @csrf
                    <div id="send-reply">
                        <div class="relative">
                            <div class="absolute top-4 left-4 cursor-pointer" id="select-files">
                                <i class="fal fa-paperclip text-gray-500 text-lg"></i>
                            </div>
                            <textarea rows="5" wire:model.defer="body"
                                      class="w-full rounded-md focus:ring-0 border-gray-100 focus:border-gray-300 transition text-sm leading-loose text-gray-500"
                                      placeholder="پیام خود را بنویسید ..."></textarea>
                            <x-auth.auth-validation-error name="body"/>
                        </div>
                        @if($files)
                            <div class="flex items-center gap-5 mt-3">
                                <span class="text-gray-500 text-sm">پیوست ها</span>
                                @foreach($files as $key => $file)
                                    <div class="bg-gray-200 rounded-md py-2 px-3 relative">
                                        <i wire:click="removeFile({{ $key }})"
                                           class="fal fa-times cursor-pointer absolute text-xs -top-2 -left-2 text-white bg-red-400 rounded-full py-0.5 px-1"></i>
                                        <a href="{{ img_url($file['url']) }}" target="_blank"
                                           class="text-xs">{{ $file['name'] }}</a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        <div class="flex justify-end mt-2">
                            <span wire:loading wire:target="send" class="text-primary-400 text-xs">منتظر باشید...</span>
                            <button wire:loading.remove wire:target="send" type="submit" class="btn btn-green">ارسال
                                پاسخ
                            </button>
                        </div>
                    </div>
                </form>
            @endif

        </div>
    </div>
</div>
<x-slot name="script">
    <script src="{{ asset('assets/site/js/uppy.js') }}"></script>
</x-slot>
