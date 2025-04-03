<?php

namespace App\Http\Controllers\Reports;

use App\Models\Scheme;
use Illuminate\Http\Request;
use App\Traits\WithExportToCsv;
use App\Traits\InteractsWithBanner;
use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;

class SchemesWithoutIsaReportController extends Controller
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public function generate()
    {
        $file = Report::where('category', Report::CATEGORY_SCHEMES_WITHOUT_ISA)->today()->first();
        if (!$file) {
            $this->banner('Unable to Download Report', 'danger');
            return redirect()->route('reports');
        }
        return Storage::disk('reports')->download($file->file);
        
        // $schemes = Scheme::query()
        //     ->with('district', 'division', 'villages')
        //     ->whereHas("wucs", function ($q) {
        //         $q->doesntHave("isas");
        //     })
        //     ->lazy()
        //     ->sortBy('district.name');

        // if ($schemes->isNotEmpty()) {
        //     $data = $schemes->map(fn ($data) => [
        //         'district' => $data->district?->name,
        //         'division' => $data->division?->name,
        //         'village_name' => $data->villages?->pluck('village_name')->join(','),
        //         'scheme_name' => $data->name,
        //         'imis_id' => $data->imis_id,
        //         'smt' => $data->old_scheme_id
        //     ])->toArray();

        //     return $this->exportToCsv($data, 'schemes_without_isa.csv');
        // } else {
        //     $this->banner('Data not found');
        //     return redirect()->back();
        // }
    }
}
