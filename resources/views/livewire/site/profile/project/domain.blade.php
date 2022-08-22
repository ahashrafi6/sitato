<x-slot name="style">

</x-slot>

<div class="dir-rtl">

   <div class="flex justify-end mb-5">
    <livewire:site.profile.project.add-domain :project="$project" />
   </div>

    <p class="dark:text-white" wire:loading>صبور باشید...</p>

    @if(count($domains) > 0)
    <div wire:loading.remove>
        @foreach($domains as $key => $item)
            <div class="p-5 bg-white dark:bg-gray-700 rounded-lg hover:shadow-xl transition duration-500 relative mb-5">

                <div class="absolute left-5 bottom-5" x-data="{ removeModal: @entangle('removeModal').defer }">

                    <span @click="removeModal = true" class="cursor-pointer bg-gray-200 rounded py-2 px-3 text-xs">
                        <i class="fal fa-trash text-md"></i>
                        حذف
                    </span>
                
                    <div x-show="removeModal" x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                        class="fixed top-0 bottom-0 right-0 w-full h-full bg-black bg-opacity-60 z-80">

                        <div class="bg-white dark:bg-gray-700 rounded-lg overflow-hidden shadow-xl transform transition-all w-11/12 lg:w-3/12 mx-auto mt-8 xl:mt-16 py-8 px-6 dir-rtl relative">
                            <div class="flex items-center justify-between mb-5">
                                <span class="text-lg font-bold dark:text-white">حذف دامنه {{ $item['name'] }}</span>
                                <i @click="removeModal = false"
                                    class="fal fa-times text-gray text-xl cursor-pointer dark:text-white"></i>
                            </div>
                            
                            <p class="text-gray-500 text-sm dark:text-white mb-8">آیا مطمئن هستید؟</p>
                
                            <div>
                                <span wire:loading wire:target="deleteDomain"
                                    class="text-gray-500 text-xs">منتظر باشید...</span>
                                <button wire:loading.remove wire:target="deleteDomain" wire:click="deleteDomain('{{ $item['_id'] }}')"
                                    class="btn btn-red cursor-pointer text-sm">بله حذف شود
                                </button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="flex flex-col lg:flex-row">
                    <div class="m-0 lg:mr-5">

                        <div class="flex items-center gap-3">
                            <span class="dark:text-white text-lg">
                                {{ $item['name'] }}
                            </span>
                            @if ($item['status'] == 'ACTIVE')
                            <span class="bg-primary-50 py-1.5 px-3 text-sm text-primary-400">
                                فعال
                            </span>
                            @else
                            <span class="bg-gray-50 py-1.5 px-3 text-sm text-gray-500">
                                در انتظار تنظیم DNS
                            </span>
                            @endif
                        
                        </div>


                        <div class="mt-5 flex flex-wrap gap-3 items-center">

                            @if ($item['status'] != 'ACTIVE')
                            <x-site.info-modal :name="6">
                                <x-slot name="button">

                                    <div class="flex flex-col gap-4">
                                        <a href="#" class="btn btn-blue text-sm">تنظیم DNS</a>
                                    </div>

                                </x-slot>

                                <p class="text-sm text-gray-500 mb-5 text-center">برای فعال‌شدن دامنه، لطفا در سرویس DNS خود، رکوردهای زیر را ایجاد کنید:</p>

                                <table>
                                    
                                </table>

                                <table class="table-auto m-0 p-0 w-full text-center">

                                    <tr>
                                      <th>value</th>
                                      <th>name</th>
                                      <th>record</th>
                                    </tr>
                                    <tr>
                                      <td>dns.iran.liara.ir</td>
                                      <td>www</td>
                                      <td>CNAME یا ANAME</td>
                                    </tr>
                                    <tr>
                                      <td>{{ $item['verificationCode'] }}</td>
                                      <td>liara-challenge</td>
                                      <td>TXT</td>
                                    </tr>
                                  </table>

                                  <div class="flex justify-center mt-5 gap-3">
                                    @if ($item['status'] == 'ACTIVE')
                                    <span class="bg-primary-50 py-1.5 px-3 text-sm text-primary-400">
                                        فعال
                                    </span>
                                    @else
                                    <span class="bg-gray-50 py-1.5 px-3 text-sm text-gray-500">
                                        در انتظار تنظیم DNS
                                    </span>
                                    @endif

                                    <span class="btn btn-blue cursor-pointer" wire:click="Check">بررسی مجدد DNS</span>
                                  </div>

                            </x-site.info-modal>
                            @endif

                      
                           

                            @if ($item['status'] == 'ACTIVE')

                                <livewire:site.profile.project.domain-setting :wire:key="$item['name']" :domains="$domains" :project="$project" :domain="$item" />

                            @endif
                        </div>
                    </div>
                </div>
            </div>
       
        @endforeach
    </div>
    @else
    <div class="flex flex-col justify-center items-center my-10">
        <p class="text-sm text-gray-400 text-center mt-5 dark:text-white">هیج دامنه ای ثبت نشده است</p>
    </div>
    @endif
</div>

<x-slot name="script">

</x-slot>