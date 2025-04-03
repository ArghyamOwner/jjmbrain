<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuizScoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'correct_answers' => $this->correct_answers,
            'score' => $this->score,
            'created' => [
                'human' => $this->created_at->diffForHumans(),
                'date' => $this->created_at->toDateString(),
                'formatted' => $this->created_at->toFormattedDateString(),
            ],
            'campaign' => $this->whenLoaded('campaign', new CampaignResource($this->campaign)),
        ];
    }
}
