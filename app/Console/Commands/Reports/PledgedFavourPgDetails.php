<?php

namespace App\Console\Commands\Reports;

use App\Models\PerformanceGuarantee;
use App\Models\Report;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class PledgedFavourPgDetails extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:pledged-favour-pg-details';

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
        $favours = PerformanceGuarantee::select('pledged_infavour_of')->groupBy('pledged_infavour_of')->orderBy('pledged_infavour_of', 'asc')->pluck('pledged_infavour_of')->all();
        foreach ($favours as $favour) {
            if ($favour) {
                $pgs = PerformanceGuarantee::query()
                    ->select('id', 'pg_amount', 'contractor_id', 'expired_date', 'pledged_infavour_of')
                    ->with(
                        'workorders:id,workorder_number,workorder_amount',
                        'workorders.schemes:id,name,old_scheme_id,imis_id',
                        'contractor:id,name',
                        'contractor.contractor:id,user_id,bid_no'
                    )
                    ->withSum('workorders', 'workorder_amount')
                    ->where('pledged_infavour_of', $favour)
                    ->get();
            } else {
                $pgs = PerformanceGuarantee::query()
                    ->select('id', 'pg_amount', 'contractor_id', 'expired_date', 'pledged_infavour_of')
                    ->with(
                        'workorders:id,workorder_number,workorder_amount',
                        'workorders.schemes:id,name,old_scheme_id,imis_id',
                        'contractor:id,name',
                        'contractor.contractor:id,user_id,bid_no'
                    )
                    ->withSum('workorders', 'workorder_amount')
                    ->whereNull('pledged_infavour_of')
                    ->get();
            }
            if ($pgs->isNotEmpty()) {
                $divs = $pgs->map(fn($data) => [
                    'Pledged_Infavour_Of' => $data->pledged_infavour_of,
                    'Scheme' => $data->workorders?->pluck('scheme_names')->join('||'),
                    'SMT_IDs' => $data->workorders?->pluck('scheme_smt_ids')->join('||'),
                    'IMIS_IDs' => $data->workorders?->pluck('scheme_imis_ids')->join('||'),
                    'Bid_ID' => $data->contractor?->contractor?->bid_no,
                    'Contractor' => $data->contractor?->name,
                    'Workorder_Nos' => $data->workorders?->pluck('workorder_number')->join('||'),
                    'Workorder_Amount' => $data->workorders?->pluck('workorder_amount')->join('||'),
                    'PG_Amount' => $data->pg_amount,
                    'PG_to_be_Submitted' => $data->workorders_sum_workorder_amount ? $data->workorders_sum_workorder_amount * 0.05 : '-',
                    'Expiry_Date' => $data->expired_date?->format('d/m/Y'),
                ])->toArray();
                $fileName = $favour ? preg_replace('/\s+/', '', $favour) . '.csv' : 'PgDetailsReport.csv';
                $hashedName = $this->generateAndUpload($divs, $fileName, 'reports');
                $this->line($hashedName);
                $this->line('  ');
                Report::create([
                    'report_number' => 'PGDETR',
                    'title' => $favour ? preg_replace('/\s+/', '', $favour) : ' Null Favour',
                    'category' => Report::CATEGORY_PLEDGED_FAVOR_PG_DETAIL,
                    'file' => $hashedName,
                ]);
            }
        }
    }
}
