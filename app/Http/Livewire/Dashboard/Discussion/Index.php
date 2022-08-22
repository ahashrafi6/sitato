<?php

namespace App\Http\Livewire\Dashboard\Discussion;

use App\Models\Discussion;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $status = 'all';

    public function updatingStatus()
    {
        $this->resetPage();
    }


    public function render()
    {
        return view('livewire.dashboard.discussion.index' , [
            'discussions' => Discussion::filterdashboard($this->status)->latest()->paginate(10)
        ])->extends('dashboard.master');
    }
}
