<div x-data="{ addModal: @entangle('addModal').defer }">

    <a @click="addModal = true" href="#" class="btn btn-blue">افزودن دامنه</a>

    <div x-show="addModal" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="fixed top-0 bottom-0 right-0 w-full h-full bg-black bg-opacity-60 z-80">

   

        <div
            class="bg-white dark:bg-gray-700 rounded-lg overflow-hidden shadow-xl transform transition-all w-11/12 lg:w-4/12 mx-auto mt-8 xl:mt-16 py-8 px-6 dir-rtl relative">
            <div class="flex items-center justify-between mb-5">
                <span class="text-lg font-bold dark:text-white">افزودن دامنه جدید</span>
                <i @click="addModal = false"
                    class="fal fa-times text-gray text-xl cursor-pointer dark:text-white"></i>
            </div>

        
    <ul class="text-sm text-gray-500 dark:text-white flex flex-col gap-3 my-5">

        <li>- توجه داشته باشید، دامنه‌ای که وارد می‌کنید را باید قبلا از سرویس‌دهنده‌های دیگر خریداری کرده باشید.</li>
        <li>- توجه داشته باشید که برای دسترسی به دامنه با www باید این دامنه را نیز جداگانه متصل کنید.</li>
     
    </ul>


    <form method="POST" wire:submit.prevent="Add({{ $project->id }})">
        @csrf

        <div class="grid grid-cols-12 gap-3 plans-holder mt-5 w-full">
            <div class="col-span-12">
        
                    <x-auth.input wire:model.defer="domain" class="block w-full dir-ltr"
                        type="text" required placeholder="example.com" />
            </div>

        </div>

        <div class="flex justify-between mt-2 items-center">
            <span>
                <x-auth.auth-validation-error name="username" />
            </span>

            <div>
                <span wire:loading wire:target="Add"
                    class="text-gray-500 text-xs">منتظر باشید...</span>
                <button wire:loading.remove wire:target="Add" type="submit"
                    class="btn btn-green cursor-pointer">ثبت
                </button>
            </div>
        </div>
    </form>
          
        </div>

        

    </div>
</div>