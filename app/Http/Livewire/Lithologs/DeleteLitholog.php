<?php

namespace App\Http\Livewire\Lithologs;

use App\Http\Livewire\DeleteModal;
use App\Models\Litholog;
use App\Traits\InteractsWithBanner;

class DeleteLitholog extends DeleteModal
{
    use InteractsWithBanner;

    public function destroy()
    {
        $model = Litholog::findOrFail($this->deleteModalId);
		$scheme = $model->scheme_id;
        $model->delete();
        $this->closeDeleteModal();    
        $this->banner('Litholog Deleted Successfully.');
        return redirect()->route('schemes.show', [$scheme, 'tab' => 'details']);
    }
}
