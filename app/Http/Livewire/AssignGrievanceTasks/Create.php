<?php

namespace App\Http\Livewire\AssignGrievanceTasks;

use App\Models\AssignGrievanceTask;
use App\Models\Grievance;
use App\Models\IssueEscalation;
use App\Models\User;
use Livewire\Component;
use App\Traits\InteractsWithBanner;
use App\Traits\InteractsWithSlideoverModal;

class Create extends Component
{
    use InteractsWithSlideoverModal;
    use InteractsWithBanner;

    public $role;
    public $users = [];
    public $assignTo;
    public $dueDate;
    public $remarks;

    public $grievanceId;
    public $grievanceDivision;

    protected $listeners = [
        'addAssignGrievanceTaskSlideover' => 'openModal'
    ];

    public function openModal(Grievance $id)
    {
        $this->resetErrorBag();
        $this->show = true;
        $this->grievanceId = $id->id;
        $this->grievanceDivision = $id->division_id;
    }

    public function save()
    {
        $validatedData = $this->validate([
            'role' => ['required'],
            'assignTo' => ['required'],
            'dueDate' => ['required'],
            'remarks' => ['nullable'],
        ]);

        AssignGrievanceTask::Create([
            'role' => $validatedData['role'],
            'assigned_to' => $validatedData['assignTo'],
            'due_date' => $validatedData['dueDate'],
            'remarks' => $validatedData['remarks'],
            'grievance_id' => $this->grievanceId,
            'assigned_by' => auth()->id()
        ]);

        $this->reset();

       $this->emit('refreshAssignedTask');

        $this->banner('Saved.');

        $this->close();
    }

    public function getRolesProperty()
    {
        return [
            'section-officer' => 'Section Officer',
            'sdo' => 'SDO',
        ];
        // return collect(config('freshman.roles'))->filter(function($item, $key) {
        //     return $key != 'admin' && $key != 'super-admin';
        // });
    }

    public function updatedRole($value)
    {
        $this->users = User::query()->where('role', $value)->whereHas('divisions',  function($q) {
            $q->where('division_id',$this->grievanceDivision);
        })->pluck('name', 'id');

        $issueId = Grievance::whereId($this->grievanceId)->first()['issue_id'];

        $issueEscalation = IssueEscalation::query()->where('issue_id', $issueId)->where('role', $value);

        if($issueEscalation->exists()){
            $days = $issueEscalation->first()['days'];
            $this->dueDate = \Carbon\Carbon::now()->addDay($days)->format('Y-m-d');
        }
    }

    public function render()
    {
        return view('livewire.assign-grievance-tasks.create');
    }
}