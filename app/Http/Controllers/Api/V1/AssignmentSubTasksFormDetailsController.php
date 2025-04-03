<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Models\AssignmentSubtask;
use App\Http\Controllers\Controller;
use App\Http\Resources\SubtaskResource;
use Symfony\Component\HttpFoundation\Response;

class AssignmentSubTasksFormDetailsController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(AssignmentSubtask $subtask, Request $request)
    {
        $subtask->loadMissing('subtask');
        
        return $this->respondWithSuccess(
            new SubtaskResource($subtask->subtask),
            Response::HTTP_OK,
            'Subtask form details'
        );
    }
}
