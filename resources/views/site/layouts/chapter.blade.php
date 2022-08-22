@if(count($item->childs) > 0)
<div x-data="{ openQA: false }">
    <li @click.prevent="openQA = !openQA" class="mb-3 {{ in_array($select , $item->childs->pluck('id')->toArray()) ? 'active' : '' }}">
        <div class="border border-gray-300 dark:border-gray-600 rounded-lg mb-3 p-5 flex justify-between items-center cursor-pointer">
            <h2 class="text-gray-600 dark:text-white font-yekan-black text-lg">{{ $item->fa_title }}</h2>
            <i :class="{ 'transform -rotate-90': openQA === true }" class="fal fa-chevron-left font-16 ml-2 dark:text-white"></i>
                 
        </a>
    </li>
    <div x-show.transition="openQA" class="mt-2 {{ in_array($select , $item->childs->pluck('id')->toArray()) ? 'active' : '' }}">
        <ul class="list-unstyled p-0">
            @foreach($item->childs as $child)
                    <li>
                        <div class="border border-gray-300 dark:border-gray-600 rounded-lg mb-3 p-5 flex justify-between items-center cursor-pointer">
                          
                            <div class="flex items-center gap-5">
                                <span class="text-primary-400 font-yekan-black tetx-2xl border-b-4 border-primary-400 px-2">{{ $key + 1 }}</span>
                                <h2 class="font-bold text-gray-700 dark:text-white">{{ $item->fa_title }}</h2>
                            </div>
                          
                            <span class="bg-yellow-400 text-white rounded py-1.5 px-2.5 text-xs font-bold‌">بزودی</span>   
                        </div>
                    </li>
            @endforeach
        </ul>
    </div>
</div>
   
@else
    @if(is_null($item->parent_id))

            <li>
                <div class="border border-gray-300 rounded-lg mb-3 p-5 flex justify-between items-center">
            
                        <h2 class="font-bold text-gray-700">{{ $item->fa_title }}</h2>
                        <span class="bg-yellow-400 text-white rounded py-1.5 px-2.5 text-xs font-bold‌">بزودی</span>
                
                </div>
            </li>
      
    @endif
@endif