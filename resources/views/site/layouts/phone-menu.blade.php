<div class="lg:hidden" x-data="{ openPhoneMenu: false }">
    <i @click="openPhoneMenu = !openPhoneMenu"
       class="fad fa-bars text-gray-500 dark:text-white text-2xl cursor-pointer"></i>
    <div x-show="openPhoneMenu"
         x-transition:enter="transition ease-linear duration-200"
         x-transition:enter-start="transform opacity-0 translate-x-20"
         x-transition:enter-end="transform opacity-100 translate-x-0"
         x-transition:leave="transition ease-linear duration-200"
         x-transition:leave-start="transform opacity-100 translate-x-0"
         x-transition:leave-end="transform opacity-0 translate-x-20"
         class="cart-modal shadow-2xl fixed left-auto top-0 bottom-0 right-0 h-full w-8/12 overflow-x-hidden overflow-y-auto z-90 bg-white dark:bg-gray-700">
        <div class="flex items-center justify-between px-4">
            <img src="{{ asset('assets/site/images/logo.png') }}" class="py-4 w-44 dark:hidden" alt="اشتراک وردپرس">
            <img src="{{ asset('assets/site/images/logo-dark.png') }}" class="py-4 w-44 hidden dark:block"
                 alt="اشتراک وردپرس">
            <i class="fal fa-arrow-alt-square-right text-primary-600 float-left text-3xl py-4 cursor-pointer"
               @click="openPhoneMenu = !openPhoneMenu"></i>
        </div>
        <ul class="my-10 px-4">
            @foreach($menus as $item)
                @if(count($item->childs) > 0)
                    <li class="py-3" x-data="{ openMenu: false }">
                        <a @click.prevent="openMenu = !openMenu" @click.away="openMenu = false" class="font-bold dark:text-white w-full" href="{{ $item->url }}">{{ $item->title }}</a>
                        <ul
                        x-show="openMenu"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                         class="bg-gray-50 dark:bg-gray-800 rounded-md my-3 p-4">
                            @foreach($item->childs as $child)
                            <li class="py-3 pr-2">
                                <a class="font-bold dark:text-white w-full" href="{{ $child->url }}">{{ $child->title }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                @else
                <li class="py-3">
                    <a class="font-bold dark:text-white w-full" href="{{ $item->url }}">{{ $item->title }}</a>
                </li>
                @endif
            @endforeach
        </ul>
    </div>
    <div @click="openPhoneMenu = !openPhoneMenu" x-show="openPhoneMenu"
         class="fixed right-0 top-0 w-full h-full z-80 bg-black opacity-60"></div>
</div>

