<?php

namespace App\Http\Livewire\Site\Profile;

use Livewire\Component;

class Discussion extends Component
{
    public \App\Models\Discussion $discussion;
    

    public function render()
    {
        return view('livewire.site.profile.discussion')->layout('layouts.profile');
    }
}
