<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Product;
use App\Traits\Site\LicenceApi;
use Livewire\Component;
use Livewire\WithPagination;

class Tickets extends Component
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
        // bought products
      $ids = array_unique(auth()->user()->projects()->pluck('product_id')->toArray());
      $this->products = Product::find($ids);
    }

    public function render()
    {
        $user = auth()->user();
        $tickets = $user->tickets()->filter($this->tracking , $this->status , $this->product , null , null)->with('product')->latest('updated_at')->paginate($this->count);

        return view('livewire.site.profile.tickets' ,['tickets' => $tickets])->layout('layouts.profile');
    }
}
