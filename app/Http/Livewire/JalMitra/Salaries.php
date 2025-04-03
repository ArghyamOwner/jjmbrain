<?php

namespace App\Http\Livewire\JalMitra;

use App\Models\District;
use App\Models\Division;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Salaries extends Component
{
    use WithPagination;

    public $search;
    public $division = 'all';
    public $district = 'all';
    public $year;

    protected $queryString = [
        'search' => ['except' => ''],
        'division' => ['except' => 'all'],
        'district' => ['except' => 'all'],
    ];

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function mount()
    {
        $this->year = date('Y');
    }

    public function resetFilter()
    {
        $this->reset(['search', 'division', 'district']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getDivisionsProperty()
    {
        return Division::query()->orderBy('name')->pluck('name', 'id');
    }

    public function getDistrictsProperty()
    {
        return District::query()->pluck('name', 'id');
    }

    public function getMonthsProperty()
    {
        return config('freshman.months');
    }

    public function render()
    {
        $results = User::query()
            ->where('role', 'jal-mitra')
            ->rightJoin('salaries', 'users.id', '=', 'salaries.user_id')
            ->join('division_user', 'users.id', '=', 'division_user.user_id')
            ->join('divisions', 'division_user.division_id', '=', 'divisions.id')
            ->join('district_user', 'users.id', '=', 'district_user.user_id')
            ->join('districts', 'district_user.district_id', '=', 'districts.id')
            ->when($this->search != '', fn($query) => $query->where('users.name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.phone', 'like', '%' . $this->search . '%'))
            ->when($this->division != 'all', fn($query) => $query->whereRelation('divisions', 'division_id', $this->division))
            ->when($this->district != 'all', fn($query) => $query->whereRelation('districts', 'district_id', $this->district))
            ->when($this->year, fn($query) => $query->where('salaries.year', $this->year))
            ->select(
                'divisions.name as division_name',
                'districts.name as district_name',
                'users.name',
                'users.phone',
                "users.doj",
                DB::raw("MONTH(users.doj) as doj_month"),
                DB::raw("YEAR(users.doj) as doj_year"),
                'salaries.year',
                DB::raw('MAX(CASE WHEN salaries.month = 01 THEN "success" ELSE "danger" END) as JAN'),
                DB::raw('MAX(CASE WHEN salaries.month = 02 THEN "success" ELSE "danger" END) as FEB'),
                DB::raw('MAX(CASE WHEN salaries.month = 03 THEN "success" ELSE "danger" END) as MAR'),
                DB::raw('MAX(CASE WHEN salaries.month = 04 THEN "success" ELSE "danger" END) as APR'),
                DB::raw('MAX(CASE WHEN salaries.month = 05 THEN "success" ELSE "danger" END) as MAY'),
                DB::raw('MAX(CASE WHEN salaries.month = 06 THEN "success" ELSE "danger" END) as JUN'),
                DB::raw('MAX(CASE WHEN salaries.month = 07 THEN "success" ELSE "danger" END) as JUL'),
                DB::raw('MAX(CASE WHEN salaries.month = 08 THEN "success" ELSE "danger" END) as AUG'),
                DB::raw('MAX(CASE WHEN salaries.month = 09 THEN "success" ELSE "danger" END) as SEP'),
                DB::raw('MAX(CASE WHEN salaries.month = 10 THEN "success" ELSE "danger" END) as OCT'),
                DB::raw('MAX(CASE WHEN salaries.month = 11 THEN "success" ELSE "danger" END) as NOV'),
                DB::raw('MAX(CASE WHEN salaries.month = 12 THEN "success" ELSE "danger" END) as `DEC`')
            )
            ->orderBy('salaries.year')
            ->groupBy('users.id', 'users.name', 'users.phone', 'salaries.year', 'division_name', 'district_name')
            ->fastPaginate();

        return view('livewire.jal-mitra.salaries', [
            'results' => $results,
        ]);
    }
}
