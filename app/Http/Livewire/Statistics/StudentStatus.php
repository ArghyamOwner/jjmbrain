<?php

namespace App\Http\Livewire\Statistics;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class StudentStatus extends Component
{
    public function getStudentStatusStats()
    {
        $student = DB::table('students')
            ->join('users', 'students.id', '=', 'users.userable_id')
            ->selectRaw("count(case when status = 'dropout' then 1 end) as dropout")
            ->selectRaw("count(case when status = 'attending' then 1 end) as attending")
            ->selectRaw("count(case when status = 'passed' then 1 end) as passed")
            ->first();

        return [
            'Attending' => $student->attending,
            'Dropout' => $student->dropout,
            'Passed' => $student->passed
        ];
    }

    public function render()
    {
        return view('livewire.statistics.student-status', [
            'data' => $this->getStudentStatusStats()
        ]);
    }
}
