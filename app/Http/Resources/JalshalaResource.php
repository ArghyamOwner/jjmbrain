<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JalshalaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 'id' => $this->id,
            'jalshala_uin' => $this->jalshala_uin,
            'venue' => $this->venue,
            'schemes' => $this->whenLoaded('schemes', fn() => JalshalaSchemeResource::collection($this->schemes))
        ];
    }
}
