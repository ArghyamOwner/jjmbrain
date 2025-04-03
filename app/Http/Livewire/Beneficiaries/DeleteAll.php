<?php

namespace App\Http\Livewire\Beneficiaries;

use App\Http\Livewire\DeleteModal;
use App\Models\Beneficiary;
use App\Models\Scheme;
use App\Models\SchemeActivity;
use Illuminate\Support\Facades\Storage;

class DeleteAll extends DeleteModal
{

    public function destroy()
    {
        $model = Beneficiary::where('scheme_id', $this->deleteModalId)->lazy();

        foreach ($model as $beneficiary) {
            if (app()->isProduction() && $beneficiary->beneficiary_photo && Storage::disk('beneficiaries')->exists($beneficiary->beneficiary_photo)) {
                Storage::disk('beneficiaries')->delete($beneficiary->beneficiary_photo);
            }
            $schemeId = $beneficiary->scheme_id;
            $name = $beneficiary->beneficiary_name;
            $phone = $beneficiary->beneficiary_phone;
            $beneficiary->delete();
            SchemeActivity::create([
                'user_id' => auth()->id(),
                'scheme_id' => $schemeId,
                'activity_type' => 'beneficiary_deleted',
                'content' => 'Beneficiary - ' . $name . ' ( ' . ($phone ?? "-") . ' )',
                'feedable_type' => get_class(new Scheme()),
                'feedable_id' => $schemeId,
            ]);
        }
        $this->emit('refreshData');
        $this->closeDeleteModal();
        $this->notify('Beneficiary deleted.');
    }

}
