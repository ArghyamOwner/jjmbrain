<?php

namespace App\Http\Livewire\Schemes;

use App\Models\SchemeFlowmeterDetails;
use Livewire\Component;

class FlowmeterIndex extends Component
{
    public $schemeId;
    public $showFlowmeterDeleteButton = false;

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function render()
    {
        if(auth()->user()->isAdministrator() || auth()->user()->isSdo() || auth()->user()->isSectionOfficer()){
            $this->showFlowmeterDeleteButton = true;
        }
        return view('livewire.schemes.flowmeter-index',[
            'flowmeterDetails' => SchemeFlowmeterDetails::with('createdBy:id,name', 'flowmeterResetData.createdBy:id,name')->where('scheme_id', $this->schemeId)->get()
        ]);
    }
}
