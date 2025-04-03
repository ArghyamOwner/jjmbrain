<?php

namespace App\Console\Commands\Reports;

use App\Models\District;
use App\Models\Report;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class DistrictSummary extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:district-summary';

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
        $districtData = District::query()
            ->withCount(['wucs', 'schemes', 'villages'])
            ->orderBy('name')->lazy();

        if ($districtData->isNotEmpty()) {
            $data = $districtData->map(fn($data) => [
                'District' => $data->name,
                'Villages' => $data->villages_count,
                'Schemes' => $data->schemes_count,
                'WUCs_Created' => $data->wucs_count,
                'WUCs_Pending' => $data->schemes_count - $data->wucs_count,
            ])->toArray();
            $hashedName = $this->generateAndUpload($data, 'district_summary.csv', 'reports');
            $this->line($hashedName);
            $this->line('  ');
            Report::create([
                'report_number' => 'DTVSWR',
                'title' => 'District Wise Summary of Villages, Schemes & WUCs ',
                'category' => Report::CATEGORY_DISTRICT_SUMMARY,
                'file' => $hashedName,
            ]);
        }
    }
}
