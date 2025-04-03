<?php

namespace App\Http\Livewire\JalAddas;

use App\Models\JalAdda;
use Livewire\Component;
use App\Models\JalAddaStudent;

class Show extends Component
{
    public $jaladda;

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function mount(JalAdda $jaladda)
    {
        $jaladda->loadMissing([
            'user',
            'trainerOne',
            'trainerTwo',
            'district'
        ]);
    }

    public function render()
    {
        return view('livewire.jal-addas.show', [
            'jaladdaStudents' => JalAddaStudent::query()->with('school')->where('jal_adda_id', $this->jaladda->id)->get()
        ]);
    }
}
