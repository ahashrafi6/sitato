<?php

namespace App\Http\Livewire\Site\Profile;

use Livewire\Component;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;
    public $status = 'all';

    public function paginationView()
    {
        return 'vendor.livewire.comment-paginate';
    }


    public function render()
    {
        $products = auth()->user()->products()->filter($this->status)->latest()->paginate(9);

        return view('livewire.site.profile.products' ,['products' => $products])->layout('layouts.profile');
    }
}
