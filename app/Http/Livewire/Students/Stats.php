<?php

namespace App\Http\Livewire\Students;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Stats extends Component
{
    public $dropoutStudents = 0;
    public $attendingStudents = 0;
    public $passedStudents = 0;
    public $attendingMaleStudents = 0;
    public $attendingFemaleStudents = 0;
    public $dropoutMaleStudents = 0;
    public $dropoutFemaleStudents = 0;
    public $passedMaleStudents = 0;
    public $passedFemaleStudents = 0;

    public function getUserProperty()
    {
        return auth()->user();
    }

    public function getStudentStats()
    {
        $student = DB::table('students')
            ->join('users', 'students.id', '=', 'users.userable_id')
            ->join('schools', 'users.school_id', '=', 'schools.id')
            ->when(! $this->user->isAdministrator(), fn ($q) => $q->where('users.school_id', $this->user->school_id))
            // ->where('users.school_id', '=', $this->user->school_id)
            ->selectRaw("count(case when status = 'dropout' then 1 end) as dropout")
            ->selectRaw("count(case when status = 'attending' then 1 end) as attending")
            ->selectRaw("count(case when status = 'passed' then 1 end) as passed")
            ->selectRaw("count(case when users.gender = 'female' && status = 'attending' then 1 end) as totalAttendingFemale")
            ->selectRaw("count(case when users.gender = 'male' && status = 'attending' then 1 end) as totalAttendingMale")
            ->selectRaw("count(case when users.gender = 'female' && status = 'dropout' then 1 end) as totalDropoutFemale")
            ->selectRaw("count(case when users.gender = 'male' && status = 'dropout' then 1 end) as totalDropoutMale")
            ->selectRaw("count(case when users.gender = 'female' && status = 'passed' then 1 end) as totalPassedFemale")
            ->selectRaw("count(case when users.gender = 'male' && status = 'passed' then 1 end) as totalPassedMale")
            ->first();

        $this->dropoutStudents = $student->dropout ?? 0;
        $this->attendingStudents = $student->attending ?? 0;
        $this->passedStudents = $student->passed ?? 0;

        $this->attendingMaleStudents = $student->totalAttendingMale ?? 0;
        $this->attendingFemaleStudents = $student->totalAttendingFemale ?? 0;
        $this->dropoutMaleStudents = $student->totalDropoutMale ?? 0;
        $this->dropoutFemaleStudents = $student->totalDropoutFemale ?? 0;
        $this->passedMaleStudents = $student->totalPassedMale ?? 0;
        $this->passedFemaleStudents = $student->totalPassedFemale ?? 0;
    } 

    public function render()
    {
        return view('livewire.students.stats');
    }
}
