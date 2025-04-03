<?php

namespace App\Console\Commands;

use App\Models\CanalTracking;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class UpdateReferenceNoOfCanalTracking extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-reference-no-of-canal-tracking';

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
        $tracks = CanalTracking::whereNull('reference_no')->get();
        foreach($tracks as $track){
            $track->update([
                'reference_no' => strtoupper(Str::random(10))
            ]);
        }
    }
}
