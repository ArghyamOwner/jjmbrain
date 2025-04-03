<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SchemeFlowmeterDetailsResource extends JsonResource
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
            'value' => $this->value,
            'created_by' => $this?->createdBy?->name,
            'created_at' => [
                'human' => $this->created_at?->diffForHumans(),
                'date' => $this->created_at?->toDateString(),
                'formatted' => $this->created_at?->toFormattedDateString(),
            ],
        ];
    }
}
