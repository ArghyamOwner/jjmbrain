<?php

namespace App\Console\Commands;

use App\Models\DistrictStat;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOldDistrictStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-district-stats';

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
        $fiveDaysAgo = Carbon::now()->subDays(5);
        DistrictStat::where('created_at', '<', $fiveDaysAgo)->delete();
    }
}
