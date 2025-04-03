<?php

namespace App\Http\Resources;

use App\Http\Resources\SubjectResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CampaignResource extends JsonResource
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
            'class_id' => $this->class_id,
            'subject_id' => $this->subject_id,
            'name' => $this->name,
            'start_date' => $this->start_date?->format('d/m/Y'),
            'end_date' => $this->end_date?->format('d/m/Y'),
            'duration' => $this->duration?->format('H:i:s'),
            'no_of_questions' => $this->no_of_questions,
            'level' => $this->level,
            'total_marks' => $this->questions_sum_marks,
            'subject' => $this->whenLoaded('subject', new SubjectResource($this->subject))
        ];
    }
}
