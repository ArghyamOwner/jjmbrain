<?php

namespace App\Http\Livewire\CanalTracking;

use App\Http\Livewire\DeleteModal;
use App\Models\CanalTracking;
use App\Models\Scheme;
use App\Models\SchemeActivity;
use App\Traits\InteractsWithBanner;

class Delete extends DeleteModal
{
    use InteractsWithBanner;

    public function destroy()
    {
        $model = CanalTracking::findOrFail($this->deleteModalId);
        $schemeId = $model->scheme_id;
        SchemeActivity::create([
            'user_id' => auth()->id(),
            'scheme_id' => $schemeId,
            'activity_type' => 'pipe_deleted',
            'content' => 'Pipe Network of Size '.$model->size.' mm and Distance : '.$model->distance.' KM',
            'feedable_type' => get_class(new Scheme()),
            'feedable_id' => $schemeId
        ]);
		$model->delete();
        $this->banner('Canal Pipe Data Deleted Successfully');
        return redirect()->route('canalShowMap', $schemeId);
    }
}
