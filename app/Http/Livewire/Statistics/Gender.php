<?php

namespace App\Http\Livewire\Statistics;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Gender extends Component
{
    public $genderData = [];

    public function getGenderStats()
    {
        $student = DB::table('students')
            ->join('users', 'students.id', '=', 'users.userable_id')
            // ->selectRaw("count(case when status = 'dropout' then 1 end) as dropout")
            // ->selectRaw("count(case when status = 'attending' then 1 end) as attending")
            // ->selectRaw("count(case when status = 'passed' then 1 end) as passed")
            ->selectRaw("count(case when users.gender = 'female' then 1 end) as totalFemale")
            ->selectRaw("count(case when users.gender = 'male' then 1 end) as totalMale")
            ->first();

        $this->genderData = [
            'male' => $student->totalMale,
            'female' => $student->totalFemale,
        ];
 
    }

    public function render()
    {
        $this->getGenderStats();
        
        return view('livewire.statistics.gender');
    }
}
