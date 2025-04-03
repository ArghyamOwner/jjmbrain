<?php

namespace App\Console\Commands;

use App\Models\Scheme;
use Illuminate\Console\Command;
use League\Csv\Reader;

class ImportChildSchemes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-child-schemes';

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
        $csv = Reader::createFromPath(base_path('database/ChildSchemes_9thApril24.csv'), 'r');
        $csv->setHeaderOffset(0);
        // $header = $csv->getHeader(); // get the CSV header row
        $records = $csv->getRecords(); // get all the records

        $progressBar = $this->output->createProgressBar(count($csv));
        $this->line('Child Schemes importing...');
        $progressBar->start();

        foreach ($records as $scheme) {

            $schemeExists = Scheme::where('old_scheme_id', $scheme['old_scheme_id'])->exists();

            if ($schemeExists) {
                continue;
            } else {
                Scheme::withoutEvents(function () use ($scheme, $progressBar) {
                    $parentScheme = Scheme::with([
                        'blocks',
                        'villages',
                        'panchayats',
                        'habitations',
                    ])->where('old_scheme_id', $scheme['parent_smtid'])->first();

                    if ($parentScheme) {

                        $childScheme = Scheme::create([
                            'name' => $scheme['name'],
                            'total_cost' => $scheme['total_cost'],
                            'central_share' => $scheme['central_share'],
                            'state_share' => $scheme['state_share'],
                            'planned_fhtc' => $scheme['planned_fhtc'],
                            'old_scheme_id' => $scheme['old_scheme_id'],

                            'financial_year_id' => $parentScheme->financial_year_id,
                            'scheme_type' => $parentScheme->scheme_type,
                            'scheme_status' => $parentScheme->scheme_status,
                            'has_tea_garden' => $parentScheme->has_tea_garden,
                            'work_status' => $parentScheme->work_status,
                            'operating_status' => $parentScheme->operating_status,
                            'achieved_fhtc' => $parentScheme->achieved_fhtc,
                            'slssc_year' => $parentScheme->slssc_year,
                            'no_of_villages' => $parentScheme->no_of_villages,
                            'approved_on' => $parentScheme->approved_on,
                            'imis_id' => $parentScheme->imis_id,
                            'water_source' => $parentScheme->water_source,
                            'division_id' => $parentScheme->division_id,
                            'district_id' => $parentScheme->district_id,
                            'lac_id' => $parentScheme->lac_id,
                            'parent_id' => $parentScheme->id,
                            'handover_date' => $parentScheme->handover_date,
                            'latitude' => $parentScheme->latitude,
                            'longitude' => $parentScheme->longitude,
                            'consumer_no' => $parentScheme->consumer_no,
                            'consumer_bill' => $parentScheme->consumer_bill,
                            'handover_document' => $parentScheme->handover_document,
                            'verified_on' => $parentScheme->verified_on,
                            'verified_by' => $parentScheme->verified_by,
                            'scheme_nature' => $parentScheme->scheme_nature,
                            'is_archived' => $parentScheme->is_archived,
                            'archived_by' => $parentScheme->archived_by,
                            'archived_on' => $parentScheme->archived_on,
                            'energy_type' => $parentScheme->energy_type,
                            'tpi_progress' => $parentScheme->tpi_progress,
                        ]);

                        $childScheme->blocks()->sync($parentScheme->blocks?->pluck('id'));
                        $childScheme->panchayats()->sync($parentScheme->panchayats?->pluck('id'));
                        $childScheme->villages()->sync($parentScheme->villages?->pluck('id'));
                        $childScheme->habitations()->sync($parentScheme->habitations?->pluck('id'));
                    } else {
                        $this->line('Scheme Not Found' . $scheme['parent_smtid']);
                    }

                    $progressBar->advance();
                });
            }
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
