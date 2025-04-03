<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Campaign;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuestionResource;
use Symfony\Component\HttpFoundation\Response;

class CampaignQuestionsController extends Controller
{
    use WithApiHelpers;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Campaign $campaign, Request $request)
    {
        $questions = Question::where('campaign_id', $campaign->id)->get();

        return $this->respondWithSuccess(
            QuestionResource::collection($questions),
            Response::HTTP_OK,
            'Campaigns Questions lists'
        );
    }
}
