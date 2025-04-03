<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LithologyResource extends JsonResource
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
            'pattern_id' => $this->pattern_id,
            'pattern_category' => $this->pattern?->category ?? null,
            'pattern_number' => $this->pattern?->number ?? null,
            'start' => $this->start,
            'end' => $this->end,
            'type' => $this->type,
            'remarks' => $this->remarks,
        ];
    }
}
