<?php

namespace App\Console\Commands\Reports;

use App\Models\Division;
use App\Models\Report;
use App\Models\Scheme;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class DivisionWisePipeNetwork extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:division-wise-pipe-network';

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
        $divisions = Division::orderBy('name', 'asc')->select('name', 'id')->get();
        foreach ($divisions as $division) {
            $schemes = Scheme::query()
                ->with([
                    'district:id,name',
                    'workorders:id,contractor_id',
                    'workorders.contractor:id,name,phone',
                    'workorders.contractor.contractor:id,user_id,bid_no',
                    'users:id,name,phone',
                    'latestSchemePipeNetwork.verifiedBy:id,name',
                    'latestTrackedCanalTrackings',
                ])->withCount('beneficiaries')
                ->where('division_id', $division->id)
                ->orderBy('name')
                ->lazy();
            $data = $schemes->map(fn($data) => [
                'Division' => $division->name,
                'District' => $data->district?->name,
                'Scheme_Name' => $data->name,
                'IMIS_ID' => $data->imis_id ?? '-',
                'SMT_ID' => $data->old_scheme_id ?? '-',
                'FHTC_Planned' => $data->planned_fhtc ?? '-',
                'FHTC_Achieved' => $data->achieved_fhtc ?? '-',
                'TPI_Progress' => $data->tpi_progress ?? '-',
                'Bid_ID' => $data->workorders->map(fn($item) => $item?->contractor?->contractor?->bid_no)->implode(' | '),
                'Contractor_Name' => $data->workorders->pluck('contractor.name')->implode(" | "),
                'Contractor_Phone' => $data->workorders->pluck('contractor.phone')->implode(" | "),
                'SO_Name(s)' => $data->users->pluck('name')->implode(" | "),
                'SO_Phone' => $data->users->pluck('phone')->implode(" | "),
                'Json_File_Uploaded' => $data->latestSchemePipeNetwork ? 'Yes' : 'No',
                // 'Date_Mapped' => $data->latestSchemePipeNetwork?->created_at?->format('d-m-Y'),
                'Latest_Tracking_date' => $data->latestTrackedCanalTrackings?->updated_at?->format('d/m/Y'),
                'Verification_Status' => $data->latestSchemePipeNetwork?->verification_status,
                'Verification_date' => $data->latestSchemePipeNetwork?->verified_at?->format('d/m/Y'),
                'Verified_by' => $data->latestSchemePipeNetwork?->verifiedBy?->name,
                'FHTC_Mapped' => $data->beneficiaries_count,
            ])->toArray();
            if (count($data)) {
                $fileName = str_replace(' ', '', $division->name);
                $hashedName = $this->generateAndUpload($data, $fileName . 'distribution_report_.csv', 'reports');
                $this->line($hashedName);
                $this->line('  ');
                Report::create([
                    'report_number' => 'DVNETR',
                    'title' => $division->name . ' - Distribution Network Report',
                    'category' => Report::CATEGORY_DIVISION_PIPE_NETWORK,
                    'file' => $hashedName,
                    'division_id' => $division->id,
                ]);
            }
        }
    }
}
