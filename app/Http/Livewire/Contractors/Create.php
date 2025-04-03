<?php

namespace App\Http\Livewire\Contractors;

use App\Models\User;
use Livewire\Component;
use App\Enums\ContractorTypes;
use App\Models\ContractorDetail;
use Illuminate\Support\Facades\DB;
use App\Traits\InteractsWithBanner;
use App\Enums\ContractorEntityTypes;
use Illuminate\Validation\Rules\Enum;

class Create extends Component
{
    use InteractsWithBanner;

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
    public $bid_no;

    public function save()
    {
        $validated = $this->validate([
            'entity_name' => ['required'],
            'business_type' => ['required', new Enum(ContractorEntityTypes::class)],
            'contractor_type' => ['required', new Enum(ContractorTypes::class)],
            'name' => ['required'],
            'gst' => ['required'],
            'bid_no' => ['required', 'unique:contractor_details,bid_no'],
            'registration_number' => ['nullable'],
            'pan' => ['required'],
            'phone' => ['required', 'digits:10', 'unique:users,phone'],
            'email' => ['required', 'email', 'unique:users,email'],
            'address' => ['required'],
            'bank_name' => ['required', 'string'],
            'branch_name' => ['required'],
            'account_number' => ['required'],
            'ifsc_code' => ['required'],
        ]);

        try {
            return DB::transaction(function () use ($validated) {
                $user = User::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'email_verified_at' => now(),
                    'password' => bcrypt('secret'),
                    'role' => 'contractor',
                    'phone' => $validated['phone']
                ]);

                ContractorDetail::create([
                    'user_id' => $user->id,
                    'entity_name' => $validated['entity_name'],
                    'business_type' => $validated['business_type'],
                    'contractor_type' => $validated['contractor_type'],
                    'name' => $validated['name'],
                    'gst' => $validated['gst'],
                    'pan' => $validated['pan'],
                    'bid_no' => $validated['bid_no'],
                    // 'registration_number' => $validated['registration_number'],
                    // 'registration_valid_upto' => now()->addYear(),
                    'address' => $validated['address'],
                    'bank_name' => $validated['bank_name'],
                    'branch_name' => $validated['branch_name'],
                    'account_number' => $validated['account_number'],
                    'ifsc_code' => $validated['ifsc_code'],
                ]);        
 
                $this->banner('New contractor saved.');
        
                return redirect()->route('contractors');
            });
        } catch (\Exception $e) {
            $this->bannerMessage('Something went wrong. Try again.', 'danger');
        }
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
        return view('livewire.contractors.create');
    }
}
