<div class="bg-white dark:bg-gray-700 p-8 rounded-md duration-500" id="comments-body">
    @if(count($notifications) > 0)
        @foreach($notifications as $item)
            <a href="{{ $item->data['url'] }}" class="block bg-gray-100 dark:bg-gray-800 duration-500 rounded-md p-4 mb-2">
                <div class="flex items-center justify-between">
                    <div>
                        @switch($item->data['type'])
                            @case('author_ticket')
                            <i class="fal fa-ticket p-2 bg-gray-500 text-white rounded-md"></i>
                            @break
                            @case('author_ticket_reply')
                            <i class="fal fa-ticket-alt p-2 bg-gray-500 text-white rounded-md"></i>
                            @break
                            @case('author_quick_ticket')
                            <i class="fal fa-ticket-alt p-2 bg-red-400 text-white rounded-md"></i>
                            @break
                            @case('author_quick_ticket_reply')
                            <i class="fal fa-ticket-alt p-2 bg-red-400 text-white rounded-md"></i>
                            @break
                            @case('withdraw')
                            <i class="fal fa-money-bill p-2 bg-green-400 text-white rounded-md"></i>
                            @break
                        @endswitch
                        <span class="font-bold text-sm dark:text-white">{{ $item->data['title'] }}</span>
                    </div>
                    <span class="text-xs text-gray-500">{{ d_date($item->created_at) }}</span>
                </div>
                <p class="text-sm mt-3 dark:text-white">{{ $item->data['description'] }}</p>
            </a>
        @endforeach

        <div class="flex justify-end mt-5">
            {{ $notifications->links() }}
        </div>
    @else
        <div class="flex flex-col justify-center items-center my-10">
            <img class="w-16" src="{{ asset('assets/site/images/empty-cart-icon.png') }}">
            <p class="text-sm text-gray-400 text-center mt-5 dark:text-white">هیچ اعلان خوانده شده ای یافت نشد!</p>
        </div>
    @endif
</div>
