<?php

namespace App\Http\Livewire\PerformanceGuarantees;

use App\Enums\WorkorderStatus;
use App\Models\User;
use App\Models\Circle;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PerformanceGuarantee;
use App\Models\Workorder;
use App\Traits\InteractsWithBanner;

class Withdraw extends Component
{   
    use WithFileUploads;
    use InteractsWithBanner;

    public $pgId;
    public $workorderId;
    public $office;
    public $letterNumber;
    public $withdrawDate;
    public $receivedBy;
    public $nocCopy;

    public function mount(PerformanceGuarantee $pg)
    {
        $this->pgId = $pg->id;
        $this->workorderId = $pg->workorder_id;
    }

    public function save()
    {
        $validated = $this->validate([
            'office' => ['required'],
            'letterNumber' => ['required'],
            'withdrawDate' => ['required', 'date'],
            'receivedBy' => ['required'],
            'nocCopy' => ['required', 'image', 'max:2048']
        ]);

        $this->performanceGuarantee->update([
            'circle_id' => $validated['office'],
            'receiver_details' => $validated['receivedBy'],
            'withdrawn_at' => $validated['withdrawDate'],
            'letter_number' => $validated['letterNumber']
        ]);

        if ($this->nocCopy) {
            $this->performanceGuarantee->update([
                'withdraw_certificate' => $this->nocCopy->storePublicly('/', 'uploads')
            ]);
        }

        $this->banner('PG withdrawn.');

        return redirect()->route('workorders.show', $this->workorderId);
    }

    public function getPerformanceGuaranteeProperty()
    {
        return PerformanceGuarantee::findOrFail($this->pgId);
    }

    public function getOfficesProperty()
    {
        return Circle::orderBy('name')->pluck('name', 'id');
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
        return view('livewire.performance-guarantees.withdraw');
    }
}
