<div wire:init="getData" class="grid grid-cols-4 gap-3 mt-10 dir-rtl">
    <div
        class="col-span-4 xl:col-span-1 bg-white dark:bg-gray-700 rounded-xl p-5 hover:shadow-xl transition duration-200">
        <a href="{{ route('tickets' , ['status' => 'waiting']) }}"
           class="flex gap-4">
            <img src="{{ asset('assets/site/images/ticket-wating.png') }}">
            <div>
                <h3 class="text-2xl mb-2 dark:text-white">{{ $data['waiting'] }}</h3>
                <p class="text-gray-500 text-sm">منتظر پاسخ</p>
            </div>
        </a>

    </div>
    <div
        class="col-span-4 xl:col-span-1 bg-white dark:bg-gray-700 rounded-xl p-5 hover:shadow-xl transition duration-200">
        <a href="{{  route('tickets' , ['status' => 'pending'])}}"
           class="flex gap-4">
            <img src="{{ asset('assets/site/images/ticket-pending.png') }}">
            <div>
                <h3 class="text-2xl mb-2 dark:text-white">{{ $data['pending'] }}</h3>
                <p class="text-gray-500 text-sm">در حال رسیدگی</p>
            </div>
        </a>

    </div>
    <div
        class="col-span-4 xl:col-span-1 bg-white dark:bg-gray-700 rounded-xl p-5 hover:shadow-xl transition duration-200">
        <a href="{{route('tickets' , ['status' => 'answer']) }}"
           class="flex gap-4">
            <img src="{{ asset('assets/site/images/ticket-answer.png') }}">
            <div>
                <h3 class="text-2xl mb-2 dark:text-white">{{ $data['answer'] }}</h3>
                <p class="text-gray-500 text-sm">پاسخ داده شده</p>
            </div>
        </a>
    </div>
    <div
        class="col-span-4 xl:col-span-1 bg-white dark:bg-gray-700 rounded-xl p-5 hover:shadow-xl transition duration-200">
        <a href="{{ route('tickets' , ['status' => 'close']) }}"
           class="flex gap-4">
            <img src="{{ asset('assets/site/images/ticket-close.png') }}">
            <div>
                <h3 class="text-2xl mb-2 dark:text-white">{{ $data['close'] }}</h3>
                <p class="text-gray-500 text-sm">بسته شده</p>
            </div>
        </a>
    </div>
</div>
