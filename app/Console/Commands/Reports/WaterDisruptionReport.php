<?php

namespace App\Console\Commands\Reports;

use App\Models\Report;
use App\Models\WaterReport;
use App\Traits\WithGenerateAndUploadCsv;
use Carbon\Carbon;
use Illuminate\Console\Command;

class WaterDisruptionReport extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:water-disruption-report';

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
        $waterReports = WaterReport::query()
            ->has('scheme')
            ->with(['scheme:id,name,imis_id,district_id,division_id,block_id', 'scheme.division', 'scheme.district', 'scheme.blocks', 'scheme.subdivisions', 'sectionOfficer:id,name', 'closedBy:id,name', 'approvedBy:id,name'])
            ->latest('id')
            ->lazy();
        if ($waterReports->isNotEmpty()) {
            // 'Resolved' => $data->resolved == 1 ? 'Yes' : 'No',
            // 'Resolved Date' => $data->resolved_date,
            // 'Remarks' => $data->remarks,
            // 'Closed By' => $data->closed_by?->name ?? null,
            // closed_by means so user
            // $this->line($waterReports[0]->scheme?->district ?? 'd');
            $data = $waterReports->map(fn($data) => [
                'District' => $data->scheme?->district?->name,
                'Division' => $data->scheme?->division?->name,
                'Sub-Division' => $data->scheme?->subdivision_names,
                'Blocks' => $data->scheme?->blocks?->map(fn($block) => $block->name ?? null)?->implode(', ') ?? null,
                'GP' => str_replace(',', ' |', $data->scheme?->panchayat_names),
                'Scheme Name' => str_replace(',', '-', $data->scheme->name),
                'IMIS ID' => $data->scheme?->imis_id ?? null,
                'Previous Operating Status' => $data->operating_status_from?->value,
                'Requested Operating Status' => $data->operating_status?->value,
                'Issue Reported By' => $data->sectionOfficer?->name ?? '--',
                'Specific Reasons' => $data->filtered_specific_reasons,
                'Reasons Disruption' => $data->filtered_reasons_disruption,
                'Date of Reporting' => $data->created_at?->format('d F, Y') ?? '--',
                'No of days required for reslution' => $data->days,
                'Days Remaining' => max(0, now()->diffInDays($data->created_at->addDays($data->days ?? 0), false)),
                'Issue Resolved By' => $data->resolved_date != null ?  ($data->sectionOfficer?->name ?? null) : null,
                'Resolution reported on' => $data->resolved_date?->format('d F, Y') ?? '--', // SO
                'Resolution approved on' => $data->closedBy != null ? $data->updated_at?->format('d F, Y') : '--', // SDO
                'Resolution approved by' => $data->closedBy?->name ?? '--', // SDO
                'Status' => $data->status, 
            ])->toArray();
            // $this->line($data[0]['Issue Reported By']);
            $startDate = Carbon::now();
            $hashedName = $this->generateAndUpload($data, "water_disruption_{$startDate->format('Y-m-d')}.csv", 'reports');
            $this->line($hashedName);
            $this->line('  ');
            Report::create([
                'report_number' => 'WDRREP',
                'title' => 'Water Disruption Report',
                'category' => Report::CATEGORY_WATER_DISRUPTION_WEEKLY_REPORT,
                'file' => $hashedName,
                // 'block_id' => $blockId,
                // 'division_id' => $divisionId,
                // 'district_id' => $districtID,
            ]);
        }
    }
}
