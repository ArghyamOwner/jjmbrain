<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Workorder;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\Storage;

class WorkordersWithoutPgController extends Controller
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public function __invoke()
    {
        $file = Report::where('category', Report::CATEGORY_WORKORDERS_WITHOUT_PG)->today()->first();
        if (!$file) {
            $this->banner('Unable to Download Report', 'danger');
            return redirect()->route('reports');
        }
        return Storage::disk('reports')->download($file->file);
        
        // $workorders = Workorder::query()
        // ->with('circle', 'division', 'schemes:id,imis_id,old_scheme_id')
        // ->doesntHave("performanceGuarantees")
        // ->lazy();
        
        // if ($workorders->isNotEmpty()) {
        //     $data = $workorders->map(fn($data) => [
        //         'Division' => $data->division?->name ?? '-',
        //         'Office' => $data->circle?->name ?? '-',
        //         'SMT_Workorder_Id' => $data->old_workorder_id ?? '-',
        //         'Workorder Number' => $data->workorder_number ?? '-',
        //         'Issuing Authority' => $data->issuing_authority ?? '-',
        //         'Amount' => $data->workorder_amount ?? '-',
        //         'Scheme_IMIS_ID(s)' => $data->schemes?->pluck('imis_id')?->join('|') ?? '-',
        //         'Scheme_SMT_ID(s)' => $data->schemes?->pluck('old_scheme_id')?->join('|') ?? '-',
        //     ])->toArray();

        //     return $this->exportToCsv($data, 'workorders_without_pg.csv');
        // } else {
        //     $this->banner('Data not found');
        //     return redirect()->back();
        // }
    }
}
