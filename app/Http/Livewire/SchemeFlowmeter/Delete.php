<?php

namespace App\Http\Livewire\SchemeFlowmeter;

use App\Http\Livewire\DeleteModal;
use App\Models\Scheme;
use App\Models\SchemeActivity;
use App\Models\SchemeFlowmeterDetails;
use Livewire\Component;

class Delete extends DeleteModal
{
    public function destroy()
    {
        $model = SchemeFlowmeterDetails::findOrFail($this->deleteModalId);
        $schemeId = $model->scheme_id;
        $value = $model->value;
		$model->delete();
        SchemeActivity::create([
            'user_id' => auth()->id(),
            'scheme_id' => $schemeId,
            'activity_type' => 'flowmeter_value_deleted',
            'content' => 'Flowmeter Reading - '.$value,
            'feedable_type' => get_class(new Scheme()),
            'feedable_id' => $schemeId
        ]);
        $this->emit('refreshData');
        $this->closeDeleteModal();
        $this->notify('Flowmeter Record deleted.');
    }
}
