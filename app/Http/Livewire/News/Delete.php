<?php

namespace App\Http\Livewire\News;

use App\Http\Livewire\DeleteModal;
use App\Models\News;

class Delete extends DeleteModal
{
    public function destroy()
    {
        $model = News::findOrFail($this->deleteModalId);
		$model->delete();

        $this->emit('refreshData');

        $this->closeDeleteModal();    

        $this->notify('News deleted.');
    }
}
