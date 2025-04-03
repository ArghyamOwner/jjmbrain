<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CanalTrackingResource extends JsonResource
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
            'type' => $this->type,
            'size' => $this->size,
            'distance' => $this->distance,
            'quality' => $this->quality,
            'status' => $this->status,
            'approved_by' => $this->approvedBy?->name,
            'created_by' => $this->createdBy?->name,
            'geojson' => $this->geojson ? [] : null,
            'geojson_exists' => $this->has_geojson ? true : false,
            'approved_on' => [
                'human' => $this->approved_on?->diffForHumans(),
                'date' => $this->approved_on?->toDateString(),
                'formatted' => $this->approved_on?->toFormattedDateString(),
            ],
            'created_at' => [
                'human' => $this->created_at?->diffForHumans(),
                'date' => $this->created_at?->toDateString(),
                'formatted' => $this->created_at?->format("jS M Y h:i A"),
                // 'datetime' => $this->created_at->toFor
            ],
        ];
    }
}
