<?php

namespace App\Http\Livewire\Grievances;

use App\Http\Livewire\Modal;
use App\Models\Grievance;
use App\Models\Issue;
use Livewire\Component;

class Show extends Modal
{
    public $grievanceId;
    public $issueId;

    protected $listeners = [ 
        'refreshIssueClosed' => '$refresh',
        'refreshData' => '$refresh'
    ];

    public function mount($grievanceId)
    {
        $this->grievanceId = $grievanceId;
    }

    public function update()
    {
        $validated = $this->validate([
            'issueId' => ['required'],
        ]);
 
        $this->grievance->update([
            'issue_id' => $validated['issueId'],
        ]);
      
       $this->reset('issueId');

        $this->closeModal();

       $this->emit('refreshData');

        $this->notify('Updated.');  
    }

    public function getGrievanceProperty()
    {
        return Grievance::query()
            ->with('division', 'scheme', 'beneficiary', 'createdBy', 'issue', 'assignGrievanceTasks.assignedTo', 'district', 'block', 'panchayat', 'village', 'category', 'subCategory', 'images')
            ->findOrFail($this->grievanceId);
    }

    public function getIssuesProperty()
    {
        return Issue::query()->where('sub_category_id', $this->grievance->sub_category_id)->pluck('issue', 'id');
    }

    public function render()
    {
        return view('livewire.grievances.show', [
            'grievance' => $this->grievance,
        ]);
    }
}