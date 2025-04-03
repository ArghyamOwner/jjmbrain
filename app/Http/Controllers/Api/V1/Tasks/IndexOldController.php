<?php

namespace App\Http\Controllers\Api\V1\Tasks;

use App\Models\Workorder;
use Illuminate\Http\Request;
use App\Models\AssignmentTask;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\AssignmentTaskResource;
use Symfony\Component\HttpFoundation\Response;

class IndexOldController extends Controller
{
    use WithApiHelpers;
    
    /**
     * Handle the incoming request.
     */
    public function __invoke(Workorder $workorder, Request $request)
    {
        $assigmentTasks = AssignmentTask::query()
            ->with(['scheme', 'task', 'assignmentSubtasks'])
            ->where('workorder_id', $workorder->id)
            ->get();

        return $this->respondWithSuccess(
            AssignmentTaskResource::collection($assigmentTasks),
            Response::HTTP_OK,
            'Assignment tasks'
        );
    }
}
