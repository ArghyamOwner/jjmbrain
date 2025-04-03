<?php

namespace App\Http\Livewire\Workorders;

use App\Models\User;
use App\Models\Zone;
use App\Models\Circle;
use Livewire\Component;
use App\Models\Division;
use App\Models\Workorder;
use App\Enums\TaskCategory;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Traits\InteractsWithBanner;

class Edit extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $workorderId;
    public $issuingAuthority;
    public $fundingAgency;
    public $contractor;
    public $workorderType;
    public $workorderName;
    public $workorderNumber;
    public $workorderDate;
    public $workorderAmount = 0;
    public $remarks;
    public $aaNumber;
    public $tsNumber;
    public $document;
    public $office;

    public function mount(Workorder $workorder)
    {
        $this->workorderId = $workorder->id;

        $this->issuingAuthority = $workorder->issuing_authority;
        $this->fundingAgency = $workorder->workorder_funding_agency;
        $this->contractor = $workorder->contractor_id;
        $this->workorderType = $workorder->workorder_type;
        $this->workorderName = $workorder->workorder_name;
        $this->workorderNumber = $workorder->workorder_number;
        $this->workorderDate = $workorder->workorder_estimated_date?->format('Y-m-d');
        $this->workorderAmount = $workorder->workorder_amount;
        $this->remarks = $workorder->remarks;
        $this->aaNumber = $workorder->aa_number;
        $this->tsNumber = $workorder->ts_number;
        $this->document = $workorder->document;
        $this->office = $workorder->circle_id;
    }

    public function save()
    {
        $validated = $this->validate([
            'issuingAuthority' => ['required', Rule::in(collect($this->issuingAuthorities)->pluck('value')->all())],
            'office' => ['required'],
            'contractor' => ['required', Rule::exists('users', 'id')->where('role', 'contractor')],
            'fundingAgency' => ['required'],
            'workorderType' => ['required'],
            'workorderName' => ['required'],
            'workorderNumber' => ['required'],
            'workorderDate' => ['required'],
            'workorderAmount' => ['required'],
            'aaNumber' => ['required'],
            'tsNumber' => ['required'],
            'remarks' => ['nullable'],
            'document' => ['nullable'],
        ]);

        $workorderAmount = str_replace(',', '', $validated['workorderAmount']);

        $this->workorder->update([
            'contractor_id' => $validated['contractor'],
            'circle_id' => $validated['office'],
            'workorder_number' => $validated['workorderNumber'],
            'workorder_funding_agency' => $validated['fundingAgency'],
            'workorder_amount' => $workorderAmount,
            'workorder_type' => $validated['workorderType'],    
            'workorder_estimated_date' => $validated['workorderDate'],
            'remarks' => $validated['remarks'],
            'aa_number' => $validated['aaNumber'],
            'ts_number' => $validated['tsNumber'],
        ]);

        $this->banner('Workorder updated.');

        return redirect()->route('workorders.show', $this->workorderId);
    }

    public function getWorkorderProperty()
    {
        return Workorder::findOrFail($this->workorderId);
    }

    public function getCategoriesProperty()
    {
        return TaskCategory::cases();
    }

    public function getOfficesProperty()
    {
        return Circle::orderBy('name')->pluck('name', 'id');
    }

    public function getIssuingAuthoritiesProperty()
    {
        // $offices = Circle::orderBy('name')->pluck('name')->all();
        // $data = ['Head Office'] + collect(Zone::pluck('name'))->merge($offices)->all();

        // $result = $data + collect(Division::orderBy('name', 'asc')->pluck('name'))->all();

        // return collect($result)->filter(fn($item) => 
        //     $item !== "BTAD Circle" && $item !== "Dima Hasao Circle" && $item !== "KAAC Circle"
        // )->values()->all();
        if (auth()->user()->isAddChiefEngineer()) {
            $result = auth()->user()->offices()->orderBy('name')->pluck('name')->all();
        } elseif (auth()->user()->isSuperintendentEngineer()) {
            $result = Zone::pluck('name')->all();
        } elseif (auth()->user()->isExecutiveEngineer()) {
            $result = auth()->user()->divisions()->orderBy('name', 'asc')->pluck('name')->all();
        } else {
            $offices = Circle::orderBy('name')->pluck('name')->all();
            $zones = array_merge($offices, collect(Zone::pluck('name'))->all());
            $div = array_merge($zones, collect(Division::orderBy('name', 'asc')->pluck('name'))->all());
            $result = array_merge(['Head Office'], $div);
        }
        return collect($result)->map(fn($item) => [
            "label" => $item,
            "value" => $item,
        ])->all();
    }

    public function getContractorUsersProperty()
    {
        return User::where('role', 'contractor')
            ->get()
            ->map(fn($item) => [
                "label" => $item->name,
                "value" => $item->id
            ])->all();
    }

    public function render()
    {
        return view('livewire.workorders.edit');
    }
}
