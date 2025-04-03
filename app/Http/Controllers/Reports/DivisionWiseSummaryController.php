<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\Storage;

class DivisionWiseSummaryController extends Controller
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public function generate()
    {
        $file = Report::where('category', Report::CATEGORY_DIVISION_SUMMARY_REPORT)->today()->first();

        if (!$file) {
            $this->banner('Unable to Download Report', 'danger');
            return redirect()->route('reports');
        }
        return Storage::disk('reports')->download($file->file);

        // $divisionsData = DB::table('divisions as d')
        //     ->leftJoin('schemes as s', 'd.id', '=', 's.division_id')
        // // ->leftJoin('lithologs as l', 's.id', '=', 'l.scheme_id')
        // // ->leftJoin('scheme_qr_reports as qr', 's.id', '=', 'qr.scheme_id') // Join with scheme_qr_reports
        //     ->select(
        //         'd.id',
        //         'd.name as division_name',
        //         DB::raw('COUNT(s.id) as total_schemes'),
        //         DB::raw('COUNT(CASE WHEN s.work_status = "handed-over" THEN 1 END) as handedover_schemes'),
        //         DB::raw('COUNT(DISTINCT s.user_id) as jalmitra_assigned'),
        //         DB::raw('COUNT(CASE WHEN (s.work_status = "handed-over" AND s.user_id IS NOT NULL) THEN 1 END) as jalmitra_assigned_handedover_schemes'),
        //         // DB::raw('COUNT(l.id) as total_lithologs'),
        //         // DB::raw('COUNT(CASE WHEN (l.show_diagram = 1) THEN 1 END) as complete_litholog'),
        //         // DB::raw('COUNT(CASE WHEN (l.show_diagram = 0) THEN 1 END) as incomplete_litholog'),
        //         DB::raw('SUM(CASE WHEN s.consumer_no IS NULL THEN 0 ELSE 1 END) as apdcl_consumer_no'),
        //         // DB::raw('COUNT(DISTINCT qr.id) as total_qr_installed') // Count of total QR installed
        //     )
        //     ->where('s.is_archived', '=', 0)
        //     ->groupBy('d.id', 'd.name')
        //     ->orderBy('d.name')
        //     ->lazy();

        // if ($divisionsData->isNotEmpty()) {
        //     $divs = $divisionsData->map(fn($data) => [
        //         'division' => $data->division_name,
        //         'total_schemes' => $data->total_schemes,
        //         'handedover_schemes' => $data->handedover_schemes,
        //         'jalmitra_assigned' => $data->jalmitra_assigned,
        //         'JM_assigned_handedover_schemes' => $data->jalmitra_assigned_handedover_schemes,
        //         'total_lithologs' => Litholog::whereRelation('scheme', 'division_id', $data->id)->count(),
        //         'complete_lithologs' => Litholog::whereRelation('scheme', 'division_id', $data->id)->where('show_diagram', 1)->count(),
        //         'incomplete_lithologs' => Litholog::whereRelation('scheme', 'division_id', $data->id)->where('show_diagram', 0)->count(),
        //         'apdcl_consumer_no' => $data->apdcl_consumer_no,
        //         'qr_installed' => Scheme::where('division_id', $data->id)->whereHas('schemeQrReports')->count(),
        //         'wucs' => Wuc::whereRelation('schemes', 'division_id', $data->id)->count(),
        //     ])->toArray();

        //     return $this->exportToCsv($divs, 'divisionSummaryReport.csv');
        // } else {
        //     $this->banner('Data not found');
        //     return redirect()->back();
        // }
    }
}
