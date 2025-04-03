<?php

namespace App\Http\Controllers\Api\V1\Schemes;

use App\Http\Controllers\Controller;
use App\Models\Scheme;
use App\Models\SchemeActivity;
use App\Models\SchemeFlowmeterDetails;
use App\Rules\SchemeFlowmeterValueRule;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FlowmeterDetailsStoreController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // $schemeId = auth()->user()?->scheme?->id;
        $schemeId = '01h2za78psrsv00xvzh826935m';

        if (!$schemeId) {
            return response()->json([
                'message' => 'Jal-Mitra Not Assigned to any Scheme.',
            ], 422);
        }

        $validated = $request->validate([
            'value' => ['required', 'numeric', new SchemeFlowmeterValueRule($schemeId)],
        ]);

        SchemeFlowmeterDetails::create($validated + [
            // 'created_by' => Auth::id(),
            'created_by' => '01hxgfdcytrynzy8kkn3q6xk20',
            'scheme_id' => $schemeId,
        ]);

        SchemeActivity::create([
            'user_id' => auth()->id(),
            'scheme_id' => $schemeId,
            'activity_type' => 'flowmeter_updated',
            'content' => 'Flowmeter reading : ' . $validated['value'] . ' updated',
            'feedable_type' => get_class(new Scheme()),
            'feedable_id' => $schemeId,
        ]);

        return $this->respondCreated();
    }
}
