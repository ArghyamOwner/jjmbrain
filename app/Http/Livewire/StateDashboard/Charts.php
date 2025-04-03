<?php

namespace App\Http\Livewire\StateDashboard;

use App\Models\DivisionStat;
use Livewire\Component;

class Charts extends Component
{
    public function render()
    {
        $data = DivisionStat::query()
            ->whereDate('created_at', now())
            ->whereIn('key', ['without_tpi_progress', 'tpi_upto_30', 'tpi_upto_50', 'tpi_upto_80', 'tpi_upto_90', 'tpi_above_90'])
            ->get();
            

        return view('livewire.state-dashboard.charts', [
            'data' => [
                $data->where('key', 'tpi_upto_30')->sum('value'),
                $data->where('key', 'tpi_upto_50')->sum('value'),
                $data->where('key', 'tpi_upto_80')->sum('value'),
                $data->where('key', 'tpi_upto_90')->sum('value'),
                $data->where('key', 'tpi_above_90')->sum('value'),
                $data->where('key', 'without_tpi_progress')->sum('value'),
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
