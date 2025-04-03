<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Scheme;
use App\Models\SchemeFloodInfo as SchemeFloodInfoModel;
use App\Traits\InteractsWithBanner;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;

class CreateFloodInfoScheme extends Component
{
    use InteractsWithBanner;

    public $scheme;
    public $floodInfo;
    public $schemeId;

    public $message = false;

    public $severity = "";
    public $partial_damage = []; 
    public $inundated_infrastructure = [];
    public $approx_inundation_height = 0;
    public $water_stagnation_period= "";
    public $start_date;

     
    public function render()
    {
        return view('livewire.schemes.create-flood-info-scheme', [
            'severityOptions' => SchemeFloodInfoModel::getSeverityOptions(),
            'partialDamageItems' => SchemeFloodInfoModel::getPartialDamageOptions(),
            'getInundatedInfrastructures' => SchemeFloodInfoModel::getInundatedInfrastructureOptions(),
        ]);
    }
    public function mount(Scheme $scheme)
    {
        $scheme->loadMissing('division');

        $this->scheme = $scheme;
        // $this->circle = $scheme->division->circle_id;
        $this->schemeId = $scheme->id;
    }

    public function save()
    {
        $this->message = false;
        $validatedData = $this->validate([
            'start_date' => ['required', 'date'],
            'water_stagnation_period' => ['required', 'numeric'],
            'inundated_infrastructure' => ['required', 'array', 'min:1'],
            'severity' => ['required', 'string'],
            'partial_damage' => ['required', 'array', 'min:1'],
            'approx_inundation_height' => ['required', 'numeric'],
        ]);
        // dd($validatedData);
        $exists = SchemeFloodInfoModel::where('start_date', '=', $validatedData['start_date'])->exists();
        if ($exists) {
            $this->message = "For Today Floods Info is already exists";
            // $this->addError('start_date', 'For Today Floods Info is already exists');
            return;
        }
        $validatedData["scheme_id"] = $this->schemeId;
        $validatedData["user_id"] = auth()->user()->id;
        $validatedData["inundated_infrastructure"] = implode(', ', $validatedData["inundated_infrastructure"]);
        $validatedData["partial_damage"] = implode(', ', $validatedData["partial_damage"]);
        SchemeFloodInfoModel::create($validatedData);
        $this->banner('Flood info saved successfully.');
        return redirect()->route('schemes.show', [$this->schemeId, 'tab' => 'flood-info-scheme']);
    }
}
