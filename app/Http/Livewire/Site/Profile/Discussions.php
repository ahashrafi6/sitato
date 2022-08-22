<?php

namespace App\Http\Livewire\Site\Profile;

use Livewire\Component;
use Livewire\WithPagination;

class Discussions extends Component
{
    use WithPagination;

    public $products;
    public $product;
    public $count = 10;

    protected $queryString = ['product'];

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
        $discussions = \App\Models\Discussion::customers($this->products->pluck('id'))->filter($this->product)->latest()->paginate($this->count);
        return view('livewire.site.profile.discussions' ,['discussions' => $discussions])->layout('layouts.profile');
    }
}
