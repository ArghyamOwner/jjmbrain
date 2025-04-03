<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Models\ContractorDetail;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\ContractorDetailResource;

class ContractorShowController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $contractor = ContractorDetail::with(['user', 'contractorDocuments'])
            ->where('user_id', auth()->id())
            ->first();

        if (! $contractor) {
            return $this->respondWithUnprocessableEntity('Contractor details not found.');
        }

        return $this->respondWithSuccess(
            new ContractorDetailResource($contractor),
            Response::HTTP_OK,
            'Contractor details'
        );
    }
}
