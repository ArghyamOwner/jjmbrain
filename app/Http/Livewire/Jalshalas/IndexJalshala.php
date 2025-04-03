<?php

namespace App\Http\Livewire\Jalshalas;

use Livewire\Component;
use App\Models\District;
use App\Models\Jalshala;
use App\Enums\JalshalaType;
use Livewire\WithPagination;
use App\Enums\JalshalaStatus;

class IndexJalshala extends Component
{
    use WithPagination;

    public $search;
    public $district = 'all';
    public $status = 'all';
    public $type = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'district' => ['except' => 'all'],
        'status' => ['except' => 'all'],
        'type' => ['except' => 'all'],
    ];

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function resetFilter()
    {
        $this->reset(['search', 'district', 'status', 'type']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getDistrictsProperty()
    {
        return District::query()->orderBy('name')->pluck('name', 'id');
    }

    public function getStatusesProperty()
    {
        return JalshalaStatus::cases();
    }

    public function getJalshalaTypesProperty()
    {
        return JalshalaType::cases();
    }

    public function render()
    {
        return view('livewire.jalshalas.index-jalshala', [
            'jalshalas' => Jalshala::with(['district', 'schemes', 'educationBlocks'])
                ->withCount('jalshalaSchools', 'jalshalaSchoolsJaldoots', 'schemes')
                ->when(!auth()->user()->isAdministratorOrStateJaldootCell(), function ($query) {
                    $query->whereIn('district_id', auth()->user()->districts()->pluck('district_id'));
                })
                ->when($this->search != '', fn ($query) => $query->whereLike(['jalshala_uin'], $this->search))
                ->when($this->district != 'all', fn ($query) => $query->where('district_id', $this->district))
                ->when($this->status != 'all', fn ($query) => $query->where('status', $this->status))
                ->when($this->type != 'all', fn ($query) => $query->where('type', $this->type))
                ->latest('id')
                ->fastPaginate(10)
        ]);
    }
}
