<?php

namespace App\Console\Commands\Reports;

use App\Models\District;
use App\Models\Report;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class DistrictWiseJalshalaJaldootSummary extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:district-wise-jalshala-jaldoot-summary';

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
            ->withCount(['plannedJalshalas', 'organisedJalshalas'])
            ->with([
                'jalshalas' => function ($query) {
                    $query->withCount('jalshalaSchoolsJaldoots');
                }])
            ->orderBy('name')->lazy();

        if ($districtData->isNotEmpty()) {
            $data = $districtData->map(fn($data) => [
                'district' => $data->name,
                'planned_jalshalas' => $data->planned_jalshalas_count,
                'organised_jalshalas' => $data->organised_jalshalas_count,
                'jalshala_schools_jaldoots' => $data->jalshalas->sum('jalshala_schools_jaldoots_count'),
            ])->toArray();

            $hashedName = $this->generateAndUpload($data, 'jalshala_summary.csv', 'reports');
            $this->line($hashedName);
            $this->line('  ');
            Report::create([
                'report_number' => 'DTJSJD',
                'title' => 'Jalshala and Jaldoot Summary',
                'category' => Report::CATEGORY_DISTRICT_WISE_JALSHALA_SUMMARY,
                'file' => $hashedName,
            ]);
        }
    }
}
