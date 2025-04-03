<?php

namespace App\Http\Livewire\Beneficiaries;

use App\Models\Scheme;
use Livewire\Component;
use App\Rules\VoterIdRule;
use App\Models\Beneficiary;
use Livewire\WithFileUploads;
use App\Rules\PhoneNumberRule;
use App\Traits\InteractsWithBanner;

class Create extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $schemeId;
    
    public $name;
    public $beneficiaryPhoto;
    public $voterId;
    public $aadhaarNumber;
    public $phone;
    public $fhtcNumber;
    public $imisId;

    public function mount(Scheme $scheme)
    {
        $this->schemeId = $scheme->id;
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => ['required'],
            'beneficiaryPhoto' => ['nullable', 'image', 'max:2048'],
            'voterId' => ['required', new VoterIdRule()],
            'aadhaarNumber' => ['required', 'digits:12'],
            'phone' => ['required', new PhoneNumberRule()],
            'fhtcNumber' => ['required'],
            'imisId' => ['required'],
        ]);

        $beneficiary = Beneficiary::create([
            'scheme_id' => $this->schemeId,
            'beneficiary_name' => $validated['name'],
            'beneficiary_phone' => $validated['phone'],
            'beneficiary_voter_number' => $validated['voterId'],
            'beneficiary_aadhaar' => $validated['aadhaarNumber'],
            'fhtc_number' => $validated['fhtcNumber'],
            'imis_id' => $validated['imisId'],
        ]);

        if ($this->beneficiaryPhoto) {
            $beneficiary->update([
                'beneficiaryPhoto' => $this->beneficiaryPhoto->storePublicly('/', 'uploads')
            ]);
        }

        $this->banner('New beneficiary saved.');

        return redirect()->route('schemes.show', [$this->schemeId, 'tab' => 'beneficiary']);
    }

    public function render()
    {
        return view('livewire.beneficiaries.create');
    }
}
