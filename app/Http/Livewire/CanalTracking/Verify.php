<?php

namespace App\Http\Livewire\CanalTracking;

use App\Models\SchemePipeNetwork;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Verify extends Component
{
    use InteractsWithBanner;

    public $network;
    public $comment;
    public $showVerificationButton = false;

    public function mount(SchemePipeNetwork $network)
    {
        $user = auth()->user();
        $this->network = $network->loadMissing('verifiedBy:id,name,role');

        if (($user->isSdo() || $user->isAdministrator()) && ($this->network->verification_status == 'Pending')) {
            $this->showVerificationButton = true;
        }
    }

    public function verify()
    {
        $validated = $this->validate([
            'comment' => ['required'],
        ]);

        $this->network->update($validated + [
            'verification_status' => SchemePipeNetwork::STATUS_ACCEPT,
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        $this->banner('Scheme Pipe Network Accepted.');
        return redirect()->route('schemes.show', [$this->network->scheme_id, 'tab' => 'pipe-network']);
    }

    public function reject()
    {
        $validated = $this->validate([
            'comment' => ['required'],
        ]);

        $this->network->update($validated + [
            'verification_status' => SchemePipeNetwork::STATUS_REJECT,
            'verified_by' => Auth::id(),
            'verified_at' => now(),
        ]);

        $this->banner('Scheme Pipe Network Rejected.', 'danger');
        return redirect()->route('schemes.show', [$this->network->scheme_id, 'tab' => 'pipe-network']);
    }

    public function render()
    {
        return view('livewire.canal-tracking.verify', [
            'locations' => json_decode(file_get_contents($this->network->file_url), true) ?? null,
        ]);
    }
}
