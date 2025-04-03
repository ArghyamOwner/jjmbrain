<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GrievanceImagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "image" => $this->image_url,
            "img_meta" => [
                "img_thumb" => $this->image_url,
                "img_large" => $this->image_url,
            ],
        ];
    }
}
