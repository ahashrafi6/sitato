<?php

namespace App\Http\Livewire\Site\Profile;

use Livewire\Component;
use Livewire\WithPagination;

class NotificationsUnread extends Component
{
    use WithPagination;

    public function paginationView()
    {
        return 'vendor.livewire.comment-paginate';
    }

    public function render()
    {
        $notifications = auth()->user()->unreadNotifications()->latest()->paginate(10);

        return view('livewire.site.profile.notifications-unread' , ['notifications' => $notifications])->layout('layouts.profile');
    }
}
