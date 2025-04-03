<?php

namespace App\Http\Livewire\Campaigns;

use App\Models\Campaign;
use App\Traits\InteractsWithBanner;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    use InteractsWithBanner;

    public $role;
    public $name;
    public $status;

    public function save()
    {
        $validated = $this->validate([
            'name' => ['required'],
            'role' => ['required'],
            'status' => ['required', Rule::in([Campaign::STATUS_ACTIVE, Campaign::STATUS_INACTIVE])],
        ], [], [
            'role' => 'Actor',
        ]);

        if ($validated['status'] == Campaign::STATUS_ACTIVE) {
            $active = Campaign::where('status', Campaign::STATUS_ACTIVE)->get();
            if ($active->count()) {
                $active->toQuery()->update([
                    'status' => Campaign::STATUS_INACTIVE,
                ]);
            }
        }

        Campaign::create([
            'name' => $validated['name'],
            'role' => $validated['role'],
            'status' => $validated['status'],
        ]);

        $this->banner('New campaign created.');
        return redirect()->route('campaigns');
    }

    public function getRolesProperty()
    {
        return collect(config('freshman.roles'))->filter(function ($item, $key) {
            return $key != 'admin' && $key != 'super-admin';
        });
    }

    public function render()
    {
        return view('livewire.campaigns.create', [
            'statuses' => Campaign::getStatusOptions(),
        ]);
    }
}
