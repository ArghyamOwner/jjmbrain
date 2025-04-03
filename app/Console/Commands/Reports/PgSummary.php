<?php

namespace App\Console\Commands\Reports;

use App\Models\Report;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PgSummary extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:pg-summary';

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
        $issuingAuthorities = DB::table('workorders')
            ->join('performance_guarantee_workorder', 'workorders.id', '=', 'performance_guarantee_workorder.workorder_id')
            ->join('performance_guarantees', 'performance_guarantee_workorder.performance_guarantee_id', '=', 'performance_guarantees.id')
            ->select('workorders.issuing_authority', DB::raw('COUNT(performance_guarantees.id) as performance_guarantee_count'))
            ->groupBy('workorders.issuing_authority')
            ->orderBy('workorders.issuing_authority')
            ->lazy();

        if ($issuingAuthorities->isNotEmpty()) {
            $data = $issuingAuthorities->map(fn($data) => [
                'issuing_authority' => $data->issuing_authority,
                'performance_guarantee_count' => $data->performance_guarantee_count,
            ])->toArray();

            $hashedName = $this->generateAndUpload($data, 'issuingAuthority_wise_pg.csv', 'reports');

            $this->line($hashedName);
            $this->line('  ');

            Report::create([
                'report_number' => 'PGSR03',
                'title' => 'PG Summary Report',
                'category' => Report::CATEGORY_PG_SUMMARY_REPORT,
                'file' => $hashedName,
            ]);
        }
    }
}
