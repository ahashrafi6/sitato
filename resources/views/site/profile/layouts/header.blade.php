<div class="flex items-center justify-between dir-rtl">
    <div class="flex items-center gap-5">
        <i @click="resMenu = !resMenu"
           class="fal fa-bars text-gray-500 dark:text-white text-2xl cursor-pointer block lg:hidden"></i>
    </div>

    <div class="flex items-center gap-5 lg:gap-8 lg:gap-12">

        {{-- <i id="dark" class="fal fa-moon text-xl lg:text-2xl text-gray-600 dark:text-primary-500 cursor-pointer"></i> --}}

        <x-site.cart-modal>
            <a href="{{ route('cart') }}" class="cursor-pointer relative">
                @if($cart_count)
                    <span class="w-5 h-5 lg:w-8 lg:h-8 flex items-center justify-center text-white bg-green-400 border-2 border-white rounded-full text-sm absolute -top-2 -right-2 lg:-top-4 lg:-right-4">{{ $cart_count }}</span>
                @endif
                <i class="fal fa-shopping-bag text-xl lg:text-3xl text-gray-500 dark:text-gray-300"></i>
            </a>
        </x-site.cart-modal>

       <div class="relative" x-data="{ alertDrop: false }">

           @if($notifications_count > 0)
               <span class="w-5 h-5 lg:w-8 lg:h-8 flex items-center justify-center text-white bg-green-400 border-2 border-white rounded-full text-sm absolute -top-2 -right-2 lg:-top-4 lg:-right-4 animate-bounce">{{ $notifications_count }}</span>
           @endif

            <i @click="alertDrop = !alertDrop" @click.away="alertDrop = false"
               class="fal fa-bell cursor-pointer text-xl lg:text-3xl text-gray-500 dark:text-gray-300"></i>
            <div x-show.transition="alertDrop"
                 class="bg-white dark:bg-gray-700 shadow-xl rounded-xl p-4 absolute -left-40 lg:left-0 w-80 z-20 overflow-y-scroll h-80">
                @if($notifications_count > 0)
                    @foreach($notifications as $item)
                        <div class="bg-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 hover:bg-white dark:text-white p-3 rounded-md text-xs mb-2">
                            <a href="{{ route('notification' , ['id' => $item->id]) }}" target="_blank">
                                <div class="flex justify-between items-center mb-3">
                                    <span class="font-bold text-primary-500 text-sm">{{ $item->data['title'] }}</span>
                                    <span class="text-gray-500">{{ d_date($item->created_at) }}</span>
                                </div>
                                <p>{{ $item->data['description'] }}</p>
                            </a>
                        </div>
                    @endforeach
                    <a href="{{ route('notifications') }}" class="text-center block text-primary-400 text-sm mt-3">مشاهد همه</a>
                @else
                    <p class="text-sm text-center text-gray-500 mt-24">هیچ اعلان خوانده نشده ای یافت نشد!</p>
                    <a href="{{ route('notifications') }}" class="text-center block text-primary-400 text-sm mt-3">مشاهد آرشیو اعلانات</a>
                @endif
            </div>
        </div>
        <div x-data="{ authDrop: false }" class="relative z-10">
            <button @click="authDrop = !authDrop" @click.away="authDrop = false"
                    class="btn btn-green rounded-xl px-2 lg:py-2 lg:px-5 flex items-center gap-3">
                <img src="{{ img_url($user->avatar) }}" alt="{{ $user->get_display_name() }}"
                     class="rounded-full border-2 border-white w-8 lg:w-12">
                <span class="text-xs lg:text-sm text-white">{{ except(auth()->user()->get_display_name() , 15) }}</span>
            </button>
            <div x-show.transition="authDrop"
                 class="bg-white dark:bg-gray-600 shadow-xl rounded-xl p-4 absolute left-0 w-full">
                <a href="{{ route('tickets.create') }}" class="flex items-center gap-2 mb-5">
                    <i class="fal fa-ticket-alt text-xl text-gray-500 dark:text-white"></i>
                    <span class="dark:text-gray-400 text-sm">ثبت تیکت پشتیبانی</span>
                </a>
                <a href="{{ route('edit') }}" class="flex items-center gap-2 mb-5">
                    <i class="fal fa-pencil text-xl text-gray-500 dark:text-white"></i>
                    <span class="dark:text-gray-400 text-sm">ویرایش حساب</span>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}" class="flex items-center gap-2" onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        <i class="far fa-sign-out text-xl text-gray-500 dark:text-white"></i>
                        <span class="dark:text-gray-400 text-sm">خروج</span>
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
