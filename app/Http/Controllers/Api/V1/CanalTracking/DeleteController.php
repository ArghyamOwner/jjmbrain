<?php

namespace App\Http\Controllers\Api\V1\CanalTracking;

use App\Http\Controllers\Controller;
use App\Models\CanalTracking;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validateData = $request->validate([
            'canal_id' => ['required']
        ]);
        $model = CanalTracking::whereNull('geojson')->findOrFail($validateData['canal_id']);
		$model->delete();
        return $this->respondOk();
    }
}
