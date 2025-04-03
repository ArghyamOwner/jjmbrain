<?php

namespace App\Console\Commands;

use App\Models\CanalTracking;
use App\Traits\DistanceFromLatLongs;
use App\Traits\DistanceWithinRadius;
use Illuminate\Console\Command;

class UpdateGeojsonDistance extends Command
{
    use DistanceFromLatLongs;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-geojson-distance';

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
        $tracks = CanalTracking::whereNull('distance')->whereNotNull('geojson')->limit(500)->get();

        foreach($tracks as $track){
            $track->update([
                'distance' => $this->getDistance($track->geojson)
            ]);
        }
    }
}
