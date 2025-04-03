<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\PerformanceGuarantee;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;

class PgDetailReportController extends Controller
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public function generate()
    {
        $pgs = PerformanceGuarantee::query()
            ->select('id', 'pg_amount', 'contractor_id', 'expired_date')
            ->with(
                'workorders:id,workorder_number,workorder_amount',
                'workorders.schemes:id,name,old_scheme_id,imis_id',
                'contractor:id,name',
                'contractor.contractor:id,user_id,bid_no'
            )
            ->lazy();

        if ($pgs->isNotEmpty()) {
            $divs = $pgs->map(fn($data) => [
                'id' => $data->id,
                'Scheme' => $data->workorders?->pluck('scheme_names')->join('||'),
                'SMT_IDs' => $data->workorders?->pluck('scheme_smt_ids')->join('||'),
                'IMIS_IDs' => $data->workorders?->pluck('scheme_imis_ids')->join('||'),
                'Bid_ID' => $data->contractor?->contractor?->bid_no,
                'Contractor' => $data->contractor?->name,
                'Workorder_Nos' => $data->workorders?->pluck('workorder_number')->join('||'),
                'Workorder_Amount' => $data->workorders?->pluck('workorder_amount')->join('||'),
                'PG_Amount' => $data->pg_amount,
                'Expiry_Date' => $data->expired_date?->format('d-m-Y'),
            ])->toArray();
            return $this->exportToCsv($divs, 'pgDetailReport.csv');
        } else {
            $this->banner('Data not found');
            return redirect()->back();
        }
    }
}
