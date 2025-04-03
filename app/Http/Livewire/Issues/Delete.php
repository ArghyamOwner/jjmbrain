<?php

namespace App\Http\Livewire\Issues;

use App\Models\Issue;
use Livewire\Component;
use App\Http\Livewire\DeleteModal;

class Delete extends DeleteModal
{
    public function destroy()
    {
        $model = Issue::with('category', 'subCategory')->findOrFail($this->deleteModalId);

      //  $model->category->delete();

     //   $model->subCategory->delete();
        
		$model->delete();

        $this->closeDeleteModal();    

        $this->emit('refreshData');

        $this->notify('Issue deleted.');
    }
}
