<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LithologResource extends JsonResource
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
            'well_id' => $this->well_id,
            'starting_date' => [
                'human' => $this->starting_date?->diffForHumans(),
                'date' => $this->starting_date?->toDateString(),
                'formatted' => $this->starting_date?->toFormattedDateString(),
            ],
            'drilling_type' => $this->drilling_type,
            'driller_name' => $this->driller_name,
            'driller_phone' => $this->driller_phone,
            'drill_vehicle_number' => $this->drill_vehicle_number,
            'hole_diameter' => $this->hole_diameter,
            'casing_size' => $this->casing_size,
            'compressor_capacity' => $this->compressor_capacity,
            'compressor_capacity_unit' => $this->compressor_capacity_unit,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
        ];
    }
}
