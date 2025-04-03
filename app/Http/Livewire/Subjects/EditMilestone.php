<?php

namespace App\Http\Livewire\Subjects;

use Livewire\Component;
use App\Models\Milestone;
use App\Traits\WithSlideover;
use Illuminate\Validation\Rule;

class EditMilestone extends Component
{
    use WithSlideover;

    public $milestoneId;
    public $milestoneTitle;
    public $milestoneStatus;

    protected $listeners = [
        'showEditMilestoneSlideover'
    ];

    public function showEditMilestoneSlideover(Milestone $milestone)
    {
        $this->milestoneId = $milestone->id;
        $this->milestoneTitle = $milestone->milestone_title;
        $this->milestoneStatus = $milestone->status;

        $this->toggle();
    }

    public function save()
    {
        $validated = $this->validate([
            'milestoneTitle' => ['required'],
            'milestoneStatus' => ['required', Rule::in([
                'not-started',
                'in-progress', 
                'completed',
                'late',
                'cancelled',
                'rescheduled',
                'pending',
                'on-hold'
            ])],
        ]);

        $this->milestone->update([
            'milestone_title' => $validated['milestoneTitle'],
            'status' => $validated['milestoneStatus'],
        ]);

        $this->close();

        $this->emit('refreshData');

        $this->notify('Milestone detail updated.');
    }

    public function getMilestoneStatusesProperty()
    {
        return [
            'not-started',
            'in-progress', 
            'completed',
            'late',
            'cancelled',
            'rescheduled',
            'pending',
            'on-hold'
        ];
    }

    public function getMilestoneProperty()
    {
        return Milestone::findOrFail($this->milestoneId);
    }

    public function render()
    {
        return view('livewire.subjects.edit-milestone');
    }
}
