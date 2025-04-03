<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AssignmentSubtaskReviewResource;

class AssignmentSubtaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'subtask_id' => $this->subtask_id,
            'name' => $this->subtask?->subtask_name,
            'description' => $this->subtask?->subtask_description ?? '',
            'estimated_time' => $this->subtask?->subtask_estimated_time . ' '. Str::plural('day', $this->subtask?->subtask_estimated_time),
            'remarks' => $this->remarks,
            'comment' => $this->answer,
            'type' => $this->subtask?->type,
            'options' => $this->subtask?->options ?? [],
            'show_form' => (bool) $this->subtask?->show_form ?? false,
            'completed_at' => [
                'human' => $this->completed_at?->diffForHumans(),
                'date' => $this->completed_at?->toDateString(),
                'formatted' => $this->completed_at?->toFormattedDateString(),
            ],
            'images' => $this->whenLoaded('assignmentImages', fn() => AssignmentImageResource::collection($this->assignmentImages)),
            'reviews' => $this->whenLoaded('assignmentReviews', fn() => AssignmentSubtaskReviewResource::collection($this->assignmentReviews->loadMissing('user'))),
        ];
    }
}
