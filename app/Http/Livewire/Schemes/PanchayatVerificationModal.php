<?php

namespace App\Http\Livewire\Schemes;

use App\Models\SchemePanchayatVerification;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class PanchayatVerificationModal extends Component
{
    use InteractsWithBanner;
    public $scheme;

    public function mount($scheme)
    {
        $this->scheme = $scheme;
    }

    public function verify()
    {
        SchemePanchayatVerification::updateOrCreate([
            'scheme_id' => $this->scheme->id,
        ], [
            'verified_at' => now(),
            'verified_by' => Auth::id(),
        ]);
        $this->banner('Scheme Handedover Verified.');
        return redirect()->route('schemes.show', [$this->scheme->id, 'tab' => 'details']);
    }

    public function reject()
    {
        SchemePanchayatVerification::updateOrCreate([
            'scheme_id' => $this->scheme->id,
        ], [
            'rejected_by' => Auth::id(),
            'rejected_on' => now(),
        ]);

        $this->banner('Scheme Marked Improper.', 'danger');
        return redirect()->route('schemes.show', [$this->scheme->id, 'tab' => 'details']);
    }

    public function render()
    {
        return view('livewire.schemes.panchayat-verification-modal');
    }
}
