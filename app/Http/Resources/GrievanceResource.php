<?php

namespace App\Http\Resources;

use App\Models\Grievance;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GrievanceResource extends JsonResource
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
            'reference_no' => $this->reference_no,
            'division' => $this->division?->name,
            'priority' => $this->priority,
            'status' => $this->status,
            'category' => $this?->category?->name,
            'sub_category' => $this?->subCategory?->name,
            'sub_category_id' => $this->sub_category_id,
            'issue' => $this?->issue?->issue,
            'assigned_to' => $this->latestAssignedTask?->assignedTo?->name,
            'due_date' => [
                'human' => $this->latestAssignedTask?->due_date?->diffForHumans(),
                'date' => $this->latestAssignedTask?->due_date?->toDateString(),
                'formatted' => $this->latestAssignedTask?->due_date?->toFormattedDateString(),
            ],
            'images' => $this->platform == Grievance::PLATFORM_WHATSAPP ?
            [
                "image" => $this->attachment,
                "img_meta" => [
                    "img_thumb" => $this->attachment,
                    "img_large" => $this->attachment,
                ],
            ]
            : $this->whenLoaded('images', fn() => GrievanceImagesResource::collection($this->images)),

            'createdBy' => $this?->createdBy?->name,
            'created_at' => [
                'human' => $this->created_at?->diffForHumans(),
                'date' => $this->created_at?->toDateString(),
                'formatted' => $this->created_at?->toFormattedDateString(),
            ],
        ];
    }
}
