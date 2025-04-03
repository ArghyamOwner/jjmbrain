<?php

namespace App\Console\Commands;

use App\Models\CanalTracking;
use Illuminate\Console\Command;

class UpdateCanalTrackingHasGeojsonColumn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-canal-tracking-has-geojson-column';

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
        CanalTracking::whereNotNull('geojson')->update([
            'has_geojson' => true,
        ]);
    }
}
