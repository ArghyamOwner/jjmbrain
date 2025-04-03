<?php

namespace App\Http\Livewire\SchemeArchiveRequest;

use App\Http\Livewire\DeleteModal;
use App\Models\SchemeArchiveRequest;
use App\Traits\InteractsWithBanner;
use Livewire\Component;

class Delete extends DeleteModal
{
    use InteractsWithBanner;

    public function destroy()
    {
        $model = SchemeArchiveRequest::findOrFail($this->deleteModalId);
        $schemeId = $model->scheme_id;
        if($model->status != 'pending'){
            $this->closeDeleteModal(); 
            return $this->notify('Unable to Delete the request now !', 'error');
        }
		$model->delete();
        $this->closeDeleteModal();    
        $this->banner('Archive Request Deleted Successfully.');
        return redirect()->route('schemes.show', $schemeId);
    }
}
