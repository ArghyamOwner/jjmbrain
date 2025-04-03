<?php

namespace App\Console\Commands\Reports;

use App\Models\District;
use App\Models\Report;
use App\Models\Wuc;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class DistrictWiseWuc extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:district-wise-wuc';

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
            $data = [];
            $wucs = Wuc::query()
                ->with(
                    "district:id,name",
                    "schemes:id,name",
                    "schemes.villages",
                    "schemes.panchayats",
                    "isas:id,name,type",
                    "wucPresidents",
                    'block:id,name')
                ->where('district_id', $district->id)
                ->lazy();
            foreach ($wucs as $wuc) {
                $data[] = [
                    "District" => $wuc->district?->name,
                    "Block" => $wuc->block?->name,
                    "Panchayats of Scheme" => $wuc->schemes?->pluck("panchayat_names")->join(","),
                    "WUC Name" => $wuc->name,
                    "Villages of Scheme" => $wuc->schemes?->pluck("village_names")->join(","),
                    "Schemes" => $wuc->scheme_names,
                    "Formation Date" => $wuc->formation_date?->format("d/m/Y"),
                    "President Name" => $wuc->wucPresidents?->pluck("name")->join(","),
                    "President Phone" => $wuc->wucPresidents?->pluck("phone")->join(","),
                    "Account Number Status" => $wuc->account_number ? "Yes" : "No",
                    "ISA Name" => $wuc->isas?->first()?->name,
                    "ISA Type" => $wuc->isas?->first()?->type,
                ];
            }
            if (count($data)) {
                $fileName = str_replace(' ', '', $district->name);
                $hashedName = $this->generateAndUpload($data, $fileName . '_wuc_report.csv', 'reports');
                $this->line($hashedName);
                $this->line('  ');
                Report::create([
                    'report_number' => 'DTWUCR',
                    'title' => $district->name . ' WUC report',
                    'category' => Report::CATEGORY_DISTRICT_WISE_WUC,
                    'file' => $hashedName,
                    'district_id' => $district->id,
                ]);
            }
        }
    }
}
