<?php

namespace App\Http\Livewire\Classes;

use Livewire\Component;
use App\Models\ClassMilestone;
use App\Models\AcademicYear;

class Milestones extends Component
{
    public $classId;
    public $milestoneTitle;

    protected $listeners = [
        'refreshData' => '$refresh'  
    ];

    public function saveClassMilestone()
    {
        $validated = $this->validate([
            'milestoneTitle' => ['required']
        ]);

        ClassMilestone::create([
            'academic_year_id' => $this->currentAcademicYear->id,
            'class_id' => $this->classId,
            'milestone_title' => $validated['milestoneTitle']
        ]);

        $this->bannerMessage('Class milestone added.');
        
        $this->reset('milestoneTitle');

        $this->dispatchBrowserEvent('hide-modal');
    }

    public function getCurrentAcademicYearProperty()
    {
        return AcademicYear::query()
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();
    }
    
    public function render()
    {
        $milestones = ClassMilestone::whereHas('class', function ($query) {
            $query->where('id', $this->classId);
        })->where('academic_year_id', $this->currentAcademicYear->id)->get();
 
        return view('livewire.classes.milestones', [
            'milestones' => $milestones
        ]);
    }
}
