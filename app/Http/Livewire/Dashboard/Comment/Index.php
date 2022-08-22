<?php

namespace App\Http\Livewire\Dashboard\Comment;

use App\Models\Comment;
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
        return view('livewire.dashboard.comment.index' , [
            'comments' => Comment::filter($this->status)->latest()->paginate(10)
        ])->extends('dashboard.master');
    }
}
