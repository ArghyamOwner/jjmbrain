<?php

namespace App\Http\Controllers\Api\V1\AssignmentSubTasks;

use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Models\AssignmentSubtask;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\AssignmentSubtaskResource;

class ShowController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(AssignmentSubtask $subtask, Request $request)
    {
        $subtask->load(['assignmentImages', 'assignmentReviews']);

        return $this->respondWithSuccess(
            new AssignmentSubtaskResource($subtask),
            Response::HTTP_OK,
            'Assignment Subtasks Details'
        );
    }
}
