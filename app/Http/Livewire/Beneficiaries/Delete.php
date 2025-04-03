<?php

namespace App\Http\Livewire\Beneficiaries;

use App\Http\Livewire\DeleteModal;
use App\Models\Beneficiary;
use App\Models\Scheme;
use App\Models\SchemeActivity;
use Illuminate\Support\Facades\Storage;

class Delete extends DeleteModal
{
    public function destroy()
    {
        $model = Beneficiary::findOrFail($this->deleteModalId);
        if (app()->isProduction() && $model->beneficiary_photo && Storage::disk('beneficiaries')->exists($model->beneficiary_photo)) {
            Storage::disk('beneficiaries')->delete($model->beneficiary_photo);
        }
        $schemeId = $model->scheme_id;
        $name = $model->beneficiary_name;
        $phone = $model->beneficiary_phone;
		$model->delete();
        SchemeActivity::create([
            'user_id' => auth()->id(),
            'scheme_id' => $schemeId,
            'activity_type' => 'beneficiary_deleted',
            'content' => 'Beneficiary - '.$name.' ( '.($phone ?? "-").' )',
            'feedable_type' => get_class(new Scheme()),
            'feedable_id' => $schemeId
        ]);
        $this->emit('refreshData');
        $this->closeDeleteModal();
        $this->notify('Beneficiary deleted.');
    }
}
