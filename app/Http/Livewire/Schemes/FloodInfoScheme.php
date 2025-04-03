<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Asset;
use App\Models\SchemeFloodInfo;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class FloodInfoScheme extends Component
{
    // public function render()
    // {
    //     return view('livewire.schemes.flood-info-scheme');
    // }
    use WithPagination;

    public $schemeId;
    public $search;

    protected $queryString = [
        'search' => ['except' => '']
    ];

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function resetFilter()
    {
        $this->reset(['search']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $floodInfoScheme = SchemeFloodInfo::query()
            ->where('scheme_id', $this->schemeId)
            ->when($this->search != '', fn ($query) => $query->whereLike(['inundated_infrastructure'], $this->search))
            ->latest('id')
            ->fastPaginate(10);
        $floodInfoScheme->transform(function ($item) {
            $item->inundated_infrastructure = 
            SchemeFloodInfo::filterInundatedInfrastructureOptions(explode(', ',$item->inundated_infrastructure));
            $item->start_date =  Carbon::createFromFormat('Y-m-d', $item->start_date)->format('F j, Y');
            $item->partial_damage =  SchemeFloodInfo::filterPartialDamageOptions(explode(', ',$item->partial_damage));
            return $item;
        });
        return view('livewire.schemes.flood-info-scheme', [
            'floodinfoscheme' => $floodInfoScheme
        ]);
    }
}
