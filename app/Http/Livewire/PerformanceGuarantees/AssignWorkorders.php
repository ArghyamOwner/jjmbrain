<?php

namespace App\Http\Livewire\PerformanceGuarantees;

use App\Models\Workorder;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Str;
use Livewire\Component;

class AssignWorkorders extends Component
{
    use InteractsWithBanner;

    public $pg;
    public $workorder_ids = [];

    public function mount($pg)
    {
        $this->pg = $pg;
    }

    public function assignWorkorder()
    {
        $validate = $this->validate([
            'workorder_ids' => ['required'],
        ]);
        $this->pg->workorders()->sync($validate['workorder_ids']);
        $this->banner('Workorders assigned Successfully.');
        return redirect()->route('pg.show', $this->pg->id);
    }

    public function getWorkordersProperty()
    {
        return Workorder::query()
            ->select('id', 'workorder_number', 'workorder_amount')
            ->lazy()
            ->map(fn($item) => [
                'label' => $item->workorder_number . ' (' . Str::money($item->workorder_amount ?? 0) . ')',
                'value' => $item->id,
            ])
            ->all();
    }

    public function render()
    {
        return view('livewire.performance-guarantees.assign-workorders');
    }
}
