<div x-data="{ infoModal: false }" x-init="$watch('infoModal', toggleOverflow)">
    <div @click="infoModal = !infoModal">
        {{ $button }}
    </div>
    <div x-show="infoModal"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="fixed top-0 bottom-0 right-0 w-full h-full bg-black bg-opacity-60 z-80">

        <div class="bg-white dark:bg-gray-700 rounded-lg overflow-hidden shadow-xl transform transition-all w-11/12 lg:w-{{ $name }}/12 mx-auto mt-8 xl:mt-16 py-8 px-6 dir-rtl relative">
            <div class="flex items-center justify-between mb-5">
                <span class="text-lg font-bold dark:text-white">{{ $title ?? '' }}</span>
                <i @click="infoModal = false" class="fal fa-times text-gray text-xl cursor-pointer dark:text-white"></i>
            </div>
            {{ $slot }}
        </div>

    </div>
</div>
