<?php

namespace App\Console\Commands;

use App\Models\Scheme;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ImportOldSchemeCentralStateShare extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-old-scheme-central-state-share';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Old Scheme Central/State Share Data Import';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::transaction(function () {
                $schemes = File::json(base_path('database/schemes.json'));

                $progressBar = $this->output->createProgressBar(count($schemes));

                $this->line('Old Scheme Central/State Share Data importing...');

                $progressBar->start();

                foreach ($schemes as $scheme) {
                    $schemeFound = Scheme::where('old_scheme_id', $scheme['scheme_id'])->first();

                    if ($schemeFound) {
                        $schemeFound->update([
                            'planned_fhtc' => $scheme['no_fhtc'],
                            'no_of_villages' => $scheme['no_villages'],
                            'state_share' => $scheme['state_share'] * 1_00_000,
                            'central_share' => $scheme['central_share'] * 1_00_000,
                            'total_cost' => $scheme['est_cost'] * 1_00_000,
                        ]);

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
