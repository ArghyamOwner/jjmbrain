<?php

namespace App\Console\Commands;

use App\Models\Scheme;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AssignJalmitraDistrict extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:assign-jalmitra-district';

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
                $schemes = Scheme::query()
                    ->with('user')
                    ->whereNotNull('user_id')
                    ->get();

                $progressBar = $this->output->createProgressBar(count($schemes));

                $this->line('Assigning Districts to Jal-Mitra...');

                $progressBar->start();

                foreach ($schemes as $scheme) {
                    $scheme->user->districts()->sync($scheme->district_id);
                    $progressBar->advance();
                }

                $progressBar->finish();

                $this->line('');

                // the info method will display in the console as green colored text:
                $this->info('Imported Successfully!');
            });

        } catch (\Exception $e) {
            Log::info($e);
        }
    }
}
