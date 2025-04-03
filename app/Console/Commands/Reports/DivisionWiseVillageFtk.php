<?php

namespace App\Console\Commands\Reports;

use App\Models\Division;
use App\Models\Report;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DivisionWiseVillageFtk extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:division-wise-village-ftk';

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
        $divisions = Division::select('name', 'id')->orderBy('name', 'asc')->get();
        foreach ($divisions as $division) {
            $query = "SELECT V.village_name AS village_name,
                    CASE WHEN F.id IS NOT NULL THEN 'Yes' ELSE 'No' END AS field_test_kits_data
                    -- F.assigned_person_name as assigned_person,
                    -- F.assigned_person_phone as assigned_person_phone,
                    -- F.brand_name as FTK_brand,
                    -- F.issue_date as issue_date
                FROM villages V
                LEFT JOIN field_test_kits F ON V.id = F.village_id
                WHERE V.panchayat_id IN (
                    SELECT P.id
                    FROM panchayats P
                    JOIN blocks B ON P.block_id = B.id
                    WHERE B.district_id IN (
                        SELECT district_id
                        FROM district_division
                        WHERE division_id = :division_id
                    )
                )
                ORDER BY V.village_name;";
            $villages = DB::select($query, ['division_id' => $division->id]);

            if (count($villages)) {
                $villagesData = collect($villages)->map(fn($data) => [
                    'division' => $division->name,
                    'village_name' => $data->village_name,
                    'ftk' => $data->field_test_kits_data,
                ])->toArray();
                $fileName = str_replace(' ', '', $division->name);
                $hashedName = $this->generateAndUpload($villagesData, $fileName . '_ftk.csv', 'reports');
                $this->line($hashedName);
                $this->line('  ');
                Report::create([
                    'report_number' => 'DVFTKR',
                    'title' => $division->name . ' Village FTK Report',
                    'category' => Report::CATEGORY_DIVISION_WISE_VILLAGE_FTK,
                    'file' => $hashedName,
                    'division_id' => $division->id,
                ]);
            }
        }
    }
}
