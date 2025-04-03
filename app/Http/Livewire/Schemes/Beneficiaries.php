<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Beneficiary;
use App\Models\Scheme;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;
use Livewire\Component;
use Livewire\WithPagination;

class Beneficiaries extends Component
{
    use WithExportToCsv;
    use WithPagination;
    use InteractsWithBanner;

    public $schemeId;
    public $search;
    public $showDeleteButton = false;
    public $showDeleteAllButton = false;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function resetFilter()
    {
        $this->reset(['search']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function export()
    {
        $scheme = Scheme::select('id', 'name', 'old_scheme_id', 'imis_id')->findOrFail($this->schemeId);
        $data = Beneficiary::query()
            ->where('scheme_id', $this->schemeId)
            ->orderBy('beneficiary_name')
            ->lazy();

        $data = $data->map(fn($data) => [
            'Scheme' => $scheme->name,
            'SMT_ID' => $scheme->old_scheme_id,
            'IMIS_ID' => $scheme->imis_id,
            'Name' => $data->beneficiary_name,
            'Phone' => $data->beneficiary_phone,
            'FHTC_Number' => $data->fhtc_number,
            'Voter_No' => $data->beneficiary_voter_number ?? '-',
            'Aadhaar_No' => $data->beneficiary_aadhaar ?? '-',
        ])->toArray();

        if (count($data)) {
            return $this->exportToCsv($data, 'beneficiaries_'.$scheme->name . '.csv');
        } else {
            $this->notify('Data not found', 'error');
            return redirect()->back();
        }

    }

    public function render()
    {
        if(auth()->user()->isAdministrator()){
            $this->showDeleteAllButton = true;
        }
        if(auth()->user()->isSdo() || auth()->user()->isSectionOfficer() || auth()->user()->isAdministrator()){
            $this->showDeleteButton = true;
        }
        return view('livewire.schemes.beneficiaries', [
            'beneficiaries' => Beneficiary::query()
                ->where('scheme_id', $this->schemeId)
                ->when($this->search != '', fn($query) => $query->whereLike(['beneficiary_name', 'beneficiary_phone'], $this->search))
                ->latest('id')
                ->fastPaginate(),
        ]);
    }
}
