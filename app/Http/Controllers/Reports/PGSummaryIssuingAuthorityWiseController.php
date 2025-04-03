<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PGSummaryIssuingAuthorityWiseController extends Controller
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public function generate()
    {
        $file = Report::where('category', Report::CATEGORY_PG_SUMMARY_REPORT)->today()->first();

        if (!$file) {
            $this->banner('Unable to Download Report', 'danger');
            return redirect()->route('reports');
        }
        return Storage::disk('reports')->download($file->file);
        
        // $issuingAuthorities = DB::table('workorders')
        //     ->join('performance_guarantee_workorder', 'workorders.id', '=', 'performance_guarantee_workorder.workorder_id')
        //     ->join('performance_guarantees', 'performance_guarantee_workorder.performance_guarantee_id', '=', 'performance_guarantees.id')
        //     ->select('workorders.issuing_authority', DB::raw('COUNT(performance_guarantees.id) as performance_guarantee_count'))
        //     ->groupBy('workorders.issuing_authority')
        //     ->orderBy('workorders.issuing_authority')
        //     ->lazy();

        // if ($issuingAuthorities->isNotEmpty()) {
        //     $data = $issuingAuthorities->map(fn($data) => [
        //         'issuing_authority' => $data->issuing_authority,
        //         'performance_guarantee_count' => $data->performance_guarantee_count,
        //     ])->toArray();

        //     return $this->exportToCsv($data, 'issuingAuthority_wise_pg.csv');
        // } else {
        //     $this->banner('Data not found');
        //     return redirect()->back();
        // }
    }
}
