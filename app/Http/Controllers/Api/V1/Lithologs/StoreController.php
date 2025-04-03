<?php

namespace App\Http\Controllers\Api\V1\Lithologs;

use App\Http\Controllers\Controller;
use App\Models\Litholog;
use App\Models\Scheme;
use App\Traits\WithApiHelpers;
use App\Traits\WithUniqueRandomNumberGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    use WithApiHelpers;
    use WithUniqueRandomNumberGenerator;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validate = $request->validate([
            'scheme_id' => ['required'],
            'starting_date' => ['required'],
            'drilling_type' => ['required'],
            'driller_name' => ['required'],
            'driller_phone' => ['required'],
            'drill_vehicle_number' => ['required'],
            'hole_diameter' => ['required'],
            'casing_size' => ['required'],
            'compressor_capacity' => ['required'],
            'compressor_capacity_unit' => ['required'],
            // 'latitude' => ['nullable'],
            // 'longitude' => ['nullable'],
        ]);

        $scheme = Scheme::select('id', 'latitude', 'longitude')->findOrFail($validate['scheme_id']);
        $litholog = Litholog::create($validate + [
            'well_id' => $this->generateUniqueRandomNumber(),
        ]);

        if ($scheme->latitude && $scheme->longitude) {
            $responses = Http::get(
                'https://api.open-meteo.com/v1/elevation?latitude=' . $scheme->latitude . '&longitude=' . $scheme->longitude
            );
            $currentData = json_decode($responses->body(), true);
            if (array_key_exists('elevation', $currentData)) {
                $litholog->update([
                    'latitude' => $scheme->latitude,
                    'longitude' => $scheme->longitude,
                    'elevation' => collect($currentData['elevation'])->first(),
                ]);
            } else {
                Log::info('ELEVATION_API_ERROR : ' . $currentData['reason']);
            }
        }
        return $this->respondCreated();
    }
}
