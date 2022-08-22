<?php

namespace App\Http\Livewire\Dashboard\Withdraw;

use App\Models\Withdraw;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $cate = 'all';
    public $status = 'all';

    public function updatingStatus()
    {
        $this->resetPage();
    }


    public function render()
    {
        return view('livewire.dashboard.withdraw.index' , [
            'withdraws' => Withdraw::filter($this->cate , $this->status)->latest()->paginate(10)
        ])->extends('dashboard.master');
    }
}
