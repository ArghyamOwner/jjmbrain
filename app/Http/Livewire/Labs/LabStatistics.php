<?php

namespace App\Http\Livewire\Labs;

use App\Models\Lab;
use App\Models\Transfer;
use Livewire\Component;

class LabStatistics extends Component
{
    public $name;
    public $phone;
    public $labId;
    public $contact_person;
    public $nabl_certification_expiry;

    public function mount(Lab $lab)
    {
        $this->name = $lab->lab_name;
        $this->contact_person = $lab->contact_person;
        $this->phone = $lab->phone;
        $this->nabl_certification_expiry = $lab->nabl_certification_expiry ? $lab->nabl_certification_expiry->format('d-m-Y') : null;

        $this->labId = $lab->id;
    }
    public function render()
    {
        $incomingStocks =  Transfer::query()
            ->with('destinationLab', 'item')
            ->where('destination_lab_id', $this->labId)
            ->limit(8)
            ->get();

        $outgoingStocks =  Transfer::query()
            ->with('sourceLab', 'item')
            ->where('source_lab_id', $this->labId)
            ->limit(8)
            ->get();


        return view('livewire.labs.lab-statistics', [
            'incomingStocks' => $incomingStocks,
            'outgoingStocks' => $outgoingStocks,
        ]);
    }
}
