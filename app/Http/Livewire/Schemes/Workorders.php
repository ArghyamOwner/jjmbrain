<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Scheme;
use App\Models\SchemeActivity;
use Livewire\Component;

class Workorders extends Component
{
    public $schemeId;

    public function removeWorkorder($id)
    {
        $this->getScheme()->workorders()->detach($id);

        SchemeActivity::create([
            'user_id' => auth()->id(),
            'scheme_id' => $this->schemeId,
            'activity_type' => 'wo_unassigned',
            'content' => 'Work-order Un-Assigned -'.$id,
            'feedable_type' => get_class(new Scheme()),
            'feedable_id' => $this->schemeId
        ]);

        $this->emit('refreshData');
        $this->notify('Workorder Removed.');
    }

    public function getScheme(){
        return Scheme::with('workorders')->findOrFail($this->schemeId);
    }
    
    public function render()
    {
        $scheme = $this->getScheme();
        
        if(auth()->user()->isAdministrator())
        {
            $unassignOption = true;
        }
        
        return view('livewire.schemes.workorders', [
            'workorders' => $scheme->workorders->load(['circle', 'contractor'])->all(),
            'unassignOption' =>  $unassignOption ?? false
        ]);
    }
}
