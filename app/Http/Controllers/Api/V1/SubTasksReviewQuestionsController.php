<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Subtask;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\SubtaskReviewQuestionResource;

class SubTasksReviewQuestionsController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     */
    public function __invoke(Subtask $subtask, Request $request)
    {
        $subtask->loadMissing('subtaskReviewQuestions');

        return $this->respondWithSuccess(
            SubtaskReviewQuestionResource::collection($subtask->subtaskReviewQuestions),
            Response::HTTP_OK,
            'Subtask review questions'
        );
    }
}
