<?php

namespace App\Http\Livewire\JalAddas;

use App\Models\JalAdda;
use Livewire\Component;
use App\Models\JalAddaStudent;
use App\Http\Livewire\DeleteModal;
use Illuminate\Support\Facades\Storage;

class DeleteJaladda extends DeleteModal
{
    public function destroy()
    {
        $model = JalAdda::findOrFail($this->deleteModalId);

        $jaladdaStudents = JalAddaStudent::where('jal_adda_id', $model->id)->get();

        foreach ($jaladdaStudents as $jaladdaStudent) {
            $jaladdaStudent->delete();
        }

        if ($model->one_image && Storage::disk('uploads')->exists($model->one_image)) {
            Storage::disk('uploads')->delete($model->one_image);
        }

        if ($model->two_image && Storage::disk('uploads')->exists($model->two_image)) {
            Storage::disk('uploads')->delete($model->two_image);
        }

        $model->delete();

        $this->closeDeleteModal();

        $this->emit('refreshData');

        $this->notify('Jaladda deleted.');

        return redirect()->route('jaladdas.index');
    }
}
