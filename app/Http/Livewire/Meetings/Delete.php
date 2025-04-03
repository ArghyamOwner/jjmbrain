<?php

namespace App\Http\Livewire\Meetings;

use App\Models\Meeting;
use App\Http\Livewire\DeleteModal;

class Delete extends DeleteModal
{
    public function destroy()
    {
        $model = Meeting::findOrFail($this->deleteModalId);
		$model->delete();

        $this->emit('refreshMeetings');

        $this->closeDeleteModal();    

        $this->notify('Meeting deleted.');
    }
}
