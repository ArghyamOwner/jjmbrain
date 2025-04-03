<?php

namespace App\Http\Livewire\Schemes;

use App\Http\Livewire\DeleteModal;
use App\Models\Scheme;
use App\Traits\InteractsWithBanner;

class JalmitraUserDelete extends DeleteModal
{
    use InteractsWithBanner;

    public function destroy()
    {
        $model = Scheme::findOrFail($this->deleteModalId);
        $model->user_id = null;
        $model->save();

        $this->emit('refreshData');

        $this->closeDeleteModal();

        $this->banner('Jal Mitra User removed.');
        return redirect()->route('schemes.show', [$model->id, 'tab' => 'jalmitra-user']);
    }
}
