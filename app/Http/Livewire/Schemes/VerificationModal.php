<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Scheme;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VerificationModal extends Component
{
    use InteractsWithBanner;
    public $scheme;
    public $showModalButton = false;

    public function mount($scheme)
    {
        $this->scheme = Scheme::withExists([
            'workorders', 'villages', 'blocks', 'habitations', 
            'panchayats', 'district', 'division', 'lac'
        ])->findOrFail($scheme);

        $imisSmtIdCheck = true;
        if($this->scheme->old_scheme_id == $this->scheme->imis_id){
            $imisSmtIdCheck = false;
        }

        if ($this->scheme->workorders_exists && $this->scheme->villages_exists &&
            $this->scheme->blocks_exists && $this->scheme->habitations_exists &&
            $this->scheme->panchayats_exists && $this->scheme->district_exists &&
            $this->scheme->lac_exists && $imisSmtIdCheck &&
            $this->scheme->financial_year_id && $this->scheme->slssc_year) {
            $this->showModalButton = true;
        }
    }


    private function checkSchemeStatus($scheme)
    {
        $schemeData = Scheme::withExists([
            'workorders', 'villages', 'blocks', 'habitations', 
            'panchayats', 'district', 'division', 'lac'
        ])->findOrFail($scheme);

        $imisSmtIdCheck = true;
        if($schemeData->old_scheme_id == $schemeData->imis_id){
            $imisSmtIdCheck = false;
        }

        if ($schemeData->workorders_exists && $schemeData->villages_exists &&
            $schemeData->blocks_exists && $schemeData->habitations_exists &&
            $schemeData->panchayats_exists && $schemeData->district_exists &&
            $schemeData->lac_exists && $imisSmtIdCheck &&
            $schemeData->financial_year_id && $schemeData->slssc_year) {
            return true;
        }
        return false;
    }


    public function verify()
    {
        $status = $this->checkSchemeStatus($this->scheme->id);
        if(! $status){
            return $this->notify('Please Check Scheme Data', 'error');
        }

        $this->scheme->update([
            'verified_by' => Auth::id(),
            'verified_on' => now(),
        ]);

        Scheme::where('parent_id', $this->scheme->id)->update([
            'verified_by' => Auth::id(),
            'verified_on' => now(),
            'imis_id' => $this->scheme->imis_id
        ]);

        $this->scheme->schemeActivity()->create([
            'user_id' => auth()->id(),
            'scheme_id' => $this->scheme->id,
            'activity_type' => 'scheme_verified',
            'content' => 'Scheme Verified',
        ]);

        $this->banner('Scheme Verified.');
        return redirect()->route('schemes.show', [$this->scheme->id, 'tab' => 'details']);
    }

    // public function reject()
    // {
    //     $this->scheme->update([
    //         'rejected_by' => Auth::id(),
    //         'rejected_on' => now(),
    //     ]);

    //     $this->banner('Scheme Marked Improper.', 'danger');
    //     return redirect()->route('schemes.show', [$this->scheme->id, 'tab' => 'details']);
    // }

    public function render()
    {
        return view('livewire.schemes.verification-modal');
    }
}
