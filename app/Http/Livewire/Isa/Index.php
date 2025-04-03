<?php

namespace App\Http\Livewire\Isa;

use App\Models\Block;
use App\Models\District;
use App\Models\Isa;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $district_id='all';
    public $type='all';
    public $block_id='all';
    public $blocks = [];

    public $showActionButton = true;

    protected $queryString = [
        'search' => ['except' => ''],
        'block_id' => ['except' => 'all'],
        'district_id' => ['except' => 'all'],
        'type' => ['except' => 'all'],
    ];

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function resetFilter()
    {
        $this->reset(['search', 'district_id', 'block_id', 'type']);
    }

    public function getDistrictsProperty()
    {
        if (auth()->user()->isIsaCoordinator()) {
            return auth()->user()->districts?->pluck('name', 'id')->all();
        }
        return District::orderBy('name')->pluck('name', 'id')->all();
    }

    public function updatedDistrictId()
    {
        $this->reset('block_id');
        $this->blocks = Block::orderBy('name')->where('district_id', $this->district_id)->pluck('name', 'id')->all();
    }


    public function render()
    {
        if(auth()->user()->isWucAuditor()){
            $this->showActionButton = false;
        }

        return view('livewire.isa.index', [
            'isas' => Isa::query()
                ->with('villages', 'district', 'block')
                ->when($this->search != '', fn($query) => $query->whereLike(['name', 'contact_name', 'contact_phone'], $this->search))
                ->when(!(auth()->user()->isAdministrator() || auth()->user()->isStateIsa() || auth()->user()->isWucAuditor()), function ($q) {
                    if(auth()->user()->isAsrlmBlock()){
                        $q->whereIn('block_id', auth()->user()->blocks->pluck('id'));
                    }else{
                        $q->whereIn('district_id', auth()->user()->districts->pluck('id'));
                    }
                })
                ->when($this->district_id != 'all', fn($query) => $query->where('district_id', $this->district_id))
                ->when($this->block_id != 'all', fn($query) => $query->where('block_id', $this->block_id))
                ->when($this->type != 'all', fn($query) => $query->where('type', $this->type))
                ->latest('id')
                ->fastPaginate(),
        ]);
    }
}
