<?php

namespace App\Http\Livewire\MonthlyExpenditure;

use Livewire\Component;

class Index extends Component
{
    public $wuc;

    public function mount($wuc)
    {
        $this->wuc = $wuc->loadMissing('monthlyExpenditures.expenditureCategory');
    }

    public function render()
    {
        return view('livewire.monthly-expenditure.index');
    }
}
