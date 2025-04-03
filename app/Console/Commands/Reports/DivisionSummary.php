<?php

namespace App\Console\Commands\Reports;

use App\Models\Division;
use App\Models\Litholog;
use App\Models\Report;
use App\Models\Scheme;
use App\Models\Wuc;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DivisionSummary extends Command
{
    use WithGenerateAndUploadCsv;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:division-summary';

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
        $divisionsData = DB::table('divisions as d')
            ->leftJoin('schemes as s', 'd.id', '=', 's.division_id')
            ->select(
                'd.id',
                'd.name as division_name',
                DB::raw('COUNT(s.id) as total_schemes'),
                DB::raw('SUM(CASE WHEN s.parent_id IS NULL THEN 1 ELSE 0 END) as parent_schemes'),
                DB::raw('SUM(CASE WHEN s.parent_id IS NOT NULL THEN 1 ELSE 0 END) as child_schemes'),
                DB::raw('COUNT(CASE WHEN s.work_status = "handed-over" THEN 1 END) as handedover_schemes'),
                DB::raw('COUNT(DISTINCT s.user_id) as jalmitra_assigned'),
                DB::raw('COUNT(CASE WHEN (s.work_status = "handed-over" AND s.user_id IS NOT NULL) THEN 1 END) as jalmitra_assigned_handedover_schemes'),
                DB::raw('SUM(CASE WHEN s.consumer_no IS NULL THEN 0 ELSE 1 END) as apdcl_consumer_no'),
            )
            ->where('s.is_archived', '=', 0)
            ->groupBy('d.id', 'd.name')
            ->orderBy('d.name')
            ->lazy();

        if ($divisionsData->isNotEmpty()) {
            $divs = $divisionsData->map(fn($data) => [
                'division' => $data->division_name,
                'total_schemes' => $data->total_schemes,
                'parent_schemes' => $data->parent_schemes,
                'child_schemes' => $data->child_schemes,
                'handedover_schemes' => $data->handedover_schemes,
                'jalmitra_assigned' => $data->jalmitra_assigned,
                'JM_assigned_handedover_schemes' => $data->jalmitra_assigned_handedover_schemes,
                'total_lithologs' => Litholog::whereRelation('scheme', 'division_id', $data->id)->count(),
                'complete_lithologs' => Litholog::whereRelation('scheme', 'division_id', $data->id)->where('show_diagram', 1)->count(),
                'incomplete_lithologs' => Litholog::whereRelation('scheme', 'division_id', $data->id)->where('show_diagram', 0)->count(),
                'apdcl_consumer_no' => $data->apdcl_consumer_no,
                'qr_installed' => Division::withCount('qrInstalledSchemes')->where('id', $data->id)->first()['qr_installed_schemes_count'],
                'wucs' => Wuc::whereRelation('schemes', 'division_id', $data->id)->count(),
                'schemes_with_flowmeter_reading' => Scheme::whereHas('latestFlowmeterDetail')->where('division_id', $data->id)->count(),
            ])->toArray();

            $hashedName = $this->generateAndUpload($divs, 'divisionSummaryReport.csv', 'reports');

            $this->line($hashedName);
            $this->line('  ');

            Report::create([
                'report_number' => 'DVSS02',
                'title' => 'Division Summary Report',
                'category' => Report::CATEGORY_DIVISION_SUMMARY_REPORT,
                'file' => $hashedName,
            ]);
        }
    }
}
