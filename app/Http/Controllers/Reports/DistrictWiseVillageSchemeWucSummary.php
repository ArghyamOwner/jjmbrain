<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Report;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\Storage;

class DistrictWiseVillageSchemeWucSummary extends Controller
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public function generate()
    {
        $file = Report::where('category', Report::CATEGORY_DISTRICT_SUMMARY)->today()->first();
        if (!$file) {
            $this->banner('Unable to Download Report', 'danger');
            return redirect()->route('reports');
        }
        return Storage::disk('reports')->download($file->file);
        
        // $districtData = District::query()
        //     ->withCount(['wucs', 'schemes', 'villages'])
        //     ->when((auth()->user()->isIsaCoordinator()),
        //             fn($query) => $query->whereIn('id', auth()->user()->districts()->pluck('district_id')))
        //     ->orderBy('name')->lazy();

        // if ($districtData->isNotEmpty()) {
        //     $data = $districtData->map(fn($data) => [
        //         'District' => $data->name,
        //         'Villages' => $data->villages_count,
        //         'Schemes' => $data->schemes_count,
        //         'WUCs_Created' => $data->wucs_count,
        //         'WUCs_Pending' => $data->schemes_count - $data->wucs_count,
        //     ])->toArray();

        //     return $this->exportToCsv($data, 'district_summary.csv');
        // } else {
        //     $this->banner('Data not found');
        //     return redirect()->back();
        // }
    }
}
