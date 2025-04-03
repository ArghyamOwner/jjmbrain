<?php

namespace App\Http\Livewire\Workorders;

use App\Models\Division;
use App\Models\Workorder;
use App\Traits\InteractsWithSlideoverModal;
use Livewire\Component;

class UpdateDivision extends Component
{
    use InteractsWithSlideoverModal;

    public $workorderId;
    public $divisionId;
    
    protected $listeners = [
        'updateDivisionSlideover' => 'openModal'
    ];

    public function openModal($id)
    {
        $this->resetErrorBag();
        $this->show = true;
        $this->workorderId = $id;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'divisionId' => ['required'],
        ]);

        $this->workorder->update([
            'division_id' => $validatedData['divisionId'],
        ]);

        $this->dispatchBrowserEvent('reset-virtual-select');
        $this->emit('refreshWorkorder');
        $this->notify('Division Updated.');
        $this->close();
    }

    public function getWorkorderProperty()
    {
        return Workorder::findOrFail($this->workorderId);
    }

    public function getDivisionsProperty()
    {
        $result = Division::orderBy('name', 'asc')->get();

        return collect($result)->map(fn($item) => [
            "label" => $item->name,
            "value" => $item->id,
        ])->all();
    }

    public function render()
    {
        return view('livewire.workorders.update-division');
    }
}
