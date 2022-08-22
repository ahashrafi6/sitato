<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Product;
use App\Traits\Site\LicenceApi;
use Livewire\Component;
use Livewire\WithPagination;

class AdminTickets extends Component
{
    use WithPagination;

    public $tracking;
    public $department;
    public $status;
    public $type;
    public $count = 10;

    protected $queryString = ['tracking' , 'status' , 'department' , 'type'];

    public function mount(){
        if(!auth()->user()->isAdmin()){
            abort(404);
        }
    }

    public function paginationView()
    {
        return 'vendor.livewire.comment-paginate';
    }


    public function render()
    {
        $tickets = \App\Models\Ticket::filter($this->tracking , $this->status, null , $this->department , $this->type)->with('product')->latest('updated_at')->paginate($this->count);
        return view('livewire.site.profile.admin-tickets' ,['tickets' => $tickets])->layout('layouts.profile');
    }
}
