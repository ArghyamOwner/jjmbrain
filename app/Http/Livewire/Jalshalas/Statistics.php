<?php

namespace App\Http\Livewire\Jalshalas;

use App\Enums\JalshalaStatus;
use App\Models\District;
use Livewire\Component;
use App\Models\Jalshala;
use App\Models\JalshalaStatics;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class Statistics extends Component
{
    public $type;

    public function mount($type)
    {
        $this->type = $type;
    }

    public function render()
    { 
        $today = Carbon::today();
        $jalshalaStatics = JalshalaStatics::whereDate('created_at', $today)
        ->where('type', $this->type)
        ->lazy(); 
        $counts = [
            'targeted_jalshala' => 0,
            'conducted' => 0,
            'pending' => 0,
            'pwss_mapped' => 0,
            'school_mapped' => 0,
            'jaldoot_mapped' => 0,
            'jaldoot_participated' => 0,
        ];
        foreach ($jalshalaStatics as $statistic) {
            $counts['conducted'] += $statistic?->conducted;
            $counts['pending'] += $statistic?->pending;
            $counts['pwss_mapped'] += $statistic?->pwss_mapped;
            $counts['school_mapped'] += $statistic?->school_mapped;
            $counts['jaldoot_mapped'] += $statistic?->jaldoot_mapped;
            $counts['jaldoot_participated'] += $statistic?->jaldoot_participated;
        }
        return view('livewire.jalshalas.statistics', [
            'jalshalaPlanned' =>    $this->type === 'phase_I' ? District::sum('targeted_jalshala') : District::sum('phase2_targeted_jalshala'),
            'totalJalshalaCount' => $jalshalaStatics->count(),
            'jalshalaCompleted' => $counts['conducted'],
            'schoolsCount' => $counts['school_mapped'],
            'jaldootsCount' => $counts['jaldoot_mapped'],
            'jaldootsParticipatedCount' => $counts['jaldoot_participated'],
            'pwssMapped' => $counts['pwss_mapped'],
            'upcomingJalshalas' => $counts['pending'],
            'score' => 0,
            'districtPlannedJalshalaCount' => 0,
            'districtTargetedJalshalaCount' => 0,
            'districtOrganisedJalshalaCount' => $counts['conducted'],
        ]);
        
    }
}
