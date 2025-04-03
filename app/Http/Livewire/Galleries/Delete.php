<?php

namespace App\Http\Livewire\Galleries;

use App\Models\Gallery;
use App\Http\Livewire\DeleteModal;
use Illuminate\Support\Facades\Storage;

class Delete extends DeleteModal
{
    public function destroy()
    {
        $model = Gallery::findOrFail($this->deleteModalId);

        if ($model->image && Storage::disk('uploads')->exists($model->image)) {
            Storage::disk('uploads')->delete($model->image);
        }

		$model->delete();

        $this->emit('refreshData');

        $this->closeDeleteModal();    

        $this->notify('Gallery image deleted.');
    }
}
