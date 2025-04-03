<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SchemeCanalResource extends JsonResource
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
            'name' => $this->name,
            'canal_trackings' => $this->whenLoaded('trackedCanalTrackings', fn() => SchemeCanalTrackingResource::collection($this->trackedCanalTrackings)),
            'canal_points' => $this->whenLoaded('canalTrackingPoints', fn() => SchemeCanalPointsResource::collection($this->canalTrackingPoints)),
        ];
    }
}
