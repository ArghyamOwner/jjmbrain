<?php

namespace App\Console\Commands;

use App\Models\Scheme;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use League\Csv\Reader;

class ImportOldSchemePanchayat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-old-scheme-panchayat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Old Scheme Panchayat';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::transaction(function () {
                // $schemes = File::json(base_path('database/scheme_panchayat.json'));

                // $progressBar = $this->output->createProgressBar(count($schemes));

                $csv = Reader::createFromPath(base_path('database/scheme_panchayats.csv'), 'r');
                $csv->setHeaderOffset(0);
                // $header = $csv->getHeader(); // get the CSV header row
                $records = $csv->getRecords(); // get all the records

                $progressBar = $this->output->createProgressBar(count($csv));

                $this->line('Old Scheme Panchayat importing...');

                $progressBar->start();

                foreach ($records as $scheme) {
                    $schemeFound = Scheme::with('panchayats')->where('old_scheme_id', $scheme['scheme_id'])->first();

                    if ($schemeFound) {

                        $panchayatId = $scheme['gp_id'];
                        // Check if the relationship already exists
                        if (!$schemeFound->panchayats->contains('id', $panchayatId)) {
                            $schemeFound->panchayats()->attach(['panchayat_id' => $panchayatId]);
                        }

                        // $schemeFound->panchayats()->attach([
                        //     'panchayat_id' => $scheme['gp_id']
                        // ]);

                        $progressBar->advance();
                    }
                }

                $progressBar->finish();

                $this->line('');

                // the info method will display in the console as green colored text:
                $this->info('Imported Successfully!');
            });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
