<?php

namespace App\Http\Livewire\Schools;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Stats extends Component
{
    public $totalSchools = 0;
    public $totalCbseSchools = 0;
    public $totalIcseSchools = 0;
    public $totalIscSchools = 0;
    public $totalApbeSchools = 0;

    public function getUserProperty()
    {
        return auth()->user();
    }

    public function getSchoolStats()
    {
        $school = DB::table('schools')
            ->selectRaw("count(*) as totalSchools")
            ->selectRaw("count(case when affiliated_board = 'CBSE' then 1 end) as totalCbseSchools")
            ->selectRaw("count(case when affiliated_board = 'ICSE' then 1 end) as totalIcseSchools")
            ->selectRaw("count(case when affiliated_board = 'ISC' then 1 end) as totalIscSchools")
            ->selectRaw("count(case when affiliated_board = 'APBE' then 1 end) as totalApbeSchools")
            ->first();

        $this->totalSchools = $school->totalSchools ?? 0;
        $this->totalCbseSchools = $school->totalCbseSchools ?? 0;
        $this->totalIcseSchools = $school->totalIcseSchools ?? 0;
        $this->totalIscSchools = $school->totalIscSchools ?? 0;
        $this->totalApbeSchools = $school->totalApbeSchools ?? 0;
        
    } 
    
    public function render()
    {
        return view('livewire.schools.stats');
    }
}
