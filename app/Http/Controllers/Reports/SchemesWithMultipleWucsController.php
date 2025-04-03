<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Scheme;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;

class SchemesWithMultipleWucsController extends Controller
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public function generate()
    {
        $schemes = Scheme::query()
            ->select('id', 'name', 'imis_id', 'old_scheme_id', 'work_status', 'division_id')
            ->with('division:id,name')
            ->withCount('wucs')
            ->having('wucs_count', '>', 1)
            ->lazy();

        if ($schemes->isNotEmpty()) {
            $data = $schemes->map(fn($data) => [
                'Division' => $data->division?->name,
                'Scheme' => $data->name,
                'WUC_Count' => $data->wucs_count,
                'IMIS_ID' => $data->imis_id,
                'SMT_ID' => $data->old_scheme_id,
                'work_status' => $data->work_status?->name,
            ])->sortBy('Division')->toArray();

            return $this->exportToCsv($data, 'multiple_wuc_schemes.csv');
        } else {
            $this->banner('Data not found');
            return redirect()->back();
        }
    }
}
