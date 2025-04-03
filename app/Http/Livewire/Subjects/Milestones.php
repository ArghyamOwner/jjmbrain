<?php

namespace App\Http\Livewire\Subjects;

use Livewire\Component;
use App\Models\Milestone;
use App\Models\AcademicYear;

class Milestones extends Component
{
    public $subjectId;
    public $milestoneTitle;

    protected $listeners = [
        'refreshData' => '$refresh'  
    ];

    public function saveMilestone()
    {
        $validated = $this->validate([
            'milestoneTitle' => ['required']
        ]);

        Milestone::create([
            'academic_year_id' => $this->currentAcademicYear->id,
            'subject_id' => $this->subjectId,
            'milestone_title' => $validated['milestoneTitle'],
            'milestone_details' => null,
            'status' => 'not-started'
        ]);

        $this->bannerMessage('Milestone added.');
        
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
        $milestones = Milestone::whereHas('subject', function ($query) {
            $query->where('id', $this->subjectId);
        })->where('academic_year_id', $this->currentAcademicYear->id)->get();
 
        return view('livewire.subjects.milestones', [
            'milestones' => $milestones
        ]);
    }
}
