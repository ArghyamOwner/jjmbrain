<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AssignmentTaskResource;
use App\Models\Activity;
use App\Models\AssignmentTask;
use App\Models\Scheme;
use App\Traits\WithApiHelpers;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActivityDetailsController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Activity $activity, $scheme, Request $request)
    {
        $schemeData = Scheme::where('old_scheme_id', $scheme)->first();

        if (!$schemeData) {
            return response()->json([
                'message' => 'Invalid Data.',
            ], 422);
        }

        $assignmentTask = AssignmentTask::query()
            ->with(['scheme', 'task', 'assignmentSubtasks'])
            ->where('scheme_id', $schemeData->id)
            ->whereRelation('task', 'activity_id', $activity->id)
            ->get();

        return $this->respondWithSuccess(
            AssignmentTaskResource::collection($assignmentTask),
            Response::HTTP_OK,
            'Assignment Task details'
        );
    }
}
