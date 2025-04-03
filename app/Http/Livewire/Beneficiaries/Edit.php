<?php

namespace App\Http\Livewire\Beneficiaries;

use Livewire\Component;
use App\Rules\VoterIdRule;
use App\Models\Beneficiary;
use Livewire\WithFileUploads;
use App\Rules\PhoneNumberRule;

class Edit extends Component
{
    use WithFileUploads;

    public $beneficiaryId;
    public $schemeId;
    public $beneficiaryPhotoUrl;

    public $name;
    public $beneficiaryPhoto;
    public $voterId;
    public $aadhaarNumber;
    public $phone;
    public $fhtcNumber;
    public $imisId;

    public function mount(Beneficiary $beneficiary)
    {
        $this->beneficiaryId = $beneficiary->id;
        $this->schemeId = $beneficiary->scheme_id;
        $this->beneficiaryPhotoUrl = $beneficiary->beneficiary_photo_url; 
        $this->name = $beneficiary->beneficiary_name;
        $this->voterId = $beneficiary->beneficiary_voter_number;
        $this->aadhaarNumber = $beneficiary->beneficiary_aadhaar;
        $this->phone = $beneficiary->beneficiary_phone;
        $this->fhtcNumber = $beneficiary->fhtc_number;
        $this->imisId = $beneficiary->imis_id;
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

        $this->beneficiary->update([
            'beneficiary_name' => $validated['name'],
            'beneficiary_phone' => $validated['phone'],
            'beneficiary_voter_number' => $validated['voterId'],
            'beneficiary_aadhaar' => $validated['aadhaarNumber'],
            'fhtc_number' => $validated['fhtcNumber'],
            'imis_id' => $validated['imisId'],
        ]);

        if ($this->beneficiaryPhoto) {
            $this->beneficiary->update([
                'beneficiaryPhoto' => $this->beneficiaryPhoto->storePublicly('/', 'uploads')
            ]);
        }

        $beneficiary = $this->beneficiary->refresh();

        $this->beneficiaryPhotoUrl = $beneficiary->beneficiary_photo_url; 
        $this->name = $beneficiary->beneficiary_name;
        $this->voterId = $beneficiary->beneficiary_voter_number;
        $this->aadhaarNumber = $beneficiary->beneficiary_aadhaar;
        $this->phone = $beneficiary->beneficiary_phone;
        $this->fhtcNumber = $beneficiary->fhtc_number;
        $this->imisId = $beneficiary->imis_id;

        $this->notify('Beneficiary details updated.');
    }


    public function getBeneficiaryProperty()
    {
        return Beneficiary::findOrFail($this->beneficiaryId);
    }

    public function render()
    {
        return view('livewire.beneficiaries.edit');
    }
}
