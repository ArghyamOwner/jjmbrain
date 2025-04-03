<?php

namespace App\Http\Livewire\Tenants\Tenders;

use App\Models\Tender;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $tenderId;

    public $name;
    public $tender_no;
    public $due_date;
    public $publish_date;
    public $document_type;
    public $document_url;
    public $tenderDocuments = [];

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function mount(Tender $tender)
    {
        $tender->loadMissing('tenderdocuments');

        $this->tenderId = $tender->id;
        $this->name = $tender->name;
        $this->due_date = $tender->due_date;
        $this->publish_date = $tender->publish_date;
        $this->tender_no = $tender->tender_no;

        $this->tenderDocuments = $tender->tenderdocuments;
    }

    public function getTenderProperty()
    {
        return Tender::findOrFail($this->tenderId);
    }

    public function save()
    {
        $validatedData =  $this->validate([
            'name' => ['required'],
            'tender_no' => ['required'],
            'due_date' => ['date:Y-m-d'],
            'publish_date' => ['date:Y-m-d']
        ]);

        $this->tender->update($validatedData);

        $this->tender->refresh();

        $this->emit('refreshData');

        $this->notify('Tender details updated.');
    }

    public function saveDocument()
    {
        $validated = $this->validate([
            'document_type' => ['required', 'string'],
            'document_url' => ['required', 'string'],
        ]);

        $this->tender->tenderdocuments()->create($validated);
        
        $this->tender->loadMissing('tenderdocuments');
        $this->tenderDocuments = $this->tender->tenderdocuments;

        $this->reset(['document_type', 'document_url']);

        $this->notify('Tender document saved!');

        $this->dispatchBrowserEvent('hide-modal');
    }

    public function render()
    {
        return view('livewire.tenants.tenders.edit');
    }
}
