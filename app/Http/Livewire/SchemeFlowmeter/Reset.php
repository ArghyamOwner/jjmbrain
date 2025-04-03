<?php
namespace App\Http\Livewire\SchemeFlowmeter;

use App\Http\Livewire\DeleteModal;
use App\Models\FlowmeterResetData;
use App\Models\Scheme;
use App\Models\SchemeActivity;
use App\Models\SchemeFlowmeterDetails;

class Reset extends DeleteModal
{
    public function destroy()
    {
        $model    = SchemeFlowmeterDetails::findOrFail($this->deleteModalId);
        $model->update(['reset_point' => true]);

        $data = FlowmeterResetData::create([
            'scheme_id' => $model->scheme_id,
            'value' => $model->value,
            'created_by' => auth()->id()
        ]);

        SchemeActivity::create([
            'user_id' => auth()->id(),
            'scheme_id' => $model->scheme_id,
            'activity_type' => 'flowmeter_reset',
            'content' => 'Flowmeter has been reset after Reading - '.$model->value,
            'feedable_type' => get_class(new Scheme()),
            'feedable_id' => $model->scheme_id
        ]);
        $this->emit('refreshData');
        $this->closeDeleteModal();
        $this->notify('Flowmeter Reset.');
    }
}
