@props(['isSmall' => false , 'product'])

@if($product->badges)
    <div class="flex gap-5 flex-wrap">
        @if(in_array('original', $product->badges))
            <div class="badge-item relative cursor-pointer">
                <div
                    class="bg-orange-400 {{ $isSmall ? 'w-10 h-10 p-2 rounded-lg' : 'w-16 h-16 p-2 rounded-2xl' }} flex items-center justify-center">
                    <img src="{{ asset('assets/site/images/check-badge.png') }}"
                         alt="{{ \App\Models\Product::BADGES['original'] }}">
                </div>
                <span
                    class="tooltip absolute -top-8 right-0 bg-primary-400 text-white text-xs rounded-full w-max py-1 px-3 transition duration-500">{{ \App\Models\Product::BADGES['original'] }}</span>
            </div>
        @endif
        @if(in_array('special', $product->badges))
            <div class="badge-item relative cursor-pointer">
                <div
                    class="bg-blue-400 {{ $isSmall ? 'w-10 h-10 p-2 rounded-lg' : 'w-16 h-16 p-2 rounded-2xl' }} flex items-center justify-center">
                    <img src="{{ asset('assets/site/images/gem-badge.png') }}"
                         alt="{{ \App\Models\Product::BADGES['special'] }}">
                </div>
                <span
                    class="tooltip absolute -top-8 right-0 bg-primary-400 text-white text-xs rounded-full w-max py-1 px-3 transition duration-500">{{ \App\Models\Product::BADGES['special'] }}</span>
            </div>
        @endif
        @if(in_array('licence', $product->badges))
            <div class="badge-item relative cursor-pointer">
                <div
                    class="bg-primary-400 {{ $isSmall ? 'w-10 h-10 p-2 rounded-lg' : 'w-16 h-16 p-2 rounded-2xl' }} flex items-center justify-center">
                    <img src="{{ asset('assets/site/images/subwp-badge.png') }}"
                         alt="{{ \App\Models\Product::BADGES['licence'] }}">
                </div>
                <span
                    class="tooltip absolute -top-8 right-0 bg-primary-400 text-white text-xs rounded-full w-max py-1 px-3 transition duration-500">{{ \App\Models\Product::BADGES['licence'] }}</span>
            </div>
        @endif
        @if(in_array('subscribe', $product->badges))
            <div class="badge-item relative cursor-pointer">
                <div
                    class="bg-yellow-400 {{ $isSmall ? 'w-10 h-10 p-2 rounded-lg' : 'w-16 h-16 p-2 rounded-2xl' }} flex items-center justify-center">
                    <i class="fal fa-user-crown text-white {{ $isSmall ? 'text-2xl' : 'text-4xl' }}"></i>
                </div>
                <span class="tooltip absolute -top-8 right-0 bg-primary-400 text-white text-xs rounded-full w-max py-1 px-3 transition duration-500">{{ \App\Models\Product::BADGES['subscribe'] }}</span>
            </div>
        @endif
        @if(in_array('iran', $product->badges))
            <div class="badge-item relative cursor-pointer">
                <div
                    class="bg-green-400 {{ $isSmall ? 'w-10 h-10 p-1 rounded-lg' : 'w-16 h-16 p-2 rounded-2xl' }} flex items-center justify-center">
                    <img src="{{ asset('assets/site/images/iran-badge.png') }}"
                         alt="{{ \App\Models\Product::BADGES['iran'] }}">
                </div>
                <span
                    class="tooltip absolute -top-8 right-0 bg-primary-400 text-white text-xs rounded-full w-max py-1 px-3 transition duration-500">{{ \App\Models\Product::BADGES['iran'] }}</span>
            </div>
        @endif
        @if(in_array('easy-install', $product->badges))
            <div class="badge-item relative cursor-pointer">
                <div
                    class="bg-red-400 {{ $isSmall ? 'w-10 h-10 p-1 rounded-lg' : 'w-16 h-16 p-2 rounded-2xl' }} flex items-center justify-center">
                    <img src="{{ asset('assets/site/images/install-badge.png') }}"
                         alt="{{ \App\Models\Product::BADGES['easy-install'] }}">
                </div>
                <span
                    class="tooltip absolute -top-8 right-0 bg-primary-400 text-white text-xs rounded-full w-max py-1 px-3 transition duration-500">{{ \App\Models\Product::BADGES['easy-install'] }}</span>
            </div>
        @endif
    </div>
@endif

