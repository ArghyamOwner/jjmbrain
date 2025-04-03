<?php

namespace App\Http\Livewire\Jalshalas;

use App\Models\Jaldoot;
use Livewire\Component;
use App\Models\JalshalaSchool;

class ShowJalshalaSchools extends Component
{
    public $jalshalaschoolId;
    public $jalshalaId;
    public $jalshalasSchoolName;

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function mount(JalshalaSchool $jalshalaschool)
    {
        $this->jalshalaschoolId = $jalshalaschool->id;
        $this->jalshalaId = $jalshalaschool->jalshala_id;
        $this->jalshalasSchoolName = $jalshalaschool->school_name;
    }

    public function render()
    {
        return view('livewire.jalshalas.show-jalshala-schools', [
            'jaldoots' => Jaldoot::with('jalshalaSchool.jalshala')->where('jalshala_school_id', $this->jalshalaschoolId)->get()
        ]);
    }
}
