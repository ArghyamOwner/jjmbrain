<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Beneficiary;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BeneficiaryVerificationController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'data_key' => ['required'],
        ]);

        $value = 'voterId';
        if (strlen($validated['data_key']) > 10) {
            $value = 'AadhaarCard';
        }

        $beneficiaryExists = Beneficiary::query()
            ->when($value == 'voterId', fn($query) => $query->where('beneficiary_voter_number', $validated['data_key']))
            ->when($value == 'AadhaarCard', fn($query) => $query->where('beneficiary_aadhaar', $validated['data_key']))
            ->exists();

        return $this->respondWithSuccess([
            'beneficiary_exists' => $beneficiaryExists ? true : false,
            'data_key' => $value,
        ], Response::HTTP_OK);
    }
}
