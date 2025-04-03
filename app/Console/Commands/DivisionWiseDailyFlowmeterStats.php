<?php

namespace App\Console\Commands;

use App\Models\Division;
use App\Models\DivisionBfmStats;
use App\Models\StateBfmStats;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DivisionWiseDailyFlowmeterStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:division-wise-daily-flowmeter-stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get yesterday's date
        $yesterday = Carbon::yesterday()->toDateString();

        // Fetch data
        $divisions = Division::query()
            ->withCount('schemes')
            ->withCount(['flowmeters as updated_flowmeters_count' => function ($query) use ($yesterday) {
                $query->whereDate('scheme_flowmeter_details.created_at', $yesterday);
                // ->whereHas('scheme', function ($schemeQuery) {
                //     $schemeQuery->where('work_status', 'handed-over')
                //         ->whereNull('parent_id');
                // });
            }])
            ->get();

        foreach ($divisions as $division) {
            DivisionBfmStats::create([
                'division_id' => $division->id,
                'stats_date' => $yesterday,
                'schemes' => $division->schemes_count,
                'flowmeter_schemes' => $division->updated_flowmeters_count,
            ]);
        }

        StateBfmStats::create([
            'stats_date' => $yesterday,
            'schemes' => $divisions->sum('schemes_count'),
            'flowmeter_schemes' => $divisions->sum('updated_flowmeters_count'),
        ]);
    }
}
