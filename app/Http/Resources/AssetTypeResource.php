<?php

namespace App\Http\Resources;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssetTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'value' => $this->value,
            'category' => $this->value == Asset::TYPE_MOVABLE ? Asset::getApiMovableCategoryOptions() : Asset::getApiImmovableCategoryOptions()
        ];
    }
}
