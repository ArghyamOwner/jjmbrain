<?php

namespace App\Http\Livewire\Notifications;

use Livewire\Component;

class Count extends Component
{
    protected $listeners = [
        'markAsRead' => '$refresh',
        'markAllAsRead' => '$refresh'
    ];
    
    public function render()
    {
        return <<<'blade'
            <div>
                @if(auth()->user()->unreadNotifications()->count())
                    <div class="bg-red-500 w-1.5 h-1.5 rounded-full"></div>
                @endif
            </div>
        blade;
    }
}
