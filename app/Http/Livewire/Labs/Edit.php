<?php

namespace App\Http\Livewire\Labs;

use App\Models\Lab;
use App\Models\Circle;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Traits\InteractsWithBanner;

class Edit extends Component
{
    use WithFileUploads;
    
    public $labId;
    public $office;
    public $labName;
    public $contactPerson;
    public $phone;
    public $labImage;
    public $labImageUrl;
    public $nablCertification;
    public $document;
    public $expiryDate;
    public $documentCheck;

    public function mount(Lab $lab)
    {
        $this->labId = $lab->id;
        $this->office = $lab->circle_id;
        $this->labName = $lab->lab_name;
        $this->contactPerson = $lab->contact_person;
        $this->phone = $lab->phone;
        $this->labImageUrl = $lab->lab_image_url;
        $this->nablCertification = $lab->nabl_certification;
        $this->documentCheck = $lab->document;
        $this->expiryDate = $lab->nabl_certification_expiry?->format('Y-m-d');
    }

    public function save()
    {
        $validated = $this->validate([
            'office' => ['required', Rule::exists('circles', 'id')],
            'labName' => ['required'],
            'contactPerson' => ['required'],
            'phone' => ['required'],
            'labImage' => ['nullable', 'image', 'max:2024'],
            'nablCertification' => ['required', 'in:yes,no'],
            'document' => ['nullable', 'mimes:pdf', 'max:2048'],
            'expiryDate' => ['nullable', 'date']
        ]);

        $this->lab->update([
            'circle_id' => $validated['office'],
            'lab_name' => $validated['labName'],
            'contact_person' => $validated['contactPerson'],
            'phone' => $validated['phone'],
            'nabl_certification' => $validated['nablCertification'],
            'nabl_certification_expiry' => $validated['expiryDate']
        ]);

        if ($validated['labImage']) {
            $this->lab->update([
                'image' => $validated['labImage']->storePublicly('/', 'uploads')
            ]);
        }

        if ($validated['document']) {
            $this->lab->update([
                'document' => $validated['document']->storePublicly('/', 'uploads'),
            ]);
        }

        $this->notify('New lab added.');

        return redirect()->route('labs');
    }

    public function getLabProperty()
    {
        return Lab::findOrFail($this->labId);
    }

    public function getOfficesProperty()
    {
        return Circle::pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.labs.edit');
    }
}
