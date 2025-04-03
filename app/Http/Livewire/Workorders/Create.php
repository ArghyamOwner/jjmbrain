<?php

namespace App\Http\Livewire\Workorders;

use App\Enums\TaskCategory;
use App\Models\Circle;
use App\Models\Division;
use App\Models\User;
use App\Models\Workorder;
use App\Models\Zone;
use App\Traits\InteractsWithBanner;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $issuingAuthority;
    // public $fundingAgency;
    public $contractor;
    public $workorderType;
    // public $workorderName;
    public $workorderNumber;
    public $formal_workorder_number;
    public $workorderDate;
    public $workorderAmount = 0;
    public $remarks;
    public $aaNumber;
    public $tsNumber;
    public $document;
    // public $office;
    public $division_id;

    public function save()
    {
        $validated = $this->validate([
            'issuingAuthority' => ['required'],
            // 'office' => ['required'],
            'division_id' => ['required'],
            'contractor' => ['required', Rule::exists('users', 'id')->where('role', 'contractor')],
            // 'fundingAgency' => ['required'],
            'workorderType' => ['required'],
            // 'workorderName' => ['required'],
            'workorderNumber' => ['required'],
            'formal_workorder_number' => ['nullable'],
            'workorderDate' => ['required'],
            'workorderAmount' => ['required'],
            'aaNumber' => ['nullable'],
            'tsNumber' => ['nullable', 'required_with:formal_workorder_number'],
            'remarks' => ['nullable'],
            'document' => ['nullable'],
        ], [], [
            'formal_workorder_number' => 'Workorder Number',
            'workorderNumber' => 'Preliminary Workorder Number',
        ]);

        $workorderAmount = str_replace(',', '', $validated['workorderAmount']);

        Workorder::create([
            'issuing_authority' => $validated['issuingAuthority'],
            'contractor_id' => $validated['contractor'],
            'division_id' => $validated['division_id'],
            // 'circle_id' => $validated['office'],
            'workorder_number' => $validated['workorderNumber'],
            'formal_workorder_number' => $validated['formal_workorder_number'],
            // 'workorder_funding_agency' => $validated['fundingAgency'],
            'workorder_amount' => $workorderAmount,
            'workorder_type' => $validated['workorderType'],
            'workorder_estimated_date' => $validated['workorderDate'],
            'remarks' => $validated['remarks'],
            'aa_number' => $validated['aaNumber'],
            'ts_number' => $validated['tsNumber'],
        ]);

        $this->banner('Workorder created.');
        return redirect()->route('workorders');
    }

    public function getCategoriesProperty()
    {
        return TaskCategory::cases();
    }

    // public function getOfficesProperty()
    // {
    //     return Circle::orderBy('name')->pluck('name', 'id');
    // }

    public function getIssuingAuthoritiesProperty()
    {
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

    public function getDivisionsProperty()
    {
        $result = Division::orderBy('name', 'asc')->get();

        return collect($result)->map(fn($item) => [
            "label" => $item->name,
            "value" => $item->id,
        ])->all();
    }

    public function getContractorUsersProperty()
    {
        return User::where('role', 'contractor')
            ->with('contractor:id,user_id,bid_no')
            ->get()
            ->map(fn($item) => [
                "label" => $item->name . " (" . ($item->contractor?->bid_no ?? 'N/A') . ")",
                "value" => $item->id,
            ])->all();
    }

    public function render()
    {
        return view('livewire.workorders.create');
    }
}
