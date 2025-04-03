<?php

namespace App\Http\Livewire\CanalTracking;

use App\Http\Livewire\DeleteModal;
use App\Models\CanalTrackingPoint;
use App\Models\Scheme;
use App\Models\SchemeActivity;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DeletePoints extends DeleteModal
{
    use InteractsWithBanner;

    public function destroy()
    {
        $model = CanalTrackingPoint::findOrFail($this->deleteModalId);
        $schemeId = $model->scheme_id;
        if ($model->image && Storage::disk('canaltracking')->exists($model->image)) {
            Storage::disk('canaltracking')->delete($model->image);
        }
        SchemeActivity::create([
            'user_id' => auth()->id(),
            'scheme_id' => $schemeId,
            'activity_type' => 'pipe_attribute_deleted',
            'content' => 'Pipe Attribute of Type '.$model->type.' and Size : '.$model->size,
            'feedable_type' => get_class(new Scheme()),
            'feedable_id' => $schemeId
        ]);
		$model->delete();

        
        $this->banner('Pipe Attribute Deleted Successfully');
        return redirect()->route('canalShowMap', $schemeId);
    }
}
