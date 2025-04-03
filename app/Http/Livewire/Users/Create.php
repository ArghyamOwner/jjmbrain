<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use App\Models\School;
use App\Enums\UserRole;
use Livewire\Component;
use App\Traits\InteractsWithBanner;

class Create extends Component
{
    use InteractsWithBanner;

    public $name;
    public $email;
    public $phone;
    public $school;
    public $password;
    public $password_confirmation;
    
    public function getUserProperty()
    {
        return auth()->user();
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => ['required'],
            'school' => ['required'],
            'email' => ['required', 'unique:users'],
            'phone' => ['required', 'digits:10'],
            'password' => ['required', 'confirmed'],
        ]);

        User::create([
            'school_id' => $validated['school'],
            'name' => $validated['name'],
            'email' => $validated['email'],
            'email_verified_at' => now(),
            'password' => bcrypt($validated['password']),
            'role' => UserRole::SUB_ADMIN,
            'phone' => $validated['phone']
        ]);
        
        $this->emit('refreshData');

        $this->banner('Sub-Administrator saved.');

        return redirect()->route('users');
    }

    public function getSchoolsProperty()
    {
        return School::orderBy('name')->pluck('name', 'id');
    }
   
    public function render()
    {
        return view('livewire.users.create');
    }
}
