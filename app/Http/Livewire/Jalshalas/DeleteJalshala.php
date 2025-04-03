<?php

namespace App\Http\Livewire\Jalshalas;

use Livewire\Component;
use App\Models\Jalshala;
use App\Http\Livewire\DeleteModal;
use App\Models\Jaldoot;
use App\Models\JalshalaSchool;
use Illuminate\Support\Facades\Storage;

class DeleteJalshala extends DeleteModal
{
    public function destroy()
    {
        $model = Jalshala::findOrFail($this->deleteModalId);

        $jalshalaSchools = JalshalaSchool::where('jalshala_id', $model->id)->get();

        foreach ($jalshalaSchools as $jalshalaSchool) {

            $jalshalaSchool->jaldoots()->delete();
            $jalshalaSchool->delete();
        }

        if ($model->day_one_image && Storage::disk('uploads')->exists($model->day_one_image)) {
            Storage::disk('uploads')->delete($model->day_one_image);
        }

        if ($model->day_two_image && Storage::disk('uploads')->exists($model->day_two_image)) {
            Storage::disk('uploads')->delete($model->day_two_image);
        }


        $model->jaldootAttendances()->delete();
        $model->schemes()->wherePivot('jalshala_id', $model->id)->detach();
        $model->delete();

        $this->closeDeleteModal();

        $this->emit('refreshData');

        $this->notify('Jalshala deleted.');

        return redirect()->route('jalshalas.index');
    }
}
