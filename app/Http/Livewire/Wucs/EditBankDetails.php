<?php

namespace App\Http\Livewire\Wucs;

use App\Models\Bank;
use App\Models\Wuc;
use App\Models\WucDocument;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditBankDetails extends Component
{
    use InteractsWithBanner, WithFileUploads;

    public $wuc;
    public $bank_name;
    public $account_number;
    public $ifsc;
    public $approval_document;
    public $oldApprovalDocument;
    public $constitution_document;
    public $oldConstitutionDocument;

    public function mount(Wuc $wuc)
    {
        $this->wuc = $wuc;
        $this->bank_name = $this->wuc->bank_name;
        $this->account_number = $this->wuc->account_number;
        $this->ifsc = $this->wuc->ifsc;
        // $this->oldApprovalDocument = $this->wuc->approval_document;
        // $this->oldConstitutionDocument = $this->wuc->constitution_document;
    }

    public function update()
    {
        $validate = $this->validate([
            'bank_name' => ['required'],
            'account_number' => ['required'],
            'ifsc' => ['required'],
            // 'approval_document' => ['nullable', 'mimes:pdf'],
            // 'constitution_document' => ['nullable', 'mimes:pdf'],
        ]);

        DB::transaction(function () use ($validate) {
            $this->wuc->update($validate);
            // if ($validate['approval_document']) {
            //     $this->wuc->update([
            //         'approval_document' => $validate['approval_document']->storePublicly('/', 'uploads'),
            //     ]);
            //     if($this->oldApprovalDocument){
            //         WucDocument::create([
            //             'wuc_id' => $this->wuc->id,
            //             'type' => WucDocument::TYPE_APPROVAL_DOCUMENT,
            //             'document' => $this->oldApprovalDocument,
            //             'created_by' => Auth::id(),
            //         ]);
            //     }
            // }
            // if ($validate['constitution_document']) {
            //     $this->wuc->update([
            //         'constitution_document' => $validate['constitution_document']->storePublicly('/', 'uploads'),
            //     ]);
            //     if($this->oldConstitutionDocument){
            //         WucDocument::create([
            //             'wuc_id' => $this->wuc->id,
            //             'type' => WucDocument::TYPE_CONSTITUTION_DOCUMENT,
            //             'document' => $this->oldConstitutionDocument,
            //             'created_by' => Auth::id(),
            //         ]);
            //     }
            // }
            $this->banner('WUC Details Updated Successfully');
        });

        return redirect()->route('wucs.show', $this->wuc->id);
    }

    public function getBanksProperty()
    {
        return Bank::orderBy('name')->pluck('name')->all();
    }

    public function render()
    {
        return view('livewire.wucs.edit-bank-details');
    }
}
