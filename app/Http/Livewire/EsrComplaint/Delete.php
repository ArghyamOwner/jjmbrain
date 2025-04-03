<?php

namespace App\Http\Livewire\EsrComplaint;
use App\Http\Livewire\DeleteModal;
use App\Models\EsrComplaint;
use Illuminate\Support\Facades\Storage;

class Delete extends DeleteModal
{
    public function destroy()
    {
        $model = EsrComplaint::findOrFail($this->deleteModalId);
        if (app()->isProduction() && $model->doc_file && Storage::disk('esrComplaint')->exists($model->doc_file)) {
            Storage::disk('esrComplaint')->delete($model->doc_file);
        }
		$model->delete();

        $this->emit('refreshData');

        $this->closeDeleteModal();    

        $this->notify('ESR Compliance deleted.');
    }
}

