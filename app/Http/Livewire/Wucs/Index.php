<?php

namespace App\Http\Livewire\Wucs;

use App\Models\Block;
use App\Models\District;
use App\Models\RevenueCircle;
use App\Models\Wuc;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $district = 'all';
    public $revenue_circle_id = 'all';
    public $block_id = 'all';
    public $show = '';

    public $circles = [];
    public $blocks = [];
    public $showDeleteButton = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'district' => ['except' => 'all'],
        'revenue_circle_id' => ['except' => 'all'],
        'block_id' => ['except' => 'all'],
        'show' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function resetFilter()
    {
        $this->reset(['search', 'district', 'revenue_circle_id', 'block_id', 'show']);
    }

    public function getDistrictsProperty()
    {
        if (auth()->user()->isIsaCoordinator()) {
            return auth()->user()->districts?->pluck('name', 'id')->all();
        }
        return District::orderBy('name')->pluck('name', 'id')->all();
    }

    public function updatedDistrict()
    {
        $this->reset('revenue_circle_id', 'block_id');
        $this->circles = RevenueCircle::orderBy('name')->where('district_id', $this->district)->pluck('name', 'id')->all();
        $this->blocks = Block::orderBy('name')->where('district_id', $this->district)->pluck('name', 'id')->all();
    }

    public function render()
    {
        $user = auth()->user();

        if($user->isAdministrator() || $user->isAsrlmBlock() || $user->isIsaCoordinator() || $user->isStateIsa()){
            $this->showDeleteButton = true;
        }
        
        return view('livewire.wucs.index', [
            'wucs' => Wuc::query()
                ->with('district', 'block', 'revenueCircle', 'schemes:id,name')
                ->when($this->search != '', fn($query) => $query->whereLike(['name', 'block.name'], $this->search))
            // ->when(!(auth()->user()->isAdministrator() || auth()->user()->isStateIsa()), function ($q) {
            //     $q->whereIn('district_id', auth()->user()->districts->pluck('id'));
            // })
                ->when($this->district != 'all', fn($query) => $query->where('district_id', $this->district))
                ->when($this->block_id != 'all', fn($query) => $query->where('block_id', $this->block_id))
                ->when($this->revenue_circle_id != 'all', fn($query) => $query->where('revenue_circle_id', $this->revenue_circle_id))
                ->when($this->show == 'bank', fn($query) => $query->whereNotNull('account_number'))
                ->when($this->show == 'withoutBank', fn($query) => $query->whereNull('account_number'))
            // ->when(!auth()->user()->isAdministrator(),function ($q) {
            //     $q->whereIn('district_id', auth()->user()->districts->pluck('id'));
            //         // ->orWhereIn('block_id', auth()->user()->blocks->pluck('id'));
            // })
                ->when($user->isAsrlmBlock() || $user->isBlockUser(), function ($q) use ($user) {
                    $q->whereIn('block_id', $user->blocks->pluck('id'));
                })
                ->when($user->isIsaCoordinator() || $user->isCeoZp() || $user->isDc(), function ($q) use ($user) {
                    $q->whereIn('district_id', $user->districts->pluck('id'));
                })
                ->when($user->isPanchayat(), function ($q) use ($user) {
                    $q->whereHas('schemes', function ($subQuery) use ($user) {
                        $subQuery->whereHas('panchayats', function ($subQuery) use ($user) {
                            $subQuery->where('panchayats.id', $user->panchayat_id);
                        });
                    });
                })
                ->latest('id')
                ->fastPaginate(10),
        ]);
    }
}
