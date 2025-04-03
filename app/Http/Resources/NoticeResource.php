<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoticeResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'type' => $this->type,
            'role' => $this->role,
            'document_url' => $this->document_url,
            'created_at' => [
                'human' => $this->created_at?->diffForHumans(),
                'date' => $this->created_at?->toDateString(),
                'formatted' => $this->created_at?->toFormattedDateString(),
            ],
        ];
    }
}
