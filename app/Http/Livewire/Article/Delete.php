<?php

namespace App\Http\Livewire\Article;

use App\Http\Livewire\DeleteModal;
use App\Models\Article;

class Delete extends DeleteModal
{
    public function destroy()
    {
        $model = Article::findOrFail($this->deleteModalId);
		$model->delete();

        $this->emit('refreshData');

        $this->closeDeleteModal();    

        $this->notify('Article deleted.');
    }
}
