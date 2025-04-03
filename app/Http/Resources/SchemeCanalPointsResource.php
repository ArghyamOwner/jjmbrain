<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SchemeCanalPointsResource extends JsonResource
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
            'category' => $this->category,
            'casing_type' => $this->casing_type,
            'size' => $this->size,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
