<?php

namespace App\Console\Commands;

use App\Models\Scheme;
use App\Models\SchemeShg;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class ImportSchemeShg extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-scheme-shg';

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
        DB::table('scheme_shgs')->truncate();
        // try {
        //     DB::transaction(function () {

                $sghs = File::json(base_path('database/sgh.json'));

                $progressBar = $this->output->createProgressBar(count($sghs));

                $this->line('Scheme SHG importing...');

                $progressBar->start();

                foreach ($sghs as $sgh) {
                    $scheme = Scheme::where('imis_id', $sgh['imis'])->first();

                    if ($scheme) {
                        SchemeShg::create([
                            'scheme_id' => $scheme->id,
                            'shg_name' => $sgh['name'],
                            'contact_person_name' => $sgh['contact_name'],
                            'contact_person_phone' => $sgh['phone'],
                            'shg_id' => $sgh['shg_id'],
                        ]);
                    }
                    $progressBar->advance();

                }

                $progressBar->finish();

                $this->line('');

                // the info method will display in the console as green colored text:
                $this->info('Imported Successfully!');
            // });
        // } catch (\Exception $e) {
        //     Log::info($e->getMessage());
        // }
    }
}
