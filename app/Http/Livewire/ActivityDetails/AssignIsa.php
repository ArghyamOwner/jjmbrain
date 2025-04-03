<?php

namespace App\Http\Livewire\ActivityDetails;

use App\Models\ActivityDetail;
use App\Models\Isa;
use Livewire\Component;

class AssignIsa extends Component
{
    public $activity;
    public $isas = [];

    public function mount(ActivityDetail $activity)
    {
        $this->activity = $activity;
    }

    public function assignIsa()
    {
        $validated = $this->validate([
            'isas' => ['required'],
        ]);
        $this->activity->isas()->sync($validated['isas']);
        $this->dispatchBrowserEvent('reset-virtual-select');
        $this->notify('ISA(s) assigned to Activity');
    }

    public function render()
    {
        if ($this->activity->village_id) {
            $isaOptions = Isa::whereHas("villages", function ($q) {
                $q->where("village_id", $this->activity->village_id);
            })
                ->orderBy('name')
                ->get()
                ->map(fn($item) => [
                    'label' => $item->name,
                    'value' => $item->id,
                ])
                ->all();
        } else {
            $isaOptions = [];
        }

        return view('livewire.activity-details.assign-isa', [
            'isaOptions' => $isaOptions,
        ]);
    }
}
