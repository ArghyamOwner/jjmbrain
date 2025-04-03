<?php

namespace App\Http\Livewire\PerformanceGuarantees;

use App\Enums\PerformanceGuaranteeType;
use App\Models\Bank;
use App\Models\Division;
use App\Models\PerformanceGuarantee;
use App\Models\User;
use App\Models\Workorder;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    // public $workorderId;
    public $pgAmount;
    public $pgType;
    public $pledgedInfavourOf;
    public $pgDate;
    public $pgExpiryDate;
    public $pgNumber;
    public $bankName;
    public $bankBranch;
    public $pgBankCopyDocument;
    public $contractor_name;
    public $contractor_id;
    // public $account_no;
    public $workorder_ids = [];
    public $contractorWos = [];
    public $amountLabel;

    // public function mount(Workorder $workorder)
    // {
    //     $this->workorderId = $workorder->id;
    // }

    public function save()
    {
        $validated = $this->validate([
            'pgAmount' => ['required'],
            'pgType' => ['required', new Enum(PerformanceGuaranteeType::class)],
            'pledgedInfavourOf' => ['required'],
            'pgDate' => ['required', 'date'],
            'pgExpiryDate' => ['required', 'date'],
            'pgNumber' => ['required'],
            'pgBankCopyDocument' => ['required'],
            'bankName' => ['required'],
            'bankBranch' => ['required'],
            // 'account_no' => ['required'],
            // 'contractor_id' => ['required_without:contractor_name'],
            // 'contractor_name' => ['required_without:contractor_id'],
            'contractor_id' => ['required'],
            'workorder_ids' => ['required'],
        ], [], [
            'pgDate' => "PG Issue Date",
        ]);

        $pgAmount = str_replace(',', '', $validated['pgAmount']);

        try {
            return DB::transaction(function () use ($validated, $pgAmount) {
                $role = match (auth()->user()->role) {
                    'superitendent-engineer' => 'Superintendent Engineer',
                    'executive-engineer' => 'Executive Engineer',
                    'add-chief-engineer' => "Add. Chief Engineer",
                    // 'head-office' => 'Chief Engineer',
                    default => ''
                };

                $pg = PerformanceGuarantee::create([
                    'pg_amount' => $pgAmount,
                    'pg_type' => $validated['pgType'],
                    'pg_number' => $validated['pgNumber'],
                    'pg_date' => $validated['pgDate'],
                    'expired_date' => $validated['pgExpiryDate'],
                    'bank_name' => $validated['bankName'],
                    'bank_branch' => $validated['bankBranch'],
                    // 'account_no' => $validated['account_no'],
                    'pledged_infavour_of' => "Pledged in favour of $role " . $validated['pledgedInfavourOf'] . ", PHED",
                    'contractor_id' => $validated['contractor_id'],
                    // 'contractor_name' => $validated['contractor_name'],
                ]);

                // $this->workorder->calculateWorkorderValue();

                $pg->workorders()->sync($validated['workorder_ids']);

                if ($this->pgBankCopyDocument) {
                    $pg->update([
                        'pg_copy' => $this->pgBankCopyDocument->storePublicly('/', 'uploads'),
                    ]);
                }

                $this->banner('PG added.');

                return redirect()->route('pg.dashboard');
            });
        } catch (\Exception $e) {
            $this->notify('Something went wrong. Try again.', 'error');
        }
    }

    public function updatedContractorId()
    {
        $this->contractorWos = Workorder::query()
            ->select('id', 'workorder_number')
            ->where('contractor_id', $this->contractor_id)
            ->get()
            ->map(fn($item) => [
                "label" => $item->workorder_number,
                "value" => $item->id,
            ])->all();
    }

    // public function save()
    // {
    //     $validated = $this->validate([
    //         'pgAmount' => ['required'],
    //         'pgType' => ['required', new Enum(PerformanceGuaranteeType::class)],
    //         'pledgedInfavourOf' => ['required'],
    //         'pgDate' => ['required', 'date'],
    //         'pgExpiryDate' => ['required', 'date'],
    //         'pgNumber' => ['required'],
    //         'pgBankCopyDocument' => ['required'],
    //         'bankName' => ['required'],
    //         'bankBranch' => ['required'],
    //     ]);

    //     $pgAmount = str_replace(',', '', $validated['pgAmount']);

    //     try {
    //         return DB::transaction(function () use ($validated, $pgAmount) {
    //             $pg = $this->workorder->performanceGuarantees()->create([
    //                 'pg_amount' => $pgAmount,
    //                 'pg_type' => $validated['pgType'],
    //                 'pg_number' => $validated['pgNumber'],
    //                 'pg_date' => $validated['pgDate'],
    //                 'expired_date' => $validated['pgExpiryDate'],
    //                 'bank_name' => $validated['bankName'],
    //                 'bank_branch' => $validated['bankBranch'],
    //                 'pledged_infavour_of' => $validated['pledgedInfavourOf']
    //             ]);

    //             $this->workorder->calculateWorkorderValue();

    //             if ($this->pgBankCopyDocument) {
    //                 $pg->update([
    //                     'pg_copy' => $this->pgBankCopyDocument->storePublicly('/', 'uploads'),
    //                 ]);
    //             }

    //             $this->banner('PG added.');

    //             return redirect()->route('workorders.show', $this->workorderId);
    //         });
    //     } catch (\Exception $e) {
    //         $this->notify('Something went wrong. Try again.', 'error');
    //     }
    // }

    // public function getWorkorderProperty()
    // {
    //     return Workorder::findOrFail($this->workorderId);
    // }

    public function updatedWorkorderIds()
    {
        $amount = Workorder::whereIn('id', $this->workorder_ids)->sum('workorder_amount');
        $this->amountLabel = "Workorder Amount : " . Str::money($amount ? $amount : 0) . ", Suggested PG Amount : " . Str::money($amount ? $amount * 0.05 : 0);
    }

    // public function save()
    // {
    //     $validated = $this->validate([
    //         'pgAmount' => ['required'],
    //         'pgType' => ['required', new Enum(PerformanceGuaranteeType::class)],
    //         'pledgedInfavourOf' => ['required'],
    //         'pgDate' => ['required', 'date'],
    //         'pgExpiryDate' => ['required', 'date'],
    //         'pgNumber' => ['required'],
    //         'pgBankCopyDocument' => ['required'],
    //         'bankName' => ['required'],
    //         'bankBranch' => ['required'],
    //     ]);

    //     $pgAmount = str_replace(',', '', $validated['pgAmount']);

    //     try {
    //         return DB::transaction(function () use ($validated, $pgAmount) {
    //             $pg = $this->workorder->performanceGuarantees()->create([
    //                 'pg_amount' => $pgAmount,
    //                 'pg_type' => $validated['pgType'],
    //                 'pg_number' => $validated['pgNumber'],
    //                 'pg_date' => $validated['pgDate'],
    //                 'expired_date' => $validated['pgExpiryDate'],
    //                 'bank_name' => $validated['bankName'],
    //                 'account_no' => $validated['bankBranch'],
    //                 'pledged_infavour_of' => $validated['pledgedInfavourOf']
    //             ]);

    //             $this->workorder->calculateWorkorderValue();

    //             if ($this->pgBankCopyDocument) {
    //                 $pg->update([
    //                     'pg_copy' => $this->pgBankCopyDocument->storePublicly('/', 'uploads'),
    //                 ]);
    //             }

    //             $this->banner('PG added.');

    //             return redirect()->route('workorders.show', $this->workorderId);
    //         });
    //     } catch (\Exception $e) {
    //         $this->notify('Something went wrong. Try again.', 'error');
    //     }
    // }

    // public function getWorkorderProperty()
    // {
    //     return Workorder::findOrFail($this->workorderId);
    // }

    public function getPgTypesProperty()
    {
        return PerformanceGuaranteeType::cases();
    }

    public function getBanksProperty()
    {
        return Bank::pluck('name', 'id')->all();
    }

    public function getPledgedInfavourOfOptionsProperty()
    {
        if (auth()->user()->isAddChiefEngineer()) {
            // $result = auth()->user()->offices()->orderBy('name')->pluck('name')->all();
            $result = auth()->user()->offices()->with('zone')->get()->pluck('zone.name')->all();
        } elseif (auth()->user()->isSuperintendentEngineer()) {
            $result = auth()->user()->offices()->orderBy('name')->pluck('name')->all();
        } elseif (auth()->user()->isExecutiveEngineer()) {
            $result = auth()->user()->divisions()->orderBy('name', 'asc')->pluck('name')->all();
        } elseif (auth()->user()->isHeadOffice()) {
            $result = "Chief Engineer";
        } else {
            $result = Division::orderBy('name', 'asc')->pluck('name')->all();
        }
        return collect($result)->map(fn($item) => [
            "label" => $item,
            "value" => $item,
        ])->all();
    }

    public function getContractorsProperty()
    {
        return User::where('role', 'contractor')
            ->with('contractor:id,user_id,bid_no')
            ->orderBy('name')
            ->get()
            ->map(fn($item) => [
                "label" => $item->name . " (" . ($item->contractor?->bid_no ?? 'N/A') . ")",
                "value" => $item->id,
            ])->all();
    }

    public function render()
    {
        return view('livewire.performance-guarantees.create');
    }
}
