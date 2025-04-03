<?php

namespace App\Http\Livewire\OAndMEstimates;

use App\Models\FinancialYear;
use App\Models\OAndMEstimate;
use App\Models\Wuc;
use App\Traits\InteractsWithBanner;
use Livewire\Component;

class Create extends Component
{
    use InteractsWithBanner;

    public $wuc;
    public $wucId;
    public $wucName;

    public $financial_year_id;
    public $manpower;
    public $maintenance;
    public $electricity;
    public $chemical;
    public $total_monthly_estimate;

    public function mount(Wuc $wuc)
    {
        $this->wuc = $wuc;
        $this->wucId = $wuc->id;
        $this->wucName = $wuc->name;
    }

    public function save()
    {
        $validatedData = $this->validate([
            'financial_year_id' => ['required'],
            'manpower' => ['required'],
            'maintenance' => ['required'],
            'electricity' => ['required'],
            'chemical' => ['required'],
            'total_monthly_estimate' => ['required'],
        ]);

        $validatedData['manpower'] = str_replace(',', '', $validatedData['manpower']);
        $validatedData['maintenance'] = str_replace(',', '', $validatedData['maintenance']);
        $validatedData['electricity'] = str_replace(',', '', $validatedData['electricity']);
        $validatedData['chemical'] = str_replace(',', '', $validatedData['chemical']);
        $validatedData['total_monthly_estimate'] = str_replace(',', '', $validatedData['total_monthly_estimate']);

        OAndMEstimate::create($validatedData + [
            'wuc_id' => $this->wucId,
        ]);
        $this->banner('O & M Estimate Added Successfully');
        return redirect()->route('wucs.show', $this->wucId);
    }

    public function getFinancialYearsProperty()
    {
        return FinancialYear::all();
    }

    public function render()
    {
        return view('livewire.o-and-m-estimates.create');
    }
}
