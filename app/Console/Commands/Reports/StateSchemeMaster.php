<?php

namespace App\Console\Commands\Reports;

use App\Models\Report;
use App\Models\Scheme;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class StateSchemeMaster extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:state-scheme-master';

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
            ->with(
                'district:id,name',
                'division:id,name',
                'blocks',
                'lac:id,name',
                'user:id,name,doj',
                'latestSchemeArchiveRequest',
                'latestSchemeArchiveRequest.createdBy:id,name',
            )->withExists(['lithologs', 'workorders', 'schemeQrReports', 'wucs']);

        $allSchemes = [];

        $schemeLazyCollection->chunk(1000, function ($schemes) use ($allSchemes) {
            foreach ($schemes as $data) {
                $scheme = [
                    'name' => $data->name,
                    'SMT_id' => $data->old_scheme_id,
                    'imis_id' => $data->imis_id,
                    'scheme_type' => $data->scheme_type?->name,
                    'division' => $data->division?->name,
                    'district' => $data->district?->name,
                    'block' => $data->block_names,
                    'work_status' => $data->work_status?->name,
                    'operating_status' => $data->operating_status?->name,
                    'scheme_status' => $data->scheme_status?->name,
                    'villages' => $data->village_names,
                    'lac' => $data->lac?->name,
                    'approved_on' => $data->approved_on,
                    'slssc_year' => $data->slssc_year,
                    'planned_fhtc' => $data->planned_fhtc,
                    'achieved_fhtc' => $data->achieved_fhtc,
                    'section-officers' => $data->so_names,
                    'jalmitra_name' => $data->user?->name,
                    'jalmitra_doj' => $data->user?->doj?->format('Y-m-d'),
                    'handover_date' => $data->handover_date?->format('Y-m-d'),
                    'state_share' => $data->state_share,
                    'central_share' => $data->central_share,
                    'total_cost' => $data->total_cost,
                    'consumer_no' => $data->consumer_no,
                    'latitude' => $data->latitude,
                    'longitude' => $data->longitude,
                    'has_litholog' => $data->lithologs_exists ? 'Yes' : 'No',
                    'has_workorder' => $data->workorders_exists ? 'Yes' : 'No',
                    'has_wuc' => $data->wucs_exists ? 'Yes' : 'No',
                    'Verification_status' => $data->verified_on ? 'Yes' : 'No',
                    'archive_request_date' => $data->latestSchemeArchiveRequest?->created_at?->format('Y-m-d'),
                    'archive_requested_by' => $data->latestSchemeArchiveRequest?->createdBy?->name,
                    'qr_installed' => $data->scheme_qr_reports_exists ? 'Yes' : 'No',
                    'child_scheme' => $data->parent_id ? 'Yes' : 'No',
                ];

                $allSchemes[] = $scheme;
            }
        });

        if (!empty($allSchemes)) {
            $fileName = 'state-master-schemes';
        
            $hashedName = $this->generateAndUpload($allSchemes, $fileName . '_schemes.csv', 'reports');
        
            $this->line($hashedName);
            $this->line('  ');
        
            Report::create([
                'report_number' => 'SMR001',
                'title' => 'Scheme Master Details',
                'category' => Report::CATEGORY_STATE_MASTER_SCHEME,
                'file' => $hashedName,
            ]);
        }

        // if ($schemeLazyCollection->isNotEmpty()) {
        //     $schemes = $schemeLazyCollection->map(fn($data) => [
        //         'name' => $data->name,
        //         'SMT_id' => $data->old_scheme_id,
        //         'imis_id' => $data->imis_id,
        //         'scheme_type' => $data->scheme_type?->name,
        //         'division' => $data->division?->name,
        //         'district' => $data->district?->name,
        //         'block' => $data->block_names,
        //         'work_status' => $data->work_status?->name,
        //         'operating_status' => $data->operating_status?->name,
        //         'scheme_status' => $data->scheme_status?->name,
        //         'villages' => $data->village_names,
        //         'lac' => $data->lac?->name,
        //         'approved_on' => $data->approved_on,
        //         'slssc_year' => $data->slssc_year,
        //         'planned_fhtc' => $data->planned_fhtc,
        //         'achieved_fhtc' => $data->achieved_fhtc,
        //         'section-officers' => $data->so_names,
        //         'jalmitra_name' => $data->user?->name,
        //         'jalmitra_doj' => $data->user?->doj?->format('Y-m-d'),
        //         'handover_date' => $data->handover_date?->format('Y-m-d'),
        //         'state_share' => $data->state_share,
        //         'central_share' => $data->central_share,
        //         'total_cost' => $data->total_cost,
        //         'consumer_no' => $data->consumer_no,
        //         'latitude' => $data->latitude,
        //         'longitude' => $data->longitude,
        //         'has_litholog' => $data->lithologs_exists ? 'Yes' : 'No',
        //         'has_workorder' => $data->workorders_exists ? 'Yes' : 'No',
        //         'has_wuc' => $data->wucs_exists ? 'Yes' : 'No',
        //         'Verification_status' => $data->verified_on ? 'Yes' : 'No',
        //         'archive_request_date' => $data->latestSchemeArchiveRequest?->created_at?->format('Y-m-d'),
        //         'archive_requested_by' => $data->latestSchemeArchiveRequest?->createdBy?->name,
        //         'qr_installed' => $data->scheme_qr_reports_exists ? 'Yes' : 'No',
        //         'child_scheme' => $data->parent_id ? 'Yes' : 'No',
        //     ])->toArray();

        //     $fileName = 'state-master-schemes';

        //     $hashedName = $this->generateAndUpload($schemes, $fileName . '_schemes.csv', 'reports');

        //     $this->line($hashedName);
        //     $this->line('  ');

        //     Report::create([
        //         'report_number' => 'SMR001',
        //         'title' => 'Scheme Master Details',
        //         'category' => Report::CATEGORY_STATE_MASTER_SCHEME,
        //         'file' => $hashedName,
        //     ]);
        // }
    }
}
