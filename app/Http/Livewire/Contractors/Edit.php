<?php

namespace App\Http\Livewire\Contractors;

use Livewire\Component;
use App\Enums\ContractorTypes;
use Illuminate\Validation\Rule;
use App\Models\ContractorDetail;
use Illuminate\Support\Facades\DB;
use App\Enums\ContractorEntityTypes;
use Illuminate\Validation\Rules\Enum;

class Edit extends Component
{
    public $contractorId;
    public $contractorUserId;
    
    public $entity_name;
    public $business_type;
    public $contractor_type;
    
    public $name;
    public $gst;
    public $pan;
    public $phone;
    public $email;
    public $address;
    public $bank_name;
    public $branch_name;
    public $account_number;
    public $ifsc_code;
    public $registration_number;

    public function mount(ContractorDetail $contractor)
    {
        $contractor->loadMissing('user');

        $this->contractorId = $contractor->id;
        $this->contractorUserId = $contractor->user->id;

        $this->entity_name = $contractor->entity_name;
        $this->business_type = $contractor->business_type;
        $this->contractor_type = $contractor->contractor_type;

        $this->name = $contractor->user->name;
        $this->phone = $contractor->user->phone;
        $this->email = $contractor->user->email;
        $this->gst = $contractor->gst;
        $this->pan = $contractor->pan;
        $this->address = $contractor->address;
        $this->bank_name = $contractor->bank_name;
        $this->branch_name = $contractor->branch_name;
        $this->account_number = $contractor->account_number;
        $this->ifsc_code = $contractor->ifsc_code;
        $this->registration_number = $contractor->registration_number;
    }

    public function save()
    {
        $validated = $this->validate([
            'entity_name' => ['required'],
            'business_type' => ['required', new Enum(ContractorEntityTypes::class)],
            'contractor_type' => ['required', new Enum(ContractorTypes::class)],
            'name' => ['required'],
            'gst' => ['required'],
            'registration_number' => ['nullable'],
            'pan' => ['required'],
            'phone' => ['required', 'digits:10', Rule::unique('users', 'phone')->ignore($this->contractorUserId)],
            'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($this->contractorUserId)],
            'address' => ['required'],
            'bank_name' => ['required', 'string'],
            'branch_name' => ['required'],
            'account_number' => ['required'],
            'ifsc_code' => ['required'],
        ]);

        try {
            return DB::transaction(function () use ($validated) {
                $this->contractor->update([
                    'gst' => $validated['gst'],
                    'pan' => $validated['pan'],
                    'registration_number' => $validated['registration_number'],
                    'address' => $validated['address'],
                    'bank_name' => $validated['bank_name'],
                    'branch_name' => $validated['branch_name'],
                    'account_number' => $validated['account_number'],
                    'ifsc_code' => $validated['ifsc_code'],
                ]);      
                
                $this->contractor->user()->update([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone']
                ]);
 
                $this->notify('Contractor details updated.');
            });
        } catch (\Exception $e) {
            $this->bannerMessage('Something went wrong. Try again.', 'danger');
        }
    }

    public function getContractorProperty()
    {
        return ContractorDetail::findOrFail($this->contractorId);
    }

    public function getEntityTypesProperty()
    {
        return ContractorEntityTypes::cases();
    }

    public function getContractorTypesProperty()
    {
        return ContractorTypes::cases();
    }

    public function render()
    {
        return view('livewire.contractors.edit');
    }
}
