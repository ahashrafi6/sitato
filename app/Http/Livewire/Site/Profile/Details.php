<?php

namespace App\Http\Livewire\Site\Profile;

use App\Models\Detail;
use Livewire\Component;
use Livewire\WithPagination;

class Details extends Component
{
    use WithPagination;

    public $status = 'all';
    public $ids;

    public function mount()
    {
        $this->ids = auth()->user()->products()->pluck('id');
    }


    public function paginationView()
    {
        return 'vendor.livewire.comment-paginate';
    }

    public function render()
    {
        $details = Detail::whereIn('product_id', $this->ids)->filter($this->status)->with('product')->latest()->paginate(10);
        return view('livewire.site.profile.details', ['details' => $details])->layout('layouts.profile');
    }
}
