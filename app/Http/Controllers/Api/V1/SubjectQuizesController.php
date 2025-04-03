<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Subject;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\CampaignResource;
use Symfony\Component\HttpFoundation\Response;

class SubjectQuizesController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Subject $subject)
    {
        $quiz = Campaign::query()
            ->withSum('questions', 'marks')
            ->where('subject_id', $subject->id)
            ->where('class_id', $subject->class_id)
            ->get();

        return $this->respondWithSuccess(
            CampaignResource::collection($quiz),
            Response::HTTP_OK,
            'Campaign lists'
        );
    }
}
