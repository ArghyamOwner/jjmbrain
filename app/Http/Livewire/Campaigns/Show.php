<?php

namespace App\Http\Livewire\Campaigns;

use App\Models\Campaign;
use Livewire\Component;

class Show extends Component
{
    public $name;
    public $statusName;
    public $campaignId;

    public function mount(Campaign $campaign)
    {
        $this->campaignId = $campaign->id;
        $this->name = $campaign->name;
        $this->statusName = $campaign->status_name;
    }

    public function render()
    {
        return view('livewire.campaigns.show',[
            'noOfQuestions' => 20
        ]);
    }
}
