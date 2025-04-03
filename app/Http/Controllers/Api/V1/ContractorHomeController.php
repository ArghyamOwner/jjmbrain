<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContractorDetailResource;
use App\Http\Resources\ContractorHomeResource;
use App\Models\ContractorDetail;
use App\Models\User;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContractorHomeController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $contractor = User::with('contractor')
        ->withCount('workorders')
        ->where('id', auth()->id())
        ->first();

        if (!$contractor) {
            return $this->respondWithUnprocessableEntity('Contractor details not found.');
        }

        return $this->respondWithSuccess(
            new ContractorHomeResource($contractor),
            Response::HTTP_OK,
            'Contractor Home'
        );
    }
}
