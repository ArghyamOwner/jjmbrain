<?php

namespace App\Http\Livewire\Schemes;

use App\Http\Livewire\DeleteModal;
use App\Models\Scheme;
use App\Models\SchemeArchiveRequest;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Auth;

class ArchiveScheme extends DeleteModal
{
    use InteractsWithBanner;
    public function destroy()
    {
        $model = Scheme::findOrFail($this->deleteModalId);
		$scheme = $model->name;
        $model->update([
            'is_archived' => true,
            'archived_on' => now(),
            'archived_by' => Auth::id()
        ]);
        SchemeArchiveRequest::where('scheme_id', $model->id)->update([
            'status' => SchemeArchiveRequest::STATUS_ARCHIVED
        ]);
        $this->closeDeleteModal();    
        $this->banner($scheme.' Scheme Archived Successfully.');
        return redirect()->route('schemes');
    }
}
