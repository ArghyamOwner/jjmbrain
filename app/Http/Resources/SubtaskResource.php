<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubtaskResource extends JsonResource
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
            'task_id' => $this->task_id,
            'subtask_name' => $this->subtask_name,
            'subtask_description' => $this->subtask_description,
            'subtask_estimated_time' => $this->subtask_estimated_time,
            'type' => $this->type,
            'options' => $this->options ?? [],
            'show_form' => (bool) $this->show_form,
        ];
    }
}
