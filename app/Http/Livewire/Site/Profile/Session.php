<?php

namespace App\Http\Livewire\Site\Profile;

use Livewire\Component;

class Session extends Component
{
    public $sessions;

    public function mount()
    {
        $this->getSessions();
    }


    public function removeSession($payload)
    {
        \App\Models\Session::where('payload' , $payload)->delete();

        $this->getSessions();
        $this->emit('success-alert');
    }

    public function getSessions()
    {
        $this->sessions = auth()->user()->sessions()->latest('last_activity')->get();
    }

    public function render()
    {
        return <<<'blade'
        <div>
         @foreach($sessions as $session)
                       <div class="p-5 bg-white dark:bg-gray-700 rounded-lg transition duration-500 mb-3">
                           <div class="flex flex-col lg:flex-row items-center justify-between">
                               <div class="flex items-center">
                                   @if(\Illuminate\Support\Str::contains($session->user_agent , 'Windows'))
                                       <i class="fab fa-windows text-gray-500 text-5xl ml-4"></i>
                                       <div>
                                           <div class="text-xl font-bold mb-2">
                                               <span class="dark:text-white">ویندوز</span>
                                               @elseif(\Illuminate\Support\Str::contains($session->user_agent , 'Linux'))
                                                   <i class="fab fa-linux text-gray-500 text-5xl ml-4"></i>
                                                   <div>
                                                       <div class="text-xl font-bold mb-2">
                                                           <span class="dark:text-white">لینوکس</span>
                                                           @elseif(\Illuminate\Support\Str::contains($session->user_agent , 'Mac'))
                                                               <i class="fab fa-apple text-gray-500 text-5xl ml-4"></i>
                                                               <div>
                                                                   <div class="text-xl font-bold mb-2">
                                                                       <span class="dark:text-white">مک</span>
                                                                       @endif
                                                                       @if(\Illuminate\Support\Str::contains($session->user_agent , 'Firefox'))
                                                                           <span class="dark:text-white">Firefox</span>
                                                                       @elseif(\Illuminate\Support\Str::contains($session->user_agent , 'Chrome'))
                                                                           <span class="dark:text-white">Chrome</span>
                                                                       @elseif(\Illuminate\Support\Str::contains($session->user_agent , 'Safari'))
                                                                           <span class="dark:text-white">Safari</span>
                                                                       @endif
                                                                   </div>
                                                                   <p class="text-sm text-gray-500">{{ $session->ip_address }}
                                                                       @if(request()->ip() == $session->ip_address)
                                                                           (نشست فعلی)
                                                                       @endif
                                                                   </p>
                                                               </div>
                                                       </div>
                                                       <div class="flex items-center gap-3">
                                                           @if(request()->ip() != $session->ip_address)
                                                               <span wire:click="removeSession('{{ $session->payload }}')" class="text-red-500 text-sm cursor-pointer">حذف نشست</span>
                                                           @endif

                                                           <div>
                                                               <i class="fal fa-clock text-gray-500"></i>
                                                               <span class="text-sm text-gray-500">آخرین مشاهده : {{ d_date(\Carbon\Carbon::parse($session->last_activity)) }}</span>
                                                           </div>
                                                       </div>
                                                   </div>
                                           </div>
        @endforeach
        </div>

        blade;
    }
}
