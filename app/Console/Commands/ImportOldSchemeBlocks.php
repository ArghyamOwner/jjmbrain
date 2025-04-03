<?php

namespace App\Console\Commands;

use App\Models\Scheme;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use League\Csv\Reader;

class ImportOldSchemeBlocks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-old-scheme-blocks';

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
        // try {
        //     DB::transaction(function () {

                $csv = Reader::createFromPath(base_path('database/scheme_block.csv'), 'r');
                $csv->setHeaderOffset(0);
                // $header = $csv->getHeader(); // get the CSV header row
                $records = $csv->getRecords(); // get all the records

                $progressBar = $this->output->createProgressBar(count($csv));

                $this->line('Old Scheme Blocks Data importing...');

                $progressBar->start();

                foreach ($records as $scheme) {

                    $schemeFound = Scheme::with('blocks')->where('old_scheme_id', $scheme['scheme_id'])->first();

                    if ($schemeFound) {

                        $blockId = $scheme['block_id'];
                        // Check if the relationship already exists
                        if (!$schemeFound->blocks->contains('id', $blockId)) {
                            $schemeFound->blocks()->attach(['block_id' => $blockId]);
                        }

                        // $schemeFound->villages()->attach([
                        //     'village_id' => $scheme['village_id'],
                        // ]);

                        $progressBar->advance();
                    }

                    // $schemeFound = Scheme::where('old_scheme_id', $scheme['scheme_id'])->first();

                    // if ($schemeFound) {

                    //     if (!$schemeFound->block_id) {
                    //         $schemeFound->updateQuietly([
                    //             'block_id' => $scheme['block_id'],
                    //         ]);
                    //     }

                    //     $progressBar->advance();
                    // }
                }

                $progressBar->finish();

                $this->line('');

                // the info method will display in the console as green colored text:
                $this->info('Imported Successfully!');
        //     });
        // } catch (\Exception $e) {
        //     Log::info($e->getMessage());
        // }
    }
}
