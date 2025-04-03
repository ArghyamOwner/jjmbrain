<?php

namespace App\Http\Livewire\Schemes;

use App\Http\Livewire\DeleteModal;
use App\Models\User;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Storage;

class RemoveJalmitraDocument extends DeleteModal
{
    use InteractsWithBanner;

    public function destroy()
    {
        $model = User::with('scheme')->findOrFail($this->deleteModalId);
        $schemeId = $model?->scheme?->id;

        if ($model->joining_document && Storage::disk('uploads')->exists($model->joining_document)) {
            Storage::disk('uploads')->delete($model->joining_document);
        }
        $model->joining_document = null;
        $model->save();

        // $this->emit('refreshData');

        // $this->closeDeleteModal();

        // $this->notify('Jal Mitra Joining Document removed.');

        $this->banner('Jal Mitra Joining Document removed.');
        return redirect()->route('schemes.show', $schemeId);
    }
}
