<?php

namespace App\Http\Livewire\PerformanceGuarantees;

use App\Models\PerformanceGuarantee;
use Livewire\Component;

class Show extends Component
{
    public $pg;
    public $pgId;
    // public $workorderId;
    public $type;
    public $bankName;
    public $bankBranch;
    public $account_no;
    public $pgNumber;
    public $pgAmount;
    public $pgDate;
    // public $workorderNumber;
    public $inFavour;
    public $office;
    public $expiryDate;
    public $pgCopy;
    public $contractor;

    public function mount(PerformanceGuarantee $pg)
    {
        $this->pg = $pg->loadMissing(['workorders.contractor.contractor']);

        $this->pgId = $pg->id;
        // $this->workorderId = $pg->workorder?->id;
        $this->type = $pg->pg_type;
        $this->inFavour = $pg->pledged_infavour_of;
        $this->pgNumber = $pg->pg_number;
        $this->pgAmount = $pg->pg_amount;
        $this->pgDate = $pg->pg_date;
        $this->expiryDate = $pg->expired_date;
        $this->pgCopy = $pg->pg_photo_url;
        $this->bankName = $pg->bank_name;
        $this->bankBranch = $pg->bank_branch;
        $this->account_no = $pg->account_no ?? '-';
        if ($pg?->contractor) {
            $this->contractor = $pg->contractor?->name . ' (' . $pg->contractor?->contractor?->bid_no . ')';
        } else {
            $this->contractor = $pg->contractor_name ?? '-';
        }
        // $this->workorderNumber = $pg->workorder->workorder_number;
    }

    public function render()
    {
        return view('livewire.performance-guarantees.show');
    }
}
