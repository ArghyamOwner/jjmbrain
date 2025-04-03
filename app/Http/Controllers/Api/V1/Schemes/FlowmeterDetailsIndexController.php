<?php

namespace App\Http\Controllers\Api\V1\Schemes;

use App\Http\Controllers\Controller;
use App\Http\Resources\SchemeFlowmeterDetailsResource;
use App\Models\Scheme;
use App\Models\SchemeFlowmeterDetails;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FlowmeterDetailsIndexController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Scheme $scheme, Request $request)
    {
        $flowmeter = SchemeFlowmeterDetails::query()
            ->with('createdBy')
            ->where('scheme_id', $scheme->id)
            ->simplePaginate();

        return $this->respondWithSuccess(
            SchemeFlowmeterDetailsResource::collection($flowmeter)->response()->getData(true),
            Response::HTTP_OK,
            'Flowmeter Details lists'
        );
    }
}
