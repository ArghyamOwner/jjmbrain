<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Deactivate extends Component
{
    public $deactivate;
    public $userId;

    public function mount()
    {
        $this->deactivate = is_null($this->user->blocked_at) ? "false" : "true";
    }

    public function updatedDeactivate($value)
    {
        if ($value === "true") {
            $this->user->update([
                'blocked_at' => now(),
                'blocked_by' => Auth::id()
            ]);

            $this->notify('User activated.');
        } else {
            $this->user->update([
                'blocked_at' => null,
                'blocked_by' => Auth::id()
            ]);

            $this->notify('User deactivated.');
        }
    }

    public function getUserProperty()
    {
        return User::findOrFail($this->userId);
    }

    public function render()
    {
        return view('livewire.users.deactivate');
    }
}
