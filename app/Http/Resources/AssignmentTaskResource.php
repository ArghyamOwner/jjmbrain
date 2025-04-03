<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\AssignmentSubtaskResource;

class AssignmentTaskResource extends JsonResource
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
            'scheme_id' => $this->scheme_id,
            'scheme_name' => $this->scheme->name,
            'task_uin' => $this->task?->task_uin ?? '',
            'name' => $this->task->task_name ?? '',
            'description' => $this->task->task_description ?? '',
            'estimated_time' => $this->task?->task_estimated_time .' '. Str::plural('day', $this->task?->task_estimated_time),
            'progress' => intval($this->progress),
            'status' => $this->status,
            'document_url' => $this->task?->task_doc_url,
            'instruction_read_at' => [
                'human' => $this->instruction_read_at?->diffForHumans(),
                'date' => $this->instruction_read_at?->toDateString(),
                'formatted' => $this->instruction_read_at?->toFormattedDateString(),
            ],
            'sub_tasks' => $this->whenLoaded('assignmentSubtasks', fn() => AssignmentSubtaskResource::collection($this->assignmentSubtasks->load('subtask')))
        ];
    }
}
