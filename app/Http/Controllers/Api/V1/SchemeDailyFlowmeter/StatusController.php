<?php

namespace App\Http\Controllers\Api\V1\SchemeDailyFlowmeter;

use App\Http\Controllers\Controller;
use App\Models\SchemeDailyFlowmeter;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StatusController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $schemeId = auth()->user()?->scheme?->id;
        if (!$schemeId) {
            return response()->json([
                'message' => 'Jal-Mitra Not Assigned to any Scheme.',
            ], 422);
        }

        $flowmeter = SchemeDailyFlowmeter::where('scheme_id', $schemeId)->first();
        // if (!$flowmeter) {
        //     return response()->json([
        //         'message' => 'Flowmeter Details Not Found.',
        //     ], 422);
        // }

        return $this->respondWithSuccess(
            [
                'status' => $flowmeter?->status,
                'installed' => $flowmeter ? true : false,
            ],
            Response::HTTP_OK,
            'Flowmeter Status'
        );
    }
}
