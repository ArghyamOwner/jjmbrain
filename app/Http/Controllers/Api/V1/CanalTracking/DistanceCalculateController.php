<?php

namespace App\Http\Controllers\Api\V1\CanalTracking;

use App\Http\Controllers\Controller;
use App\Traits\DistanceFromLatLongs;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DistanceCalculateController extends Controller
{
    use WithApiHelpers;
    use DistanceFromLatLongs;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validate = $request->validate([
            'geojson' => ['required', 'array'],
        ]);

        $distance = $this->getDistance($validate['geojson']);
        
        return $this->respondWithSuccess(
            $distance,
            Response::HTTP_OK,
            'Distance'
        );
    }
}
