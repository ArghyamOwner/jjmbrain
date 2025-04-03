<?php

namespace App\Http\Livewire\Schemes;

use App\Http\Livewire\DeleteModal;
use App\Models\Scheme;
use App\Models\SchemeActivity;
use App\Models\SchemePipeNetwork;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DeleteSchemePipeNetwork extends DeleteModal
{
    use InteractsWithBanner;

    public function destroy()
    {
        $model = SchemePipeNetwork::findOrFail($this->deleteModalId);
        $schemeId = $model->scheme_id;
        if ($model->file && Storage::disk('canaltrackingGeoJson')->exists($model->file)) {
            Storage::disk('canaltrackingGeoJson')->delete($model->file);
        }
        SchemeActivity::create([
            'user_id' => auth()->id(),
            'scheme_id' => $schemeId,
            'activity_type' => 'pipe_json_deleted',
            'content' => 'Pipe Network Json File Deleted',
            'feedable_type' => get_class(new Scheme()),
            'feedable_id' => $schemeId
        ]);
		$model->delete();

        
        $this->banner('Pipe Network Json File Deleted Successfully');
        return redirect()->route('schemes.show', [$schemeId, 'tab' => 'pipe-network']);
    }
}
