<?php

namespace App\Http\Controllers\Api\V1\CanalTracking;

use App\Http\Controllers\Controller;
use App\Http\Resources\CanalPointTypeResource;
use App\Http\Resources\CanalTrackingResource;
use App\Models\CanalTrackingPoint;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

class PointTypesController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, $type)
    {
        $data = [];
        switch ($type) {
            case (CanalTrackingPoint::CATEGORY_VALVE):
                $data = CanalTrackingPoint::getValveTypeOptions();
                break;

            case (CanalTrackingPoint::CATEGORY_ROAD_CROSSING):
                $data = CanalTrackingPoint::getRoadCrossingTypeOptions();
                break;

            case (CanalTrackingPoint::CATEGORY_RAILWAY_CROSSING):
                $data = CanalTrackingPoint::getRailwayCrossingTypeOptions();
                break;

            case (CanalTrackingPoint::CATEGORY_CULVERTS):
                $data = CanalTrackingPoint::getCulvertTypeOptions();
                break;

            case (CanalTrackingPoint::CATEGORY_BRIDGES):
                $data = CanalTrackingPoint::getBridgeTypeOptions();
                break;
            default:
        }
        [$keys, $values] = Arr::divide($data);
        return $this->respondWithSuccess(
            $keys, 
            Response::HTTP_OK, 
            'Type Options'
        );
    }
}
