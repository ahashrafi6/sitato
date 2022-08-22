<?php

namespace App\Http\Livewire\Dashboard\Contact;

use App\Models\Contact;
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
        return view('livewire.dashboard.contact.index',
            [
                'contacts' => Contact::filter($this->status)->latest()->paginate(10)
            ])->extends('dashboard.master');
    }
}
