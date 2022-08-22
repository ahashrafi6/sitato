<?php

namespace App\Http\Livewire\Site\Profile;

use Livewire\Component;
use Livewire\WithPagination;

class Notifications extends Component
{
    public function render()
    {
        return view('livewire.site.profile.notifications')->layout('layouts.profile');
    }
}
