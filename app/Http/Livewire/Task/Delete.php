<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use App\Http\Livewire\DeleteModal;
use App\Traits\InteractsWithBanner;

class Delete extends DeleteModal
{
    use InteractsWithBanner;

    public function destroy()
    {
        $model = Task::findOrFail($this->deleteModalId);
        $model->subtasks()->delete();
		$model->delete();

        $this->closeDeleteModal();    

        $this->banner('Task and its associated subtasks is deleted.');

        return redirect()->route('tasks');
    }
}
