<?php

namespace App\Console\Commands;

use App\Enums\SchemeStatus;
use App\Models\ContractorDetail;
use App\Models\Division;
use App\Models\Scheme;
use App\Models\Workdocument;
use App\Models\Workorder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use League\Csv\Reader;

class ImportNewSchemes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-new-schemes';

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

        // DB::transaction(function () {
        //     $schemes = File::json(base_path('database/master_schemes_jjmassam.json'));

        //     $progressBar = $this->output->createProgressBar(count($schemes));

        //     $this->line('Schemes importing...');

        //     $progressBar->start();
        //     foreach ($schemes as $scheme) {
        //         $hasScheme = Scheme::where('old_scheme_id', $scheme['id'])->exists();

        //         if (!$hasScheme) {
        //             $division = Division::where('old_division_id', $scheme['division'])->first();

        //             if ($division) {
        //                 $status = match ($scheme['status']) {
        //                     'Alloted' => SchemeStatus::ALLOTED,
        //                     'Active' => SchemeStatus::ACTIVE,
        //                 };

        //                 if (isset($scheme['tea_garden'])) {
        //                     $hasTeaGarden = match ($scheme['tea_garden']) {
        //                         'Yes' => true,
        //                         'No' => false,
        //                         '1' => true,
        //                         '0' => false,
        //                         default => false
        //                     };
        //                 }

        //                 $schemeNew = Scheme::create([
        //                     'division_id' => $division->id,
        //                     'district_id' => $scheme['district'],
        //                     'lac_id' => $scheme['lac_id'],
        //                     'block_id' => isset($scheme['block']) ? ($scheme['block'] == '' ? null : intval($scheme['block'])) : null,
        //                     'name' => $scheme['scheme_name'],
        //                     'old_scheme_id' => $scheme['id'],
        //                     'scheme_type' => $scheme['scheme_type'],
        //                     'scheme_status' => $status,
        //                     'has_tea_garden' => $hasTeaGarden ?? false,
        //                     'approved_on' => $scheme['approved_in'],
        //                     // 'imis_id' => $scheme['id'],
        //                     'slssc_year' => $scheme['slssc_year'],
        //                     'no_of_villages' => $scheme['no_villages'],
        //                     'total_cost' => $scheme['est_cost'] * 100000,
        //                     'central_share' => $scheme['central_share'] * 100000,
        //                     'state_share' => $scheme['state_share'] * 100000,
        //                     'planned_fhtc' => $scheme['planned_fhtc'] * 100000,
        //                 ]);

        //                 $schemeFound = Scheme::with('division.circle')->where('id', $schemeNew->id)->first();
        //                 $contractorFound = ContractorDetail::with('user')->where('old_contractor_id', $scheme['contractor_id'])->first();

        //                 if ($schemeFound) {
        //                     $workorder = Workorder::create([
        //                         // 'pkg_id' => $scheme['pkg_id'],
        //                         'old_workorder_id' => $scheme['work_order_id'],
        //                         // 'issuing_authority' => $scheme['name'],
        //                         'contractor_id' => $contractorFound && $contractorFound->user ? $contractorFound?->user?->id : null,
        //                         'circle_id' => $schemeFound->division->circle->id,
        //                         'workorder_number' => $scheme['order_no'],
        //                         'workorder_funding_agency' => null,
        //                         'workorder_amount' => $scheme['work_value'] * 100000,
        //                         'workorder_type' => 'work',
        //                         'workorder_status' => 'ongoing',
        //                         // 'workorder_estimated_date' => $scheme['end_date'],
        //                         'formal_workorder_date' => $scheme['order_date'],
        //                         'formal_workorder_number' => $scheme['order_no'],
        //                     ]);

        //                     $workorder->schemes()->sync($schemeFound->id);

        //                     if (!blank($scheme['wo_pic'])) {
        //                         $imageUrl = 'https://jjmassam.in/crs/workorder_detail/' . $scheme['wo_pic'];

        //                         // Get the file name and extension
        //                         $fileName = pathinfo($imageUrl, PATHINFO_FILENAME);
        //                         $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);

        //                         // Get the file size
        //                         $headers = get_headers($imageUrl, true);
        //                         $fileSize = isset($headers['Content-Length']) ? $headers['Content-Length'] : 0;

        //                         $originalName = $fileName . '.' . $extension;

        //                         // $fileContents = file_get_contents($imageUrl);
        //                         // $path = Storage::disk('workorderdocs')->put($originalName, $fileContents);

        //                         Workdocument::create([
        //                             'workorder_id' => $workorder->id,
        //                             'name' => $fileName,
        //                             'path' => $originalName,
        //                             'size' => $fileSize,
        //                             'extension' => $extension,
        //                         ]);

        //                     }
        //                 }
        //             }
        //         }
        //         $progressBar->advance();

        //     }
        //     $progressBar->finish();

        //     $this->line('');

        //     // the info method will display in the console as green colored text:
        //     $this->info('Imported Successfully!');
        // });
        try {
            DB::transaction(function () {
                $csv = Reader::createFromPath(base_path('database/schemes-jjmassam.csv'), 'r');
                $csv->setHeaderOffset(0);
                // $header = $csv->getHeader(); // get the CSV header row
                $records = $csv->getRecords(); // get all the records

                $progressBar = $this->output->createProgressBar(count($csv));
                $this->line('Schemes importing...');
                $progressBar->start();

                foreach ($records as $scheme) {

                    // $data[] = $scheme['id'];

                    Scheme::withoutEvents(function () use ($scheme, $progressBar) {

                        $hasScheme = Scheme::where('old_scheme_id', $scheme['id'])->exists();

                        if (!$hasScheme) {
                            $division = Division::where('old_division_id', $scheme['division'])->first();

                            if ($division) {
                                $status = match ($scheme['status']) {
                                    'Alloted' => SchemeStatus::ALLOTED,
                                    'Active' => SchemeStatus::ACTIVE,
                                };

                                if (isset($scheme['tea_garden'])) {
                                    $hasTeaGarden = match ($scheme['tea_garden']) {
                                        'Yes' => true,
                                        'No' => false,
                                        '1' => true,
                                        '0' => false,
                                        default => false
                                    };
                                }

                                if ($scheme['parant_scheme']) {
                                    $parentScheme = Scheme::where('old_scheme_id', $scheme['parant_scheme'])->first();
                                    $parentId = $parentScheme?->id ?? null;
                                }

                                $schemeNew = Scheme::create([
                                    'division_id' => $division->id,
                                    'district_id' => $scheme['district'],
                                    'lac_id' => $scheme['lac_id'],
                                    'block_id' => isset($scheme['block']) ? ($scheme['block'] == '' ? null : intval($scheme['block'])) : null,
                                    'name' => $scheme['scheme_name'],
                                    'old_scheme_id' => $scheme['id'],
                                    'scheme_type' => $scheme['scheme_type'],
                                    'scheme_status' => $status,
                                    'has_tea_garden' => $hasTeaGarden ?? false,
                                    'approved_on' => $scheme['approved_in'],
                                    // 'imis_id' => $scheme['id'],
                                    'slssc_year' => $scheme['slssc_year'],
                                    'no_of_villages' => $scheme['no_villages'],
                                    'total_cost' => floatval($scheme['est_cost']) * 100000,
                                    'central_share' => floatval($scheme['central_share']) * 100000,
                                    'state_share' => floatval($scheme['state_share']) * 100000,
                                    'planned_fhtc' => $scheme['no_fhtc'],
                                    'parent_id' => $scheme['parant_scheme'] ? $parentId : null,
                                ]);

                                $schemeFound = Scheme::with('division.circle')->where('id', $schemeNew->id)->first();
                                $contractorFound = ContractorDetail::with('user')->where('old_contractor_id', $scheme['contractor_id'])->first();

                                Scheme::withoutEvents(function () use ($schemeFound, $contractorFound, $scheme) {
                                    if ($schemeFound) {
                                        $workorder = Workorder::create([
                                            // 'pkg_id' => $scheme['pkg_id'],
                                            'old_workorder_id' => (int)$scheme['work_order_id'],
                                            // 'issuing_authority' => $scheme['name'],
                                            'contractor_id' => $contractorFound && $contractorFound->user ? $contractorFound?->user?->id : null,
                                            'circle_id' => $schemeFound->division->circle->id,
                                            'division_id' => $schemeFound->division_id,
                                            'workorder_number' => $scheme['order_no'],
                                            'workorder_funding_agency' => null,
                                            'workorder_amount' => floatval($scheme['work_value']) * 100000,
                                            'workorder_type' => 'work',
                                            'workorder_status' => 'ongoing',
                                            // 'workorder_estimated_date' => isset($scheme['end_date']) ? ($scheme['end_date'] == '' ? null : $scheme['end_date']) : null,
                                            // 'formal_workorder_date' => isset($scheme['order_date']) ? ($scheme['order_date'] == '' ? null : $scheme['order_date']) : null,
                                            'formal_workorder_number' => $scheme['order_no'] ?? null,
                                            'fhtc_no' => (int)$scheme['fhtc_no'],
                                        ]);

                                        $workorder->schemes()->sync($schemeFound->id);

                                        if (!blank($scheme['wo_pic'])) {
                                            $imageUrl = 'https://jjmassam.in/crs/workorder_detail/' . $scheme['wo_pic'];

                                            // Get the file name and extension
                                            $fileName = pathinfo($imageUrl, PATHINFO_FILENAME);
                                            $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);

                                            // Get the file size
                                            $headers = get_headers($imageUrl, true);
                                            $fileSize = isset($headers['Content-Length']) ? $headers['Content-Length'] : 0;

                                            $originalName = $fileName . '.' . $extension;

                                            // $fileContents = file_get_contents($imageUrl);
                                            // $path = Storage::disk('workorderdocs')->put($originalName, $fileContents);

                                            Workdocument::create([
                                                'workorder_id' => $workorder->id,
                                                'name' => $fileName,
                                                'path' => $originalName,
                                                'size' => $fileSize,
                                                'extension' => $extension,
                                            ]);

                                        }
                                    }
                                });
                            }
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
