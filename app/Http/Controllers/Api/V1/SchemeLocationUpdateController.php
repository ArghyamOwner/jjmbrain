<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Litholog;
use App\Models\Scheme;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SchemeLocationUpdateController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Scheme $scheme, Request $request)
    {
        $validated = $request->validate([
            'latitude' => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        ]);
        $scheme->update($validated);

        $elevation = null;
        $responses = Http::get(
            'https://api.open-meteo.com/v1/elevation?latitude=' . $scheme->latitude . '&longitude=' . $scheme->longitude
        );
        $currentData = json_decode($responses->body(), true);
        if (array_key_exists('elevation', $currentData)) {
            $elevation = collect($currentData['elevation'])->first();
        } else {
            Log::info('ELEVATION_API_ERROR : ' . $currentData['reason']);
        }
        Litholog::where('scheme_id', $scheme->id)->update($validated + [
            'elevation' => $elevation,
        ]);
        return $this->respondOk();
    }
}
