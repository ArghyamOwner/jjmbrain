<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassMilestoneResource extends JsonResource
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
            'id' =>  $this->id,
            'milestone_title' => $this->milestone_title,
            'status' => $this->classprogress ? 'completed' : 'pending',
            'date' => $this->classprogress ? $this->classprogress?->created_at?->format('d-m-Y') : ''
        ];
    }
}
