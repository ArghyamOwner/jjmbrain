<?php

namespace App\Http\Livewire\ContractorDocuments;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\ContractorDetail;
use App\Enums\ContractorDocumentTypes;
use App\Models\ContractorDocument;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $contractorId;
    public $contractordocuments = [];

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function save()
    {
        // dd($this->getContractorDocumentsValidationRules());
        $validated = $this->validate();

        // dd($validated);
        foreach ($validated as $key => $value) {
            // dd(array_values($value));
            ContractorDocument::create([
                'contractor_detail_id' => $this->contractorId,
                'user_id' => auth()->id(),
                'document_type' => Str::headline(array_keys($value)[0]),
                'document_name' => Str::headline(array_keys($value)[0]),
                'path' => array_values($value)[0]->storePublicly('/', 'uploads'),
                'size' => array_values($value)[0]->getSize(),
                'extension' => array_values($value)[0]->getClientOriginalExtension(),
            ]);
        }

        $this->dispatchBrowserEvent('destroy-filepond');
        $this->emit('refreshData');
        $this->notify('Document uploaded successfully');
    }

    protected function rules()
    {
        return collect($this->documents)->flatMap(fn($item) => [
            'contractordocuments.'. Str::camel($item->value) => ['nullable', 'image', 'max:4048']
        ])->all();
    }

    protected function getContractorUploadedDocumentTypes()
    {
        return $this->contractor->contractorDocuments?->pluck('document_type')->all();
    }

    public function getContractorProperty()
    {
        return ContractorDetail::with('contractorDocuments')->findOrFail($this->contractorId);
    }

    public function getDocumentsProperty()
    {
        $documents = ContractorDocumentTypes::cases();

        return collect($documents)->whereNotIn('value', $this->getContractorUploadedDocumentTypes())
            ->values()
            ->all();
    }

    public function render()
    {
        return view('livewire.contractor-documents.create', [
            'contractorDocumentDetails' => $this->contractor->contractorDocuments ?? []
        ]);
    }
}
