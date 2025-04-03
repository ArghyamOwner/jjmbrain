<?php

namespace App\Http\Livewire\Teachers;

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
    public $teacherId;
    
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
            'teacherId' => ['required'],
            'employmentType' => ['required', Rule::in(EmploymentType::values())],
            'schoolCode' => ['required'],
        ]);

        User::create([
            'school_id' => $this->user->school_id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'role' => UserRole::TEACHER,
            'gender' => $validated['genderType'],
            'dob' => $validated['dob'],
            'phone' => $validated['phone'],
            'designation' => DesignationTypes::TEACHER,
            'qualification' => $validated['qualification'],
            'teacher_or_employee_id' => $validated['teacherId'],
            'employment_type' => $validated['employmentType'],
            'school_code' => $validated['schoolCode']
        ]);
        
        $this->dispatchBrowserEvent('hide-modal');

        $this->reset();

        $this->emit('refreshData');

        $this->bannerMessage('New teacher saved.');
    }

    public function render()
    {
        return view('livewire.teachers.create');
    }
}
