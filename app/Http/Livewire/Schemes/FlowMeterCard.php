<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Scheme;
use App\Models\SchemeFlowmeterDetails;
use App\Models\WaterReport;
use Carbon\Carbon;
use Livewire\Component;

class FlowMeterCard extends Component
{
    public Scheme $scheme;
    // public $dates = [];
    // public $readings = [];
    public $stats = [];

    public function mount()
    {
        // $this->scheme->loadMissing(['flowmeterDetails.createdBy:id,name']);
        $this->getStats();
    }

    public function getStats()
    {
        $today = now()->toDateString();
        $yesterday = now()->subDay()->toDateString();

        $latestReading = SchemeFlowmeterDetails::where('scheme_id', $this->scheme->id)
            ->latest('id')->first();

        $todayReading = SchemeFlowmeterDetails::where('scheme_id', $this->scheme->id)
                        ->whereDate('created_at', $today) ->latest('id')->first();

        $yesterdayReading = SchemeFlowmeterDetails::where('scheme_id', $this->scheme->id)
            ->whereDate('created_at', $yesterday)->latest('id')->first();

        $this->stats = [
            'Latest meter reading' => [
                'value' => round($latestReading?->value ?? 0),
                'icon' => ''
            ], 
            'Today water supply' => [
                'value' => round(($todayReading?->value ?? 0) - ($yesterdayReading?->value ?? 0)),
                'icon' => ''
            ],
        ];
    }

    public function processFlowMeterDetails($flowmeterDetails)
    {
        $dates = [];
        $readings = [];
        $flowmeterDetails = $flowmeterDetails->sortBy('created_at');
        foreach ($flowmeterDetails as $fmDetails) {
            $dates[] = $fmDetails->created_at->format('Y-m-d');
            $readings[] = $fmDetails->value;
        }
        // $this->dates = $dates;
        // $this->readings = $readings;
    }

    public function render()
    {
        return view('livewire.schemes.flow-meter-card');
    }
}
