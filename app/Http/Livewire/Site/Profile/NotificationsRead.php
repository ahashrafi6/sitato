<?php

namespace App\Http\Livewire\Site\Profile;

use Livewire\Component;
use Livewire\WithPagination;

class NotificationsRead extends Component
{
    use WithPagination;

    public function paginationView()
    {
        return 'vendor.livewire.comment-paginate';
    }

    public function render()
    {
        $notifications = auth()->user()->readNotifications()->latest()->paginate(10);
        return view('livewire.site.profile.notifications-read' , ['notifications' => $notifications])->layout('layouts.profile');
    }
}
