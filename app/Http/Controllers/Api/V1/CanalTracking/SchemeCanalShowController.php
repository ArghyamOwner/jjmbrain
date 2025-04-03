<?php

namespace App\Http\Controllers\Api\V1\CanalTracking;

use App\Http\Controllers\Controller;
use App\Http\Resources\SchemeCanalResource;
use App\Models\Scheme;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SchemeCanalShowController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Scheme $scheme)
    {
        $scheme->loadMissing(
            'trackedCanalTrackings:id,scheme_id,type,size,quality,geojson,color_code', 
            'canalTrackingPoints:id,type,category,casing_type,size,scheme_id,latitude,longitude'
        );
        return $this->respondWithSuccess(
            new SchemeCanalResource($scheme),
            Response::HTTP_OK,
            "Schemes's Canal"
        );
    }
}
