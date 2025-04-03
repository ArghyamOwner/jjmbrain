<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Workorder;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\SchemeResource;
use Symfony\Component\HttpFoundation\Response;

class ContractorWorkorderSchemesController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Workorder $workorder, Request $request)
    {
        $workorder->loadMissing('schemes');

        return $this->respondWithSuccess(
            SchemeResource::collection($workorder->schemes->load('workorders', 'financialYear', 'division.circle')),
            Response::HTTP_OK,
            'Schemes associated with workorders'
        );
    }
}
