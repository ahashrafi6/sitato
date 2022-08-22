<?php

namespace App\Http\Livewire\Dashboard\Detail;

use App\Models\Detail;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $status = 'all';

    public function updatingType()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.dashboard.detail.index' , [
            'details' => Detail::filter($this->status)->with('product')->latest()->paginate(10)
        ])->extends('dashboard.master');
    }
}
