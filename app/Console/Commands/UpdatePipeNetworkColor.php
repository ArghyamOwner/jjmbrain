<?php

namespace App\Console\Commands;

use App\Models\CanalTracking;
use Illuminate\Console\Command;

class UpdatePipeNetworkColor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-pipe-network-color';

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
        $colors = config('freshman.pipe_size_color');
        $pipeNetworks = CanalTracking::lazy();
        foreach ($pipeNetworks as $pipe) {
            $size = (int)$pipe->size;
            $pipe->update([
                $pipe->color_code = array_key_exists($size, $colors) ? $colors[$size] : "#00f000",
            ]);
        }
    }
}
