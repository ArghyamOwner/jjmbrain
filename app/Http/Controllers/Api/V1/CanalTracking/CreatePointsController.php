<?php

namespace App\Http\Controllers\Api\V1\CanalTracking;

use App\Http\Controllers\Controller;
use App\Models\CanalTrackingPoint;
use App\Models\Scheme;
use App\Models\SchemeActivity;
use App\Traits\WithApiFileUpload;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreatePointsController extends Controller
{
    use WithApiHelpers;
    use WithApiFileUpload;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Scheme $scheme)
    {
        $validatedData = $request->validate([
            'type' => ['required'],
            'category' => ['nullable'],
            'casing_type' => ['nullable'],
            'size' => ['nullable'],
            'valve_manufacturer' => ['nullable'],
            'image' => ['required'],
            'latitude' => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        ]);

        $validatedData['created_by'] = Auth::id();
        // $scheme->canalTrackingPoints()->create($validatedData);
        
        $canalPoint = CanalTrackingPoint::create($validatedData + [
            'scheme_id' => $scheme->id
        ]);

        if (!blank($validatedData['image'])) {
            $file = $this->createFileObject($validatedData['image']);

            $canalPoint->update([
                'image' => $file->storePublicly('/', 'canaltracking'),
            ]);
        }

        return $this->respondCreated();
    }
}
