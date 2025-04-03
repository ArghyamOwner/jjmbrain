<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\WorkorderStatus;
use App\Http\Controllers\Controller;
use App\Models\Workorder;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;

class WorkorderDeleteController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $validated = $request->validate([
            'workorder_id' => ['required'],
        ]);

        $workorder = Workorder::where('old_workorder_id', $validated['workorder_id'])->first();
        if (!$workorder) {
            return response()->json([
                'message' => 'Workorder Not Found.',
            ], 422);
        }

        $workorder->update([
            'workorder_status' => WorkorderStatus::DELETED_AT_SMT
        ]);

        $workorder->schemeActivity()->create([
            // 'scheme_id' => $scheme->id,
            'activity_type' => 'smt_workorder_deleted',
            'content' => $workorder->workorder_number,
        ]);  

        return $this->respondCreated();
    }
}
