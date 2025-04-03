<?php

namespace App\Http\Livewire\JalAddas;

use App\Models\JalAdda;
use Livewire\Component;
use App\Models\District;
use App\Enums\JalshalaType;
use App\Enums\JaladdaStatus;
use Livewire\WithPagination;

class Index extends Component
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
        return JaladdaStatus::cases();
    }
    
    public function getJalshalaTypesProperty()
    {
        return JalshalaType::cases();
    }

    public function render()
    {
        return view('livewire.jal-addas.index', [
            'jaladdas' => JalAdda::query()
                ->with('district')
                ->withCount('jaladdaStudents')
                ->when(!auth()->user()->isAdministratorOrStateJaldootCell(), function ($query) {
                    $query->whereIn('district_id', auth()->user()->districts()->pluck('district_id'));
                })
                ->when($this->search != '', fn ($query) => $query->whereLike(['venue', 'attendee'], $this->search))
                ->when($this->district != 'all', fn ($query) => $query->where('district_id', $this->district))
                ->when($this->status != 'all', fn ($query) => $query->where('status', $this->status))
                ->when($this->type != 'all', fn ($query) => $query->where('type', $this->type))
                ->latest('id')
                ->fastPaginate()
        ]);
    }
}
