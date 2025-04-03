<?php

namespace App\Http\Livewire\Reviewsections;

use App\Http\Livewire\DeleteModal;
use App\Models\ReviewQuestion;

class QuestionsDelete extends DeleteModal
{
    public function destroy()
    {
        $model = ReviewQuestion::findOrFail($this->deleteModalId);
        $model->options()->delete();
		$model->delete();

        $this->emit('refreshData');

        $this->closeDeleteModal();    

        $this->notify('Review question deleted.');
    }
}
