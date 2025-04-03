<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'attributes' => [
                'message' => $this->data['message'],
                'from' => $this->data['from'] ?? 'DAO',
                'created' => [
                    'human' => $this->created_at->diffForHumans(),
                    'date' => $this->created_at->toDateString(),
                    'formatted' => $this->created_at->toFormattedDateString(),
                ],
            ],
            'relationships' => [],
            'links' => []
        ];
    }
}
