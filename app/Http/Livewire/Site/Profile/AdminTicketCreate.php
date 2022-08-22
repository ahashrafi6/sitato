<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Product;
use App\Traits\Site\LicenceApi;
use App\Traits\Site\PayApi;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithFileUploads;

class AdminTicketCreate extends Component
{
    public $user_id;
    public $title;
    public $body;
    public $files = [];

    protected $listeners = ['urlAdded'];

    public function mount(){
        if(!auth()->user()->isAdmin()){
            abort(404);
        }
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

    public function save()
    {
        $data = $this->validate([
            'user_id' => 'required',
            'title' => 'required|string|min:6',
            'body' => 'required|min:10',
            'files' => 'nullable',
        ]);



        $ticket = \App\Models\Ticket::create([
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'department' => 'admin',
            'type' => 'admin-ticket',
            'status' => 'admin',
        ]);

        $ticket->replies()->create([
            'user_id' => auth()->user()->id,
            'body' => $data['body'],
            'files' => $data['files'] ? $data['files'] : null,
        ]);

        session()->flash('success', 'تیکت شما با موفقیت ثبت شد');
        return redirect()->route('admin.profile.tickets');
    }

    public function render()
    {
        return view('livewire.site.profile.admin-ticket-create')->layout('layouts.profile');
    }
}
