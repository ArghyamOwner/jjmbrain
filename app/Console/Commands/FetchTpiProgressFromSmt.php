<?php

namespace App\Console\Commands;

use App\Models\Scheme;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchTpiProgressFromSmt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-tpi-progress-from-smt';

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
        $schemes = Scheme::select('id', 'old_scheme_id', 'tpi_progress')->whereNotNull('old_scheme_id')
            ->where('tpi_progress', '<', 100)
            ->orWhereNull('tpi_progress')->lazy();

        $progressBar = $this->output->createProgressBar(count($schemes));
        $this->line('Fetching and Updating TPI Progress Data...');
        $progressBar->start();

        foreach ($schemes as $scheme) {
            $apiURL = "https://jjmassam.in/crs/api/getTPIProgress/$scheme->old_scheme_id";
            $response = Http::withBasicAuth(config('services.jjmAssam.username'), config('services.jjmAssam.password'))
                ->withHeaders([
                    "APIKEY" => config('services.jjmAssam.api_key'),
                ])->get($apiURL);
            $statusCode = $response->status();
            $responseBody = json_decode($response->getBody(), true);

            $progress = null;
            if ($statusCode == 200 && isset($responseBody['TPIProgress']['progress'])) {
                $progress = $responseBody['TPIProgress']['progress'];
                Scheme::withoutEvents(function () use ($scheme, $progress) {
                    $scheme->update(['tpi_progress' => $progress]);
                });
            }
            $progressBar->advance();
        }
        $this->line('');

        // the info method will display in the console as green colored text:
        $this->info('Imported Successfully!');
    }
}
