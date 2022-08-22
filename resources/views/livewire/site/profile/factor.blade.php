<x-slot name="style">

</x-slot>
<div class="dir-rtl my-16 bg-white rounded-xl p-8 mx-5">
    <div class="flex justify-center mb-10">
        <img class="w-48" src="{{ asset('assets/site/images/logo.png') }}" alt="اشتراک وردپرس">
    </div>

    <div class="flex justify-between gap-5 flex-wrap">
        <div class="flex flex-col gap-3">
            <span class="text-blue-500 font-bold">شماره فاکتور: {{ $factor->resNumber }}</span>
            <span class="text-gray-500">قابل پرداخت: {{ number_format($factor->final_price) }} تومان</span>
        </div>
        <div class="flex flex-col gap-3 text-sm">
            <div class="flex items-center gap-5">
                <span class="text-gray-500">وضعیت: </span>

                @if ($factor->status)
                <span class="bg-primary-400 text-white rounded-md text-sm py-1.5 px-2 text-md">پرداخت شده</span>
                @else

                @if ($factor->expire_at > now())
                <span class="bg-yellow-400 text-white rounded-md text-sm py-1.5 px-2 text-md">در انتظار پرداخت</span>
                @else
                <span class="bg-red-400 text-white rounded-md text-sm py-1.5 px-2 text-md">منقضی شده</span>
                @endif
               
                @endif

            </div>
            <span class="text-gray-500">تاریخ ایجاد: {{ f_date($factor->created_at) }}</span>
            <span class="text-gray-500">تاریخ اعتبار: {{ f_date($factor->expire_at) }}</span>
        </div>
    </div>

    <div class="text-sm mt-10">
        <p class="font-bold mb-4">مشخصات فاکتور</p>
        <div class="bg-gray-100 p-4 rounded-md flex items-center justify-between">
            <span>شرح کالا یا خدمات</span>
            <span>مبلغ</span>
        </div>

        <div class="border-b border-gray-300 p-4 flex items-center justify-between gap-5">
            <span>تمدید سرور پلن {{ $factor->items['server']['fa_title'] }} - دوره پرداخت {{ $factor->items['month'] }}
                ماهه - برنامه {{ $project->username }}</span>
            <span>{{ number_format($factor->final_price) }} تومان</span>
        </div>
        <div class="p-4 flex items-center justify-between">
            <span>مبلغ کل</span>
            <span>{{ number_format($factor->final_price) }} تومان</span>
        </div>
        <div
            class="bg-primary-100 rounded-md text-primary-500 font-bold border-gray-300 p-4 flex items-center justify-between">
            <span>قابل پرداخت</span>
            <span>{{ number_format($factor->final_price) }} تومان</span>
        </div>
    </div>

    @if (!$factor->status)

    @if ($factor->expire_at > now())
    <div class="mt-8 flex justify-end">
        <span wire:loading.remove wire:target="Pay" wire:click="Pay"
            class="btn btn-blue px-5 rounded-full cursor-pointer">پرداخت آنلاین</span>
        <span wire:loading wire:target="Pay" class="text-gray-500 text-sm">منتظر باشید...</span>
    </div>
    @endif

   
    @endif


</div>

<x-slot name="script">

</x-slot>