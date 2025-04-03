<?php

namespace App\Console\Commands;

use App\Models\Scheme;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use League\Csv\Reader;

class ImportSchemeNewName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-scheme-new-name';

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
                $csv = Reader::createFromPath(base_path('database/schemes_new.csv'), 'r');
                $csv->setHeaderOffset(0);
                // $header = $csv->getHeader(); // get the CSV header row
                $records = $csv->getRecords(); // get all the records

                $progressBar = $this->output->createProgressBar(count($csv));
                $this->line('Scheme Names importing...');
                $progressBar->start();

                foreach ($records as $scheme) {
                    Scheme::withoutEvents(function () use ($scheme, $progressBar) {
                        $foundScheme = Scheme::where('old_scheme_id', $scheme['old_scheme_id'])->first();
                        if($foundScheme)
                        {
                            $foundScheme->update([
                                'new_name' => $scheme['new_name']
                            ]);
                        }else{
                            $this->line('SMT_ID_NOT_FOUND'.$scheme['old_scheme_id']);
                            $this->line(' ');
                        }
                        $progressBar->advance();
                    });

                }
            });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
