<?php

namespace App\Http\Livewire\ActivityDetails;

use App\Models\ActivityDetail;
use App\Models\Block;
use App\Models\District;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $district_id='all';
    public $block_id='all';
    public $blocks = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'block_id' => ['except' => 'all'],
        'district_id' => ['except' => 'all'],
    ];

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function resetFilter()
    {
        $this->reset(['search', 'district_id', 'block_id']);
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
        $showAddButton = true;
        if(auth()->user()->isWucAuditor() || auth()->user()->isDc()){
            $showAddButton = false;
        }
        return view('livewire.activity-details.index', [
            'showAddButton' => $showAddButton,
            'phases' => ActivityDetail::getPhaseOptions(),
            'activities' => ActivityDetail::query()
                ->with('activity', 'district', 'block', 'panchayat', 'districtUser:id,name')
                ->when($this->search != '', fn($query) => $query->whereLike(['activity.name'], $this->search))
                ->when(!(auth()->user()->isAdministrator() || auth()->user()->isStateIsa()), function ($q) {
                    if(auth()->user()->isAsrlmBlock()){
                        $q->whereIn('block_id', auth()->user()->blocks->pluck('id'));
                    }else{
                        $q->whereIn('district_id', auth()->user()->districts->pluck('id'));
                    }
                })
                ->when($this->district_id != 'all', fn($query) => $query->where('district_id', $this->district_id))
                ->when($this->block_id != 'all', fn($query) => $query->where('block_id', $this->block_id))
                ->latest('id')
                ->fastPaginate(),
        ]);
    }
}
