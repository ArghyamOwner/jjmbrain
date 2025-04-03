<?php

namespace App\Console\Commands\Reports;

use App\Models\District;
use App\Models\Report;
use App\Models\Village;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class DistrictWiseIsa extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:district-wise-isa';

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
            $districtVillagesWithISAS = Village::query()
                ->with("isas", "panchayat.block")
                ->whereHas("panchayat.block.district", function ($query) use ($district) {
                    $query->where("id", $district->id);
                })
                ->orderBy("village_name")
                ->lazy();

            $data = [];    

            foreach ($districtVillagesWithISAS as $dataW) {
                $data[] = [
                    "DISTRICT" => $district->name,
                    "BLOCK" => $dataW->panchayat->block->name,
                    "VILLAGE_NAME" => $dataW->village_name,
                    "GP" => $dataW->panchayat?->panchayat_name,
                    "ISA" => $dataW->isas->isNotEmpty() ? "Yes" : "No",
                    "ISA Type" => $dataW->isas?->pluck("type")?->join(" | "),
                    "Name" => $dataW->isas?->pluck("name")?->join(" | "),
                    "Contact Person" => $dataW->isas?->pluck("contact_name")?->join(" | "),
                    "Contact Phone" => $dataW->isas?->pluck("contact_phone")?->join(" | "),
                ];
            }

            if (count($data)) {
                $fileName = str_replace(' ', '', $district->name);
                $hashedName = $this->generateAndUpload($data, $fileName . '_isa_report.csv', 'reports');
                $this->line($hashedName);
                $this->line('  ');
                Report::create([
                    'report_number' => 'DTISAR',
                    'title' => $district->name . ' ISA Report',
                    'category' => Report::CATEGORY_DISTRICT_WISE_ISA,
                    'file' => $hashedName,
                    'district_id' => $district->id,
                ]);
            }
        }
    }
}
