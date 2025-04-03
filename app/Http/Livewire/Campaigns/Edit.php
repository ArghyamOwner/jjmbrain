<?php

namespace App\Http\Livewire\Campaigns;

use App\Models\Campaign;
use App\Traits\InteractsWithBanner;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    use InteractsWithBanner;

    public $campaignId;
    public $name;
    public $status;

    public function mount(Campaign $campaign)
    {
        $this->campaignId = $campaign->id;
        $this->name = $campaign->name;
        $this->status = $campaign->status;
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => ['required'],
            'status' => ['required', Rule::in([Campaign::STATUS_ACTIVE, Campaign::STATUS_INACTIVE])],
        ]);

        if ($validated['status'] == Campaign::STATUS_ACTIVE) {
            $active = Campaign::where('status', Campaign::STATUS_ACTIVE)->get();
            if ($active->count()) {
                $active->toQuery()->update([
                    'status' => Campaign::STATUS_INACTIVE,
                ]);
            }
        }

        $this->campaign->update([
            'name' => $validated['name'],
            'status' => $validated['status'],
        ]);

        $this->banner('Campaign updated.');

        return redirect()->route('campaigns.show', $this->campaignId);
    }

    public function getCampaignProperty()
    {
        return Campaign::findOrFail($this->campaignId);
    }

    public function render()
    {
        return view('livewire.campaigns.edit', [
            'statuses' => Campaign::getStatusOptions(),
        ]);
    }
}
