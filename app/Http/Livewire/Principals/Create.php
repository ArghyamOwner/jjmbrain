<?php

namespace App\Http\Livewire\Principals;

use App\Models\User;
use App\Enums\UserRole;
use Livewire\Component;
use App\Enums\EmploymentType;
use App\Enums\DesignationTypes;
use Illuminate\Validation\Rule;

class Create extends Component
{
    public $name;
    public $email;
    public $genderType = 'male';
    public $dob;
    public $phone;
    public $qualification;
    public $employmentType = 'contractual';
    public $schoolCode;
    public $principalId;
    
    public function getUserProperty()
    {
        return auth()->user();
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users'],
            'genderType' => ['required', Rule::in(['male', 'female'])],
            'dob' => ['required', 'date:Y-m-d'],
            'phone' => ['required', 'digits:10'],
            'qualification' => ['required'],
            'principalId' => ['required'],
            'employmentType' => ['required', Rule::in(EmploymentType::values())],
            'schoolCode' => ['required'],
        ]);

        User::create([
            'school_id' => $this->user->school_id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'role' => UserRole::PRINCIPAL,
            'gender' => $validated['genderType'],
            'dob' => $validated['dob'],
            'phone' => $validated['phone'],
            'designation' => DesignationTypes::PRINCIPAL,
            'qualification' => $validated['qualification'],
            'teacher_or_employee_id' => $validated['principalId'],
            'employment_type' => $validated['employmentType'],
            'school_code' => $validated['schoolCode']
        ]);
        
        $this->dispatchBrowserEvent('hide-modal');

        $this->reset();

        $this->emit('refreshData');

        $this->bannerMessage('Principal saved.');
    }

    public function render()
    {
        return view('livewire.principals.create');
    }
}
