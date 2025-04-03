<?php

namespace App\Http\Controllers\Api\V1\CanalTracking;

use App\Http\Controllers\Controller;
use App\Models\CanalTrackingPoint;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

class PointCategoriesController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = CanalTrackingPoint::getCategoryOptions();
        [$keys, $values] = Arr::divide($data);

        return $this->respondWithSuccess(
            $keys, 
            Response::HTTP_OK, 
            'Category Options'
        );
    }
}
