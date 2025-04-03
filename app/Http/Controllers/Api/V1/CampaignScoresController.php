<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Campaign;
use App\Models\QuizScore;
use Illuminate\Http\Request;
use App\Traits\WithApiHelpers;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuizScoreResource;
use Symfony\Component\HttpFoundation\Response;

class CampaignScoresController extends Controller
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
        $quizScores = QuizScore::query()
            ->with(['campaign.subject'])
            ->where('campaign_id', $campaign->id)
            // ->where('user_id', '01gwv8cwstspva6fg3qdcnp0z0')
            ->where('user_id', auth()->id())
            ->get();

        return $this->respondWithSuccess(
            QuizScoreResource::collection($quizScores),
            Response::HTTP_OK,
            "Students quiz scores"
        );
    }
}
