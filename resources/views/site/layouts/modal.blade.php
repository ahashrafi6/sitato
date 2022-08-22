<div x-data="{ openModal: false }" class="fixed inset-0 overflow-y-auto z-90">
    <button @click="openModal = !openModal" class="btn btn-primary">باز شدن</button>
    <div @click="openModal = !openModal" x-show="openModal" class="fixed right-0 top-0 w-full h-full inset-0 backdrop-filter backdrop-blur-sm"></div>
    <div x-show="openModal"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto inset-0">
        <p>dsfsdf</p>
        <p>dsfsdf</p>
        <p>dsfsdf</p>
        <p>dsfsdf</p>
    </div>
</div>
