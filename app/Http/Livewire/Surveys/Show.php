<?php

namespace App\Http\Livewire\Surveys;

use App\Models\Survey;
use Livewire\Component;

class Show extends Component
{
    public $survey;

    public function mount(Survey $survey)
    {
        $survey->load('beneficiary.scheme.division', 'campaign', 'user');

        $this->survey = $survey;
    }

    public function render()
    {
        return view('livewire.surveys.show');
    }
}
