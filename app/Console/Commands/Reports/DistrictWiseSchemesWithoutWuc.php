<?php

namespace App\Console\Commands\Reports;

use App\Models\District;
use App\Models\Report;
use App\Models\Scheme;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class DistrictWiseSchemesWithoutWuc extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:district-wise-schemes-without-wuc';

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
        $districts = District::orderBy('name', 'asc')->select('name', 'id')->get();
        foreach($districts as $district){
            $data = [];
            $schemes = Scheme::query()
                ->where('district_id', $district->id)
                ->doesntHave('wucs')
                ->with('district', 'division', 'villages')
                ->lazy();
            foreach ($schemes as $scheme) {
                $data[] = [
                    'district' => $scheme->district?->name,
                    'division' => $scheme->division?->name,
                    'village_name' => $scheme->villages?->pluck('village_name')->join(','),
                    'scheme_name' => $scheme->name,
                    'imis_id' => $scheme->imis_id,
                    'smt' => $scheme->old_scheme_id,
                    'work_status' => $scheme->work_status?->label() ?? '-'
                ];
            }
            if (count($data)) {
                $fileName = str_replace(' ', '', $district->name);
                $hashedName = $this->generateAndUpload($data, $fileName . '_scheme_without_wuc.csv', 'reports');
                $this->line($hashedName);
                $this->line('  ');
                Report::create([
                    'report_number' => 'DTSWTW',
                    'title' => $district->name . " Scheme's where WUC is not uploaded",
                    'category' => Report::CATEGORY_DISTRICT_WISE_SCHEMES_WITHOUT_WUC,
                    'file' => $hashedName,
                    'district_id' => $district->id,
                ]);
            }
        }
    }
}
