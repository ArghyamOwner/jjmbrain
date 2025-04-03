<?php

namespace App\Console\Commands;

use App\Models\Scheme;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use League\Csv\Reader;

class ImportOldSchemeVillages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-old-scheme-villages';

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
        try {
            DB::transaction(function () {

                $csv = Reader::createFromPath(base_path('database/scheme_villages.csv'), 'r');
                $csv->setHeaderOffset(0);
                // $header = $csv->getHeader(); // get the CSV header row
                $records = $csv->getRecords(); // get all the records

                $progressBar = $this->output->createProgressBar(count($csv));

                $this->line('Old Scheme Village Data importing...');

                $progressBar->start();

                foreach ($records as $scheme) {
                    $schemeFound = Scheme::with('villages')->where('old_scheme_id', $scheme['scheme_id'])->first();

                    if ($schemeFound) {

                        $villageId = $scheme['village_id'];
                        // Check if the relationship already exists
                        if (!$schemeFound->villages->contains('id', $villageId)) {
                            $schemeFound->villages()->attach(['village_id' => $villageId]);
                        }

                        // $schemeFound->villages()->attach([
                        //     'village_id' => $scheme['village_id'],
                        // ]);

                        $progressBar->advance();
                    }
                }

                $progressBar->finish();

                $this->line('');

                // the info method will display in the console as green colored text:
                $this->info('Imported Successfully!');
            });

            // DB::transaction(function () {
            //     $schemes = File::json(base_path('database/scheme_villages.json'));

            //     $progressBar = $this->output->createProgressBar(count($schemes));

            //     $this->line('Old Scheme Village Data importing...');

            //     $progressBar->start();

            //     foreach ($schemes as $scheme) {
            //         $schemeFound = Scheme::where('old_scheme_id', $scheme['scheme_id'])->first();

            //         if ($schemeFound) {
            //             $schemeFound->villages()->attach([
            //                 'village_id' => $scheme['village_id']
            //             ]);

            //             $progressBar->advance();
            //         }
            //     }

            //     $progressBar->finish();

            //     $this->line('');

            //     // the info method will display in the console as green colored text:
            //     $this->info('Imported Successfully!');
            // });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
