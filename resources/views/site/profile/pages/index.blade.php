@extends('site.profile.master')

@section('body')
    <div class="grid grid-cols-3 gap-3 mt-10 dir-rtl">
        <div
            class="col-span-3 xl:col-span-1 bg-gradient-to-br from-green-300 to-green-400 rounded-xl p-5 shadow-xl flex gap-4">
            <i class="fal fa-wallet text-5xl text-white"></i>
            <div>
                <h3 class="text-3xl text-white mb-2">{{ number_format($user->wallet) }}</h3>
                <p class="text-white text-sm">اعتبار کیف پول</p>
            </div>
        </div>
{{--         <div
            class="col-span-3 xl:col-span-1 bg-gradient-to-br from-primary-300 to-primary-400 rounded-xl p-5 shadow-xl flex gap-4">
            <i class="fal fa-gift text-5xl text-white"></i>
            <div>
                <h3 class="text-3xl text-white mb-2"></h3>
                <p class="text-white text-sm">اعتبار هدیه</p>
            </div>
        </div> --}}

        <div
            class="col-span-3 xl:col-span-1 bg-gradient-to-br from-orange-300 to-orange-400 rounded-xl p-5 shadow-xl flex gap-4">
            <i class="fal fa-street-view text-5xl text-white"></i>
            <div>
                <h3 class="text-2xl text-white mb-2">{{ d_date($user->created_at) }}</h3>
                <p class="text-white text-sm">عضو از</p>
            </div>
        </div>

    </div>

    <livewire:site.profile.ticket-widget/>

@endsection
