<?php

namespace App\Http\Livewire\Lithologs;

use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SdoVerification extends Component
{
    use InteractsWithBanner;
    
    public $verification_status;
    public $litholog;

    public function mount($litholog)
    {
        $this->litholog = $litholog;
    }

    public function save()
    {
        $validate = $this->validate([
            'verification_status' => ['required']
        ]);

        $this->litholog->update([
            'verification_status' => $validate['verification_status'],
            'verified_by' => Auth::id()
        ]);

        $this->banner('Verification done successfully.');
        return redirect()->route('lithologs.show', $this->litholog->id);
    }

    public function render()
    {
        return view('livewire.lithologs.sdo-verification',[
            'statuses' => [
                'Accept',
                'Reject'
            ]
        ]);
    }
}
