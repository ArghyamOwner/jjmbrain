<?php

namespace App\Console\Commands;

use App\Models\District;
use App\Models\Division;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use League\Csv\Reader;

class ImportDistrictDivisionRelation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-district-division-relation';

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

                $csv = Reader::createFromPath(base_path('database/district_division.csv'), 'r');
                $csv->setHeaderOffset(0);
                // $header = $csv->getHeader(); // get the CSV header row
                $records = $csv->getRecords(); // get all the records

                $progressBar = $this->output->createProgressBar(count($csv));

                $this->line('District - division relation...');

                $progressBar->start();

                foreach($records as $record) {
                    
                    $division = Division::where('name', $record['division'])->first();
                    $district = District::where('name', $record['district'])->first();

                    $division->districts()->sync($district);
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
