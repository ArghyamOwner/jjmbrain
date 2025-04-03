<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
 
    public function render()
    {
        auth()->user()->unreadNotifications->each(fn ($notification) => $notification->markAsRead());

        $this->emit('markAllAsRead');

        $notifications = auth()->user()->notifications()->take(20)->get();
      
        return view('livewire.notifications.index', [
            'notifications' => $notifications
        ]);
    }
}
