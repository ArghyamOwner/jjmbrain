<?php

namespace App\Http\Livewire\Grievances;

use App\Enums\SchemeWorkStatus;
use App\Models\Category;
use App\Models\Division;
use App\Models\Grievance;
use App\Models\SubCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $sort = '';
    public $division = 'all';
    public $priority = 'all';
    public $status = 'all';
    public $platform = 'all';
    public $category = 'all';
    public $subCategory = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'sort' => ['except' => ''],
        'division' => ['except' => 'all'],
        'priority' => ['except' => 'all'],
        'status' => ['except' => 'all'],
        'platform' => ['except' => 'all'],
        'category' => ['except' => 'all'],
        'subCategory' => ['except' => 'all'],
    ];

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function resetFilter()
    {
        $this->reset(['search', 'division', 'priority', 'status', 'sort', 'platform', 'category', 'subCategory']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getDivisionsProperty()
    {
        return Division::orderBy('name')->pluck('name', 'id');
    }

    public function getPrioritiesProperty()
    {
        return Grievance::gePriorityOptions();
    }

    public function getStatusesProperty()
    {
        return Grievance::getStatusOptions();
    }

    public function getCategoriesProperty()
    {
        return Category::orderBy('name')->pluck('name', 'id')->all();
    }

    public function getSubCategoriesProperty()
    {
        return SubCategory::orderBy('name')->pluck('name', 'id')->all();
    }

    public function render()
    {
        $grievance = Grievance::query()
            ->with('scheme:id,name', 'division', 'category:id,name', 'subCategory:id,name', 'issue', 'latestAssignedTask.assignedTo', 'assignGrievanceTasks')
            ->when(auth()->user()->isDPMU(), fn($query) =>
                $query->where('district_id', auth()->user()->district_id)
                    ->whereRelation('scheme', 'work_status', SchemeWorkStatus::HANDED_OVER))
            ->when(auth()->user()->isPanchayat(), fn($query) =>
                $query->where('panchayat_id', auth()->user()->panchayat_id)
                    ->whereRelation('scheme', 'work_status', SchemeWorkStatus::HANDED_OVER))
            ->when(auth()->user()->isExecutiveEngineer(), fn($query) =>
                $query->whereIn('division_id', auth()->user()->divisions()->pluck('division_id')))
            ->when(auth()->user()->isJalMitra(), fn($query) =>
                $query->where('scheme_id', auth()->user()->scheme?->id))
            ->when(
                auth()->user()->isSectionOfficer(),
                fn($query) =>
                $query->whereIn('division_id', auth()->user()->divisions()->pluck('division_id'))
                //  ->whereRelation('scheme', 'work_status', '<>', SchemeWorkStatus::HANDED_OVER)
                    ->whereRelation('assignGrievanceTasks', 'assigned_to', auth()->id())
            );
        // ->when(
        //     auth()->user()->isJalMitra(),
        //     fn ($query) =>
        //     $query->whereIn('division_id', auth()->user()->divisions()->pluck('division_id'))
        //     ->whereRelation('scheme', 'work_status', SchemeWorkStatus::HANDED_OVER)
        // );

        return view('livewire.grievances.index', [
            'grievances' => $grievance
                ->when($this->search != '', fn($query) => $query->whereLike('reference_no', $this->search))
                ->when($this->division != 'all', fn($query) => $query->where('division_id', $this->division))
                ->when($this->category != 'all', fn($query) => $query->where('category_id', $this->category))
                ->when($this->subCategory != 'all', fn($query) => $query->where('sub_category_id', $this->subCategory))
                ->when($this->priority != 'all', fn($query) => $query->where('priority', $this->priority))
                ->when($this->status != 'all', fn($query) => $query->where('status', $this->status))
                ->when($this->platform != 'all', fn($query) => $query->where('platform', $this->platform))
                ->when($this->sort == 'asc', fn($query) => $query->oldest())
                ->when($this->sort != 'asc', fn($query) => $query->latest())
                // ->latest('id')
                ->fastPaginate(),
            'platformOptions' => Grievance::getPlatformOptions(),
        ]);
    }
}
