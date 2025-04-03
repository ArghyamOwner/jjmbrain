<?php

namespace App\Http\Controllers\Api\V1\Beneficiary;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Rules\VoterIdRule;
use App\Traits\WithApiFileUpload;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    use WithApiHelpers;
    use WithApiFileUpload;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // new VoterIdRule()

        $validated = $request->validate([
            'beneficiary_voter_number' => ['required_without:beneficiary_aadhaar'],
            'scheme_id' => ['required'],
            'beneficiary_name' => ['required'],
            'beneficiary_phone' => ['required', 'digits:10'],
            'beneficiary_aadhaar' => ['required_without:beneficiary_voter_number'],
            'beneficiary_photo' => ['required'],
            'address' => ['required'],
            'latitude' => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
            'fhtc_number' => ['required', 'numeric', 'digits_between:1,5'],
        ]);

        $file = $this->createFileObject($validated['beneficiary_photo']);

        $validated['beneficiary_photo'] = $file->storePublicly('/', 'beneficiaries');

        Beneficiary::create($validated);

        return $this->respondCreated();
    }
}
