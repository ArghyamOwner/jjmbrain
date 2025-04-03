<?php

namespace App\Http\Livewire\Schemes;

use App\Enums\SchemeOperatingStatus;
use App\Enums\SchemeWorkStatus;
use App\Models\Division;
use App\Models\Scheme;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class PublicSchemes extends Component
{
    use WithPagination;
    public $search;
    public $districtId;
    public $type;

    public function mount($districtId = null, $type = null)
    {
        $this->districtId = $districtId;
        $this->type = $type;
    }

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function resetFilter()
    {
        $this->reset([
            'search',
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getDivisionsProperty()
    {
        return Division::query()
            ->orderBy('name')
            ->pluck('name', 'id');
    }

    public function getSchemeStatusesProperty()
    {
        return SchemeWorkStatus::cases();
    }

    public function getOperatingStatusesProperty()
    {
        return SchemeOperatingStatus::cases();
    }

    public function filterData()
    {}

    public function render()
    {
        $data = Scheme::query()
            ->parent()
            ->with(['division', 'district', 'waterReport', 'blocks', 'panchayats', 'villages'])
            ->where('is_archived', 0)
            ->where('work_status', SchemeWorkStatus::HANDED_OVER)
            ->when($this->type, fn($query) => $query->where('operating_status', $this->type))
            ->when($this->search != '', fn($query) => $query->whereLike(['imis_id', 'name'], $this->search))
            ->when($this->districtId != 'all', fn($query) => $query->where('district_id', $this->districtId))
            ->latest('id')
            ->fastPaginate(20);
        $data->getCollection()->transform(function ($item) {
            // $item->formatted_reasons_disruption = Scheme::getIssueTypes()[$item->waterReport?->reasons_disruption ?? ''] ?? '--';
            $item->tentative_date_for_resolution = $item->waterReport?->days !== null ?
            Carbon::parse($item->waterReport?->created_at)
                ->addDays($item->waterReport?->days)
                ->format('d-m-Y') : '--';
            return $item;
        });
        return view('livewire.schemes.public-schemes', [
            'schemes' => $data,
        ])->layout('layouts.public-scheme');
    }
}
