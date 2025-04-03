<?php

namespace App\Console\Commands\Reports;

use App\Models\District;
use App\Models\Report;
use App\Models\School;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class DistrictWiseSchools extends Command
{
    use WithGenerateAndUploadCsv;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:district-wise-schools';

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
        $districts = District::select('name', 'id')->orderBy('name', 'asc')->get();

        foreach ($districts as $district) {
            $districtWiseSchools = School::query()
                ->with('educationBlock')
                ->where('district_id', $district->id)
                ->orderBy("school_name")
                ->lazy();

            $data = [];

            foreach ($districtWiseSchools as $school) {
                $data[] = [
                    "District" => $district->name,
                    "Education-Block" => $school->educationBlock?->block_name,
                    "UDISE_Code" => $school->school_code,
                    "School_Name" => $school->school_name,
                    "Category" => $school->category,
                    "Latitude" => $school->latitude,
                    "Longitude" => $school->longitude,
                ];
            }

            if (count($data)) {
                $fileName = str_replace(' ', '', $district->name);
                $hashedName = $this->generateAndUpload($data, $fileName . '_school_report.csv', 'reports');
                $this->line($hashedName);
                $this->line('  ');
                Report::create([
                    'report_number' => 'DISTSCH',
                    'title' => $district->name . " School's Report",
                    'category' => Report::CATEGORY_DISTRICT_WISE_SCHOOLS,
                    'file' => $hashedName,
                    'district_id' => $district->id,
                ]);
            }
        }
    }
}
