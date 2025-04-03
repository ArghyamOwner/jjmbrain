<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\ContractorDetail;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckContractorExistsController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validatedData = $request->validate([
            'bid_no' => ['required'],
        ]);

        // $exists = ContractorDetail::where('bid_no', $validatedData['bid_no'])->exists();
        if (ContractorDetail::where('bid_no', $validatedData['bid_no'])->exists()) {
            return $this->respondWithSuccess([
                'contractor_exists' => true,
            ], Response::HTTP_OK, 'Contractor already exists.');
        } else {
            return $this->respondWithSuccess([
                'contractor_exists' => false,
            ], Response::HTTP_OK, 'Contractor does not exists.');
        }
    }
}
