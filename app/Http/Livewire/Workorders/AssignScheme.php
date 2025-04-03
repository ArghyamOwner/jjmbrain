<?php

namespace App\Http\Livewire\Workorders;

use App\Models\Scheme;
use Livewire\Component;
use App\Models\Division;
use App\Models\SchemeActivity;
use App\Models\Workorder;

class AssignScheme extends Component
{
    public $workorderId;
    public $circleId;
    // public $division;
    public $division_id;
    public $scheme;

    public function mount(Workorder $workorder)
    {
        $this->workorderId = $workorder->id;
        $this->circleId = $workorder->circle_id;
        $this->division_id = $workorder->division_id;
    }

    public function save()
    {
        $validated = $this->validate([
            // 'division' => ['required'],
            'scheme' => ['required'],
        ]);

        $this->workorder->schemes()->sync($validated['scheme']);

        foreach($validated['scheme'] as $scheme){
            SchemeActivity::create([
                'user_id' => auth()->id(),
                'scheme_id' => $scheme,
                'activity_type' => 'wo_assigned',
                'content' => 'Work-order Assigned - '.$this->workorder->id,
                'feedable_type' => get_class(new Scheme()),
                'feedable_id' => $scheme
            ]);
        }
        // $this->workorder->schemes()->attach($validated['scheme']);

        // $this->reset(['scheme']);
        $this->dispatchBrowserEvent('reset-virtual-select');
        $this->notify('Scheme assigned to workorder');
    }

    // public function getDivisionsProperty()
    // {
    //     return Division::where('circle_id', $this->circleId)->pluck('name', 'id');   
    // }

    public function getWorkorderProperty()
    {
        return Workorder::findOrFail($this->workorderId);
    }

    public function render()
    {
        if ($this->division_id) {
            $schemes = Scheme::where('division_id', $this->division_id)
                ->orderBy('name')
                ->get()
                ->map(fn($item) => [
                    'label' => $item->name.' ( Id - '.($item->old_scheme_id ?? ' N/A ').' )',
                    'value' => $item->id
                ])
                ->all();
        } else {
            $schemes = [];
        }

        return view('livewire.workorders.assign-scheme', [
            'schemes' => $schemes
        ]);
    }
}
