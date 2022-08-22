<?php

namespace App\Http\Livewire\Dashboard\Bundle;

use App\Models\Bundle;
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
        return view('livewire.dashboard.bundle.index', [
            'bundles' => Bundle::filter($this->status)->latest()->paginate(10)
        ])->extends('dashboard.master');
    }
}
