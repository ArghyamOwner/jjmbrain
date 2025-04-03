<?php

namespace App\Http\Livewire\Labs;

use App\Models\Lab;
use App\Models\Circle;
use App\Traits\InteractsWithBanner;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class Create extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $office;
    public $labName;
    public $contactPerson;
    public $phone;
    public $labImage;
    public $nablCertification;
    public $document;
    public $expiryDate;

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

        $lab = Lab::create([
            'circle_id' => $validated['office'],
            'lab_name' => $validated['labName'],
            'contact_person' => $validated['contactPerson'],
            'phone' => $validated['phone'],
            'nabl_certification' => $validated['nablCertification'],
            'nabl_certification_expiry' => $validated['expiryDate']
        ]);

        if ($validated['labImage']) {
            $lab->update([
                'image' => $validated['labImage']->storePublicly('/', 'uploads')
            ]);
        }

        if ($validated['document']) {
            $lab->update([
                'document' => $validated['document']->storePublicly('/', 'uploads'),
            ]);
        }

        $this->banner('New lab added.');

        return redirect()->route('labs');
    }

    public function getOfficesProperty()
    {
        return Circle::pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.labs.create');
    }
}