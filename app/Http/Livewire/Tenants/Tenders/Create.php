<?php

namespace App\Http\Livewire\Tenants\Tenders;

use App\Models\Tender;
use Livewire\Component;
use App\Traits\InteractsWithBanner;

class Create extends Component
{
    use InteractsWithBanner;

    public $name;
    public $tender_no;
    public $due_date;
    public $publish_date;
    // public $prebid_meeting;
    // public $bid_submission;
    // public $unpriced_bid_opening;

    public function save()
    {
        $validatedData =  $this->validate([
            'name' => ['required'],
            'tender_no' => ['required'],
            'due_date' => ['date:Y-m-d'],
            'publish_date' => ['date:Y-m-d'],
            // 'prebid_meeting' => ['nullable'],
            // 'bid_submission' => ['nullable'],
            // 'unpriced_bid_opening' => ['nullable'],
        ]);

        Tender::create($validatedData);

        $this->banner('Tender created');

        return redirect()->route('tenant.tenders.all');
    }
    
    public function render()
    {
        return view('livewire.tenants.tenders.create');
    }
}
