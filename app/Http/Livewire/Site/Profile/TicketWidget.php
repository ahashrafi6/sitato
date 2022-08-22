<?php

namespace App\Http\Livewire\Site\Profile;

use Livewire\Component;

class TicketWidget extends Component
{
    public $readyToLoad = false;
    public $data;
    public $user;


    public function mount()
    {
        $this->user = auth()->user();
    }

    public function getData()
    {
 
            $this->data = [
                'waiting' => $this->user->tickets()->whereStatus('waiting')->count(),
                'pending' => $this->user->tickets()->whereStatus('pending')->count(),
                'answer' => $this->user->tickets()->whereStatus('answer')->count(),
                'close' => $this->user->tickets()->whereStatus('close')->count(),
            ];
       
    }

    public function render()
    {
        return view('livewire.site.profile.ticket-widget', [
            'data' => $this->getData()
                ? $this->data
                : [
                    'waiting' => 0,
                    'answer' => 0,
                    'pending' => 0,
                    'close' => 0,
                ],
        ]);
    }
}
