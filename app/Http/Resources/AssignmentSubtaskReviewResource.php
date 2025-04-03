<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssignmentSubtaskReviewResource extends JsonResource
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
            'comment' => $this->comment,
            'status' => $this->status,
            'user_type' => $this->user_type,
            'rating' => $this->rating,
            'images' => $this->images,
            'created' => [
                'human' => $this->created_at->diffForHumans(),
                'date' => $this->created_at->toDateString(),
                'formatted' => $this->created_at->toFormattedDateString(),
            ],
            'user' => $this->whenLoaded('user', fn() => [
                'name' => $this->user?->name,
                'role' => $this->user?->role,
                'photo' => $this->user?->photo_url,
            ]),
        ];
    }
}
