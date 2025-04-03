<?php

namespace App\Console\Commands\Reports;

use App\Models\Division;
use App\Models\Report;
use App\Models\Wuc;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class DivisionWiseHandoverSummary extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:division-wise-handover-summary';

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
        $divisionsData = Division::query()
            ->select('id', 'name')
            ->withCount([
                'schemes as schemes_count' => function ($query) {
                    $query->whereNull('parent_id');
                },
                'handedoverSchemes as handedover_schemes_count' => function ($query) {
                    $query->whereNull('parent_id');
                },
                'schemesWithSo as schemes_with_so_count' => function ($query) {
                    $query->whereNull('parent_id');
                },
                'panchayatVerifiedSchemes as panchayat_verified_schemes_count' => function ($query) {
                    $query->whereNull('parent_id');
                },
                'jalmitraSchemes as jalmitra_schemes_count' => function ($query) {
                    $query->whereNull('parent_id');
                },
                'qrInstalledSchemes as qr_installed_schemes_count' => function ($query) {
                    $query->whereNull('parent_id');
                },
            ])
            ->orderBy('name')
            ->lazy();
        if ($divisionsData->isNotEmpty()) {
            $divs = $divisionsData->map(fn($data) => [
                'Division' => $data->name,
                'Schemes' => $data->schemes_count,
                'Handedover_Schemes' => $data->handedover_schemes_count,
                'Schemes_With_SO' => $data->schemes_with_so_count,
                'Panchayat_Verified_Schemes' => $data->panchayat_verified_schemes_count,
                'Jalmitra_Assigned' => $data->jalmitra_schemes_count,
                'QRCode_Installed' => $data->qr_installed_schemes_count,
                // 'Network_Tracked' => $data->tracked_canal_trackings_count,
                'WUCs' => Wuc::whereRelation('schemes', 'division_id', $data->id)->count(),
            ])->toArray();
            $hashedName = $this->generateAndUpload($divs, 'divisionHandoverSummaryReport.csv', 'reports');
            $this->line($hashedName);
            $this->line('  ');
            Report::create([
                'report_number' => 'DVHOSR',
                'title' => 'Division-Wise Ready to Handover Summary (Parent Schemes)',
                'category' => Report::CATEGORY_DIVISION_HANDOVER_SUMMARY,
                'file' => $hashedName,
            ]);
        }
    }
}
