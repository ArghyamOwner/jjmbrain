<?php

namespace App\Console\Commands;

use App\Models\Litholog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UpdateElevationDataOfLithologs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-elevation-data-of-lithologs';

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
        $records = Litholog::query()
            ->whereNotNull(['latitude', 'longitude'])
            ->whereNull('elevation')
            ->limit(5)
            ->lazy();

        $progressBar = $this->output->createProgressBar(count($records));
        $this->line('Updating Lithologs...');
        $progressBar->start();

        foreach ($records as $litholog) {
            $responses = Http::get(
                'https://api.open-meteo.com/v1/elevation?latitude=' . $litholog->latitude . '&longitude=' . $litholog->longitude
            );
            $currentData = json_decode($responses->body(), true);

            if (array_key_exists('elevation', $currentData)) {
                $litholog->update([
                    'elevation' => collect($currentData['elevation'])->first(),
                ]);
            } else {
                Log::info('ELEVATION_API_ERROR : ' . $currentData['reason']);
            }

            $progressBar->advance();
        }
        $progressBar->finish();

        $this->line('');

        // the info method will display in the console as green colored text:
        $this->info('Updated Successfully!');
    }
}
