<?php

namespace App\Http\Controllers\Api\V1\CanalTracking;

use App\Http\Controllers\Controller;
use App\Models\CanalTracking;
use App\Models\Scheme;
use App\Models\SchemeActivity;
use App\Traits\DistanceFromLatLongs;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateGeojsonController extends Controller
{
    use WithApiHelpers;
    use DistanceFromLatLongs;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, CanalTracking $canalTracking)
    {
        $validatedData = $request->validate([
            'geoJson' => ['required', 'array'],
            'valve' => ['nullable', 'array'],
            'road_cross' => ['nullable', 'array'],
        ]);

        $distance = $this->getDistance($validatedData['geoJson']);

        $data = tap($canalTracking)->update([
            'geojson' => $validatedData['geoJson'],
            'has_geojson' => true,
            'valve' => $validatedData['valve'],
            'road_cross' => $validatedData['road_cross'],
            'distance' => $distance,
        ]);

        SchemeActivity::create([
            'user_id' => auth()->id(),
            'scheme_id' => $canalTracking->scheme_id,
            'activity_type' => 'pipe_tracked',
            'content' => 'Size : '.$canalTracking->size.' mm & Distance : '.$distance.' KM',
            'feedable_type' => get_class(new Scheme()),
            'feedable_id' => $canalTracking->scheme_id
        ]);

        return $this->respondWithSuccess($data, Response::HTTP_OK, 'Geojson Updated');
    }
}
