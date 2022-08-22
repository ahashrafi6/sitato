<?php

namespace App\Http\Livewire\Site\Profile;
use Livewire\Component;

class Ticket extends Component
{
    public \App\Models\Ticket $ticket;
    public $user;
    public $files = [];
    public $body;
    public $status = 'close';
    public $settingModal;


    protected $listeners = ['urlAdded', 'refreshComponent' => '$refresh'];

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function urlAdded($url, $name)
    {
        $this->files[] = [
            'name' => $name,
            'url' => $url,
        ];
    }

    public function removeFile($key)
    {
        unset($this->files[$key]);
    }

    public function send()
    {
        $data = $this->validate([
            'body' => 'required|min:10',
            'files' => 'nullable',
        ]);


        $this->ticket->replies()->create([
            'user_id' => $this->user->id,
            'body' => $data['body'],
            'files' => $data['files'] ? $data['files'] : null,
        ]);

        $expire_at = null;
        if ($this->ticket->user_id == $this->user->id) {
          
            $status = 'waiting';
           
        } else {
            $status = 'answer';
        }

        $this->ticket->update([
            'status' => $status,
            'expire_at' => $expire_at
        ]);

       
        $this->files = [];
        $this->body = '';
        $this->emit('success-alert');
        $this->emit('refreshComponent');
    }

    public function changeStatus()
    {
        $data = $this->validate([
            'status' => 'required|in:pending,close'
        ]);

        $this->ticket->update([
            'status' => $data['status']
        ]);

        $this->settingModal = false;
        $this->emit('success-alert');
        $this->emit('refreshComponent');
    }


    public function render()
    {
        return view('livewire.site.profile.ticket')->layout('layouts.profile');
    }
}
