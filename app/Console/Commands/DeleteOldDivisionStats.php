<?php

namespace App\Console\Commands;

use App\Models\DivisionStat;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOldDivisionStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-division-stats';

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
        DivisionStat::where('created_at', '<', $fiveDaysAgo)->delete();
    }
}
