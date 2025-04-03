<?php

namespace App\Http\Livewire\Teachers;

use App\Enums\UserRole;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Stats extends Component
{
    public $totalTeachers = 0;
    public $totalMaleTeachers = 0;
    public $totalFemaleTeachers = 0;
    public $totalContractualTeachers = 0;
    public $totalPermanentTeachers = 0;
    public $totalFemaleContractualTeachers = 0;
    public $totalMaleContractualTeachers = 0;
    public $totalFemalePermanentTeachers = 0;
    public $totalMalePermanentTeachers = 0;

    public function getUserProperty()
    {
        return auth()->user();
    }

    public function getTeacherStats()
    {
        $teacher = DB::table('users')
            ->where('school_id', '=', $this->user->school_id)
            ->where('role', UserRole::TEACHER->value)
            ->selectRaw("count(*) as totalTeachers")
            ->selectRaw("count(case when employment_type = 'contractual' then 1 end) as totalContractualTeachers")
            ->selectRaw("count(case when employment_type = 'permanent' then 1 end) as totalPermanentTeachers")
            ->selectRaw("count(case when gender = 'female' && employment_type = 'contractual' then 1 end) as totalFemaleContractualTeachers")
            ->selectRaw("count(case when gender = 'male' && employment_type = 'contractual' then 1 end) as totalMaleContractualTeachers")
            ->selectRaw("count(case when gender = 'male' && employment_type = 'permanent' then 1 end) as totalMalePermanentTeachers")
            ->selectRaw("count(case when gender = 'female' && employment_type = 'permanent' then 1 end) as totalFemalePermanentTeachers")
            ->first();
 
        $this->totalTeachers = $teacher->totalTeachers ?? 0;
        $this->totalMaleTeachers = $teacher->totalMaleContractualTeachers + $teacher->totalMalePermanentTeachers ?? 0;
        $this->totalFemaleTeachers = $teacher->totalFemaleContractualTeachers + $teacher->totalFemalePermanentTeachers ?? 0;

        $this->totalContractualTeachers = $teacher->totalContractualTeachers ?? 0;
        $this->totalFemaleContractualTeachers = $teacher->totalFemaleContractualTeachers ?? 0;
        $this->totalMaleContractualTeachers = $teacher->totalMaleContractualTeachers ?? 0;

        $this->totalPermanentTeachers = $teacher->totalPermanentTeachers ?? 0;
        $this->totalMalePermanentTeachers = $teacher->totalMalePermanentTeachers ?? 0;
        $this->totalFemalePermanentTeachers = $teacher->totalFemalePermanentTeachers ?? 0;
    } 
    
    public function render()
    {
        return view('livewire.teachers.stats');
    }
}
