<?php

namespace App\Console\Commands\Reports;

use App\Models\Report;
use App\Models\Scheme;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class SchemeWithLatestFlowmeterReading extends Command
{
    use WithGenerateAndUploadCsv;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:scheme-with-latest-flowmeter-reading';

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
        $schemeLazyCollection = Scheme::query()
            ->select('id', 'name', 'old_scheme_id', 'imis_id', 'division_id', 'user_id')
            ->with([
                'division:id,name',
                'subdivisions:id,name',
                'user:id,name,phone',
                'user.latestSchemeActivity',
                'users:id,name',
                'panchayats',
                'blocks',
                'schemeDailyFlowmeter',
            ])
            ->withCount(['flowmeterDetails as latest_flowmeter' => function ($query) {
                $query->where('created_at', '>=', now()->subDays(7));
            }])
            ->withWhereHas('latestFlowmeterDetail')
            ->lazy();
        if ($schemeLazyCollection->isNotEmpty()) {
            $startDate = now()->subDays(7)->format('d-m-Y');
            $endDate = now()->format('d-m-Y');
            $schemes = $schemeLazyCollection->map(fn($data) => [
                'name' => str_replace(',', '-', $data->name),
                'SMT_id' => $data->old_scheme_id,
                'imis_id' => $data->imis_id,
                'division' => $data->division?->name,
                'subdivision' => $data->subdivision_names,
                'block(s)' => $data->block_names_csv,
                'GP(s)' => $data->panchayat_names_csv,
                'jalmitra_name' => $data->user?->name,
                'jalmitra_phone' => $data->user?->phone,
                'latest_activity_at' => $data->user?->latestSchemeActivity?->created_at?->format('d-m-Y'),
                'section-officers' => $data->so_names,
                'latest_meter_reading' => $data->latestFlowmeterDetail?->value,
                'latest_meter_reading_date' => $data->latestFlowmeterDetail?->created_at?->format('d-m-Y'),
                'Latest Bulk flow meter working Status' => $data->schemeDailyFlowmeter?->status,
                'Latest Bulk flow meter working Status updated date' => $data->schemeDailyFlowmeter?->updated_at?->format('d-m-Y'),
                "No of bulk flow meter reading uploaded  in last 1 week (last seven days) {$startDate} to {$endDate}" => $data->latest_flowmeter,
            ])->toArray();
            $hashedName = $this->generateAndUpload($schemes, 'schemes_with_flowmeter.csv', 'reports');
            $this->line($hashedName);
            $this->line('  ');
            Report::create([
                'report_number' => 'FMR001',
                'title' => 'Scheme-wise Jal-Mitra reporting of Flowmeter Reading',
                'category' => Report::CATEGORY_LATEST_FLOWMETER_SCHEME,
                'file' => $hashedName
            ]);
        }
    }
}
