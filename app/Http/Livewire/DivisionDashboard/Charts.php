<?php

namespace App\Http\Livewire\DivisionDashboard;

use App\Models\DivisionStat;
use App\Models\Scheme;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Charts extends Component
{
    public $divisionId;

    public function mount($division)
    {
        $this->divisionId = $division;
    }

    public function render()
    {

        $data = DivisionStat::query()
            ->whereDate('created_at', now())
            ->where('division_id', $this->divisionId)
            ->whereIn('key', ['without_tpi_progress', 'tpi_upto_30', 'tpi_upto_50', 'tpi_upto_80', 'tpi_upto_90', 'tpi_above_90'])
            ->get();

        return view('livewire.division-dashboard.charts', [
            'data' => [
                // $data->upto_30,
                // $data->upto_50,
                // $data->upto_80,
                // $data->upto_90,
                // $data->above_90,
                // $data->nullProgress,
                $data->where('key', 'tpi_upto_30')->first()?->value,
                $data->where('key', 'tpi_upto_50')->first()?->value,
                $data->where('key', 'tpi_upto_80')->first()?->value,
                $data->where('key', 'tpi_upto_90')->first()?->value,
                $data->where('key', 'tpi_above_90')->first()?->value,
                $data->where('key', 'without_tpi_progress')->first()?->value,
            ],
            'keys' => [
                'Below 30% Progress', 
                '30-50% Progress', 
                '50-80% Progress', 
                '80-90% Progress', 
                'Above 90% Progress', 
                'Without Progress'
            ],
            'tpiData' => $data
        ]);
    }
}
