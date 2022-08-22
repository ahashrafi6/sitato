<?php

namespace App\Http\Livewire\Site\Profile;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Livewire\WithPagination;

class Invoice extends Component
{
    use WithPagination;

    public $count = 10;
    public $type = 'all';


    public function render()
    {
        $user = auth()->user();
        $factors = $user->factors()->where('status' , true)->orWhere('isSystem' , true)->latest()->paginate($this->count);

        return view('livewire.site.profile.invoice', [
            'invoices' => $factors,
            'user' => $user
        ])->layout('layouts.profile');
    }
}
