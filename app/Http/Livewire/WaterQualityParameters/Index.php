<?php

namespace App\Http\Livewire\WaterQualityParameters;

use App\Models\WaterQualityParameter;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $parameterName;
    public $parameterUnit;
    public $parameterCycle;
    public $safeLimitMin;
    public $safeLimitMax;

    protected $queryString = [
        'search' => ['except' => '']
    ];

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function save()
    {
        $validated = $this->validate([
            'parameterName' => ['required'],
            'parameterUnit' => ['nullable'],
            'parameterCycle' => ['nullable'],
            'safeLimitMin' => ['nullable'],
            'safeLimitMax' => ['nullable'],
        ]);

        WaterQualityParameter::create([
            'parameter_name' => $validated['parameterName'],
            'parameter_cycle' => $validated['parameterCycle'],
            'parameter_unit' => $validated['parameterUnit'],
            'safe_limit_max' => $validated['safeLimitMax'],
            'safe_limit_min' => $validated['safeLimitMin'],
        ]);

        $this->reset([
            'parameterName',
            'parameterUnit',
            'parameterCycle',
            'safeLimitMin',
            'safeLimitMax',
        ]);

        $this->dispatchBrowserEvent('hide-modal');

        $this->emit('refreshData');

        $this->notify('Water Quality Parameters saved.');
    }

    public function render()
    {
        return view('livewire.water-quality-parameters.index', [
            'waterparameters' => WaterQualityParameter::query()
                ->when($this->search != '', fn ($query) => $query->whereLike(['parameter_name'], $this->search))
                ->latest('id')
                ->fastPaginate()
        ]);
    }
}
