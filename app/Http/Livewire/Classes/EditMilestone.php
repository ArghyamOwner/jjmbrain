<?php

namespace App\Http\Livewire\Classes;

use Livewire\Component;
use App\Traits\WithSlideover;
use App\Models\ClassMilestone;

class EditMilestone extends Component
{
    use WithSlideover;

    public $milestoneId;
    public $milestoneTitle;
   
    protected $listeners = [
        'showEditMilestoneSlideover'
    ];

    public function showEditMilestoneSlideover(ClassMilestone $milestone)
    {
        $this->milestoneId = $milestone->id;
        $this->milestoneTitle = $milestone->milestone_title;
      
        $this->toggle();
    }

    public function save()
    {
        $validated = $this->validate([
            'milestoneTitle' => ['required']
        ]);

        $this->milestone->update([
            'milestone_title' => $validated['milestoneTitle'],
        ]);

        $this->close();

        $this->emit('refreshData');

        $this->notify('Class milestone detail updated.');
    }

    public function getMilestoneProperty()
    {
        return ClassMilestone::findOrFail($this->milestoneId);
    }


    public function render()
    {
        return view('livewire.classes.edit-milestone');
    }
}
