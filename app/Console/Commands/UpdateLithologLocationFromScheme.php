<?php

namespace App\Console\Commands;

use App\Models\Scheme;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class UpdateLithologLocationFromScheme extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-litholog-location-from-scheme';

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
        $data = Scheme::query()
            ->select('id', 'latitude', 'longitude')
            ->withWhereHas('lithologs')
            ->whereNotNull(['latitude', 'longitude'])
        // ->limit(30)
            ->get();

        $progressBar = $this->output->createProgressBar(count($data));
        $this->line('Updating Location data of litholog...');
        $progressBar->start();

        foreach ($data as $scheme) {
            $responses = Http::get(
                'https://api.open-meteo.com/v1/elevation?latitude=' . $scheme->latitude . '&longitude=' . $scheme->longitude
            );
            $currentData = json_decode($responses->body(), true);
            if (array_key_exists('elevation', $currentData)) {

                $scheme->lithologs()->update([
                    'latitude' => $scheme->latitude,
                    'longitude' => $scheme->longitude,
                    'elevation' => collect($currentData['elevation'])->first(),
                ]);

                // $litholog->update([
                //     'latitude' => $scheme->latitude,
                //     'longitude' => $scheme->longitude,
                //     'elevation' => collect($currentData['elevation'])->first(),
                // ]);
            } else {
                Log::info('ELEVATION_API_ERROR : ' . $currentData['reason']);
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->line('');
        // the info method will display in the console as green colored text:
        $this->info('Updated Successfully!');
        // });
    }
}
