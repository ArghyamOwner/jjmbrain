<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Workorder;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;

class WorkorderUpdateController extends Controller
{
    use WithApiHelpers;
    /**
     * Handle the incoming request.
     */
    public function __invoke($workorder, Request $request)
    {
        $workorder = Workorder::where('old_workorder_id', $workorder)->first();
        if (!$workorder) {
            return response()->json([
                'message' => 'Workorder Not Found.',
            ], 422);
        }

        $validate = $request->validate([
            'workorder_number' => ['required'],
            'workorder_amount' => ['required'],
            'workorder_estimated_date' => ['required'],
        ]);

        $workorder->update($validate);

        $changes = $workorder->getChanges();

        if (count($changes)) {
            unset($changes['updated_at']);
            $updatedKeys = implode(', ', array_keys($changes));

            $workorder->schemeActivity()->create([
                // 'scheme_id' => $workorder->user_id,
                'activity_type' => 'smt_workorder_updated',
                'content' => $workorder->workorder_number . ' - ' . $updatedKeys,
            ]);
        }

        return $this->respondCreated();
    }
}
