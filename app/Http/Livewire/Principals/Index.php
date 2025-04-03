<?php

namespace App\Http\Livewire\Principals;

use App\Models\User;
use App\Enums\UserRole;
use Livewire\Component;

class Index extends Component
{
    public function getUserProperty()
    {
        return auth()->user();
    }

    public function render()
    {
        return view('livewire.principals.index', [
            'principalUser' => User::query()
                ->whereRole(UserRole::PRINCIPAL->value)
                ->where('school_id', $this->user->school_id)
                ->first()
        ]);
    }
}
