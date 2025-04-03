<?php

namespace App\Http\Livewire\Campaigns;

use App\Http\Livewire\DeleteModal;
use App\Models\Campaign;
use App\Traits\InteractsWithBanner;

class Delete extends DeleteModal
{
    use InteractsWithBanner;

    public function destroy()
    {
        $model = Campaign::findOrFail($this->deleteModalId);

        $model->questions()->delete();

		$model->delete();

        $this->closeDeleteModal();    

        $this->banner('Campaign delete');

        return redirect()->route('campaigns');
    }
}
