@extends('site.profile.vue-master')

@section('body')
    <div class="dir-rtl">
        <div class="grid grid-cols-12 gap-3 mt-5 mb-8">
            <div class="col-span-12 lg:col-span-8 mb-3 lg:mb-0">
                <h4 class="text-2xl font-bold mb-2 dark:text-white">سوالات متداول</h4>
                <a href="{{ $product->path() }}" target="_blank" class="text-sm text-gray-500 dark:text-gray-400">{{ $product->fa_title }}</a>
            </div>
        </div>

        <faqs :model="{{ json_encode(\App\Models\Product::class) }}" :id="{{ json_encode($product->id) }}" :faqs="{{ json_encode($product->faqs) }}"></faqs>

    </div>

@endsection
