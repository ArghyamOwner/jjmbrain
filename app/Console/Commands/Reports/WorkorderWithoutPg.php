<?php

namespace App\Console\Commands\Reports;

use App\Models\Report;
use App\Models\Workorder;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class WorkorderWithoutPg extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:workorder-without-pg';

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
        $workorders = Workorder::query()
            ->with('circle', 'division', 'schemes:id,imis_id,old_scheme_id')
            ->doesntHave("performanceGuarantees")
            ->lazy();
        if ($workorders->isNotEmpty()) {
            $data = $workorders->map(fn($data) => [
                'Division' => $data->division?->name,
                'Office' => $data->circle?->name,
                'SMT_Workorder_Id' => $data->old_workorder_id,
                'Workorder Number' => $data->workorder_number,
                'Issuing Authority' => $data->issuing_authority,
                'Amount' => $data->workorder_amount,
                'Scheme_IMIS_ID(s)' => $data->schemes?->pluck('imis_id')?->join('|'),
                'Scheme_SMT_ID(s)' => $data->schemes?->pluck('old_scheme_id')?->join('|'),
            ])->toArray();
            $hashedName = $this->generateAndUpload($data, 'workorders_without_pg.csv', 'reports');
            $this->line($hashedName);
            $this->line('  ');
            Report::create([
                'report_number' => 'WOWTPG',
                'title' => 'List of Workorders Without Performance Guarantee',
                'category' => Report::CATEGORY_WORKORDERS_WITHOUT_PG,
                'file' => $hashedName,
            ]);
        }
    }
}
