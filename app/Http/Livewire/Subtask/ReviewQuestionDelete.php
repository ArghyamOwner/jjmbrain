<?php

namespace App\Http\Livewire\Subtask;

use App\Http\Livewire\DeleteModal;
use App\Models\SubtaskReviewQuestion;
use App\Traits\InteractsWithBanner;

class ReviewQuestionDelete extends DeleteModal
{
    public function destroy()
    {
        $model = SubtaskReviewQuestion::findOrFail($this->deleteModalId);
		$model->delete();

        $this->closeDeleteModal();    

        $this->emit('refreshData');

        $this->notify('Subtasks review question deleted.');
    }
}
