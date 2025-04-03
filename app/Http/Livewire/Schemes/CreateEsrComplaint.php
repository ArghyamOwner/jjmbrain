<?php

namespace App\Http\Livewire\Schemes;

use App\Enums\ESRStatus;
use App\Models\EsrComplaint;
use App\Models\Scheme;
use Livewire\Component;
use App\Traits\InteractsWithBanner;
use Livewire\WithFileUploads;

class CreateEsrComplaint extends Component
{
    use InteractsWithBanner, WithFileUploads; 

    public $scheme;
    public $status;
    public $tpi_agency_name;
    public $tpi_officer_name;
    public $tpi_officer_phone;
    public $doc_file; 



    public function mount(Scheme $scheme)
    {
        $scheme->loadMissing('division');
        $this->scheme = $scheme;
    }

    public function getEsrStatusProperty(){
        return  ESRStatus::getEsrStatusOptions(); 
    }

    public function getTPIAgencyOptionsProperty(){
        return EsrComplaint::getTPIAgencyOptions();
    }


    public function save()
    {
        $validatedData = $this->validate([
            'status' => ['required', 'string'],
            'tpi_agency_name' => ['required', 'string'],
            'tpi_officer_name' => ['required', 'string'],
            'tpi_officer_phone' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
            'doc_file' => ['required', 'file', 'mimes:pdf', 'max:2048'],
        ]);
        $validatedData["scheme_id"] = $this->scheme->id; 
        $validatedData["created_by"] = auth()->id();
        $validatedData["doc_file"] = $validatedData["doc_file"]->storePublicly('/', 'esrComplaint');
        EsrComplaint::create($validatedData);
        $this->banner('ESR Compliance saved successfully.');
        return redirect()->route('schemes.show', [$this->scheme->id, 'tab' => 'esr-complaints']);
    }


    public function render()
    {
        return view('livewire.schemes.create-esr-complaint');
    }
}
