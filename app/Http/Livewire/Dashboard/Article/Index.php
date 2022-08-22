<?php

namespace App\Http\Livewire\Dashboard\Article;

use App\Models\Article;
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
        return view('livewire.dashboard.article.index' , [
            'articles' => Article::DashboardFilter($this->status)->latest()->paginate(10)
        ])->extends('dashboard.master');
    }
}
