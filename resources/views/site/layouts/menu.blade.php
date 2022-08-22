<ul class="main-menu hidden lg:flex items-center mr-16 h-full dir-rtl">
    @foreach($menus as $item)
        @if(count($item->childs) > 0)
            @if($item->type == 'mega')
                <li class="ml-8 h-full parent-item" x-data="{ openMenu: false }">
                    <a href="{{ $item->url }}" :class="{ 'active': openMenu === true }" class="dark:text-white h-full flex items-center"
                       @click.prevent="openMenu = !openMenu" @click.away="openMenu = false">
                        {{ $item->title }}
                        <i class="far fa-chevron-down text-xs text-gray-300 pr-1.5"></i>
                    </a>
                    <ul x-show="openMenu"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"

                        class="bg-white dark:bg-gray-800 z-10 rounded-b-md py-16 px-20 absolute right-0 custom-shadow dark:shadow-none w-full grid grid-cols-3 gap-x-28 gap-y-14">
                        @foreach($item->childs as $child)
                            <li class="col-span-1 relative">
                                <a href="{{ $child->url }}">
                                    <div class="flex items-center hover:opacity-70">

                                        <div class="bg-green-400 rounded-md p-2">
                                            <img width="40px" src="{{ img_url($child->icon) }}">
                                        </div>
                                    

                                        <div class="flex flex-col pr-5">
                                            <span class="text-lg text-gray-700 dark:text-primary-500">{{ $child->title }}</span>
                                            <p class="text-sm text-gray-500 mt-2">{{ $child->description }}</p>
                                        </div>
                                    </div>
                                </a>
                                @if (!is_null($child->info))
                                <span class="absolute top-0 left-0 tooltip">
                                    <i class="fal fa-info-circle text-lg text-gray-400 cursor-pointer opener"></i>
                                    <div class="body absolute text-xs text-white p-4 z-10 rounded-md text-justify leading-5 bg-gradient-to-r from-primary-800 via-primary-700 to-primary-600">
                                        {{ $child->info }}
                                    </div>
                                </span>
                                @endif
                                
                            </li>
                        @endforeach
                    </ul>
                </li>
            @else
                <li class="ml-8 h-full parent-item" x-data="{ openDrop: false }">
                    <a href="{{ $item->url }}" :class="{ 'active': openDrop === true }" class="dark:text-white h-full flex items-center"
                       @click.prevent="openDrop = !openDrop" @click.away="openDrop = false">
                        {{ $item->title }}
                        <i class="far fa-chevron-down text-xs text-gray-300 pr-1.5"></i>
                    </a>
                    <ul x-show="openDrop"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"

                        class="bg-white dark:bg-gray-800 z-10 rounded-b-md p-5 pb-0 absolute custom-shadow dark:shadow-none w-60">
                        @foreach($item->childs as $child)
                            <li class="mb-5">
                                <a href="{{ $child->url }}" class="w-full">
                                    <div class="hover:opacity-70">
                                        <span class="dark:text-white text-gray-600">{{ $child->title }}</span>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endif
        @else
            <li class="ml-8 h-full parent-item">
                <a href="{{ $item->url }}" class="dark:text-white h-full flex items-center">
                    {{ $item->title }}
                </a>
            </li>
        @endif
    @endforeach
</ul>
