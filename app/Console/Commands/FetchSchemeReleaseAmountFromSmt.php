<?php

namespace App\Console\Commands;

use App\Models\Scheme;
use App\Models\SchemeFund;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchSchemeReleaseAmountFromSmt extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-scheme-release-amount-from-smt';

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
        $schemes = Scheme::select('id', 'old_scheme_id')->whereNotNull('old_scheme_id')->distinct('old_scheme_id')->lazy();

        $progressBar = $this->output->createProgressBar(count($schemes));
        $this->line('Fetching Scheme\'s Release Amount Data from SMT...');
        $progressBar->start();

        foreach ($schemes as $scheme) {
            $apiURL = "https://jjmassam.in/crs/api/getReleaseFund/$scheme->old_scheme_id";
            $response = Http::withBasicAuth(config('services.jjmAssam.username'), config('services.jjmAssam.password'))
                ->withHeaders([
                    "APIKEY" => config('services.jjmAssam.api_key'),
                ])->get($apiURL);
            $statusCode = $response->status();
            $responseBody = json_decode($response->getBody(), true);

            $progress = null;
            if ($statusCode == 200 && isset($responseBody['releasedAmount']['released'])) {
                $progress = $responseBody['releasedAmount']['released'];
                SchemeFund::create([
                    'scheme_id' => $scheme->id,
                    'old_scheme_id' => $scheme->old_scheme_id,
                    'released_amount' => $progress
                ]); 
            }else{
                $this->line('SchemeNotFound : '.$scheme->old_scheme_id);
                $this->line('');
                $this->line('StatusCode : '.$statusCode);
                $this->line('');
                $this->line('Message : '.$responseBody['messages']['error']);
            }
            $progressBar->advance();
        }
        $this->line('');

        // the info method will display in the console as green colored text:
        $this->info('Imported Successfully!');
    }
}
