<?php

namespace App\Http\Livewire\Subtask;

use App\Models\Subtask;
use Livewire\Component;
use App\Traits\InteractsWithBanner;
use App\Models\SubtaskReviewQuestion;

class ReviewQuestions extends Component
{
    use InteractsWithBanner;

    public $taskId;
    public $subtaskId;

    protected $listeners = [
        'refreshData' => '$refresh'
    ];
    
    public function mount(Subtask $subtask)
    {
        $this->taskId = $subtask->task_id;
        $this->subtaskId = $subtask->id;
    }

    public function render()
    {
        return view('livewire.subtask.review-questions', [
            'reviewQuestions' => SubtaskReviewQuestion::query()
                ->where('subtask_id', $this->subtaskId)
                ->latest('id')
                ->get()
        ]);
    }
}
