<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Product;
use App\Traits\Site\LicenceApi;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerTickets extends Component
{
    use WithPagination;

    public $products = [];
    public $product;
    public $tracking;
    public $status;
    public $count = 10;

    protected $queryString = ['product' , 'tracking' , 'status'];

    public function paginationView()
    {
        return 'vendor.livewire.comment-paginate';
    }

    public function mount()
    {
        $this->products = auth()->user()->products;
    }

    public function render()
    {
        $tickets = \App\Models\Ticket::customers($this->products->pluck('id'))->filter($this->tracking , $this->status , $this->product , null , null)->with('product' , 'replies')->latest('updated_at')->paginate($this->count);
        return view('livewire.site.profile.customer-tickets' ,['tickets' => $tickets])->layout('layouts.profile');
    }
}
