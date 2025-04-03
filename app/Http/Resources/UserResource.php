<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'type' => 'user',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'email' => $this->email,
                'role' => $this->role,
                'phone' => $this->phone,
                'photo' => $this->photo_url,
                'designation' => $this->designation,
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
