<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TutorialResource extends JsonResource
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
            'actor' => $this->actor,
            'caption' => $this->caption,
            'instruction_link' => $this->instruction_link,
            'instruction_attachment_url' => $this->instruction_attachment_url,
            'created_at' => [
                'human' => $this->created_at?->diffForHumans(),
                'date' => $this->created_at?->toDateString(),
                'formatted' => $this->created_at?->toFormattedDateString(),
            ],
        ];
    }
}
