<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Scheme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SchemeResource;
use App\Http\Resources\WorkorderResource;
use App\Traits\WithApiHelpers;
use Symfony\Component\HttpFoundation\Response;

class SchemeWorkordersController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Scheme $scheme, Request $request)
    {
        $scheme->load(['district', 'blocks', 'division', 'workorders.contractor']);
      
        return $this->respondWithSuccess(
            new SchemeResource($scheme),
            // WorkorderResource::collection($scheme->workorders->load(['contractor', 'schemes'])),
            Response::HTTP_OK,
            'Workorder Details'
        );
    }
}
