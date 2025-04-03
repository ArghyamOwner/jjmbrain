<?php

namespace App\Http\Controllers\Api\V1;

use App\Rules\VoterIdRule;
use App\Models\Beneficiary;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class BeneficiaryVoteridVerificationController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            // new VoterIdRule()
            'voterid' => ['required']
        ]);
     
        if (Beneficiary::where('beneficiary_voter_number', $validated['voterid'])->first()) {
            return $this->respondWithSuccess([
                'voterid_exists' => true
            ], Response::HTTP_OK, 'This voterid already exists.');
        } else {
            return $this->respondWithSuccess([
                'voterid_exists' => false
            ], Response::HTTP_OK, 'This voterid does not exists.');
        }
    }
}
