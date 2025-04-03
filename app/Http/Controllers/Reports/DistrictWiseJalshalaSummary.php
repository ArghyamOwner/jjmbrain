<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Report;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\Storage;

class DistrictWiseJalshalaSummary extends Controller
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public function generate()
    {
        $file = Report::where('category', Report::CATEGORY_DISTRICT_WISE_JALSHALA_SUMMARY)->today()->first();

        if (!$file) {
            $this->banner('Unable to Download Report', 'danger');
            return redirect()->route('reports');
        }
        return Storage::disk('reports')->download($file->file);
        
        // $districtData = District::query()
        //     ->withCount(['plannedJalshalas', 'organisedJalshalas'])
        //     ->with([
        //         'jalshalas' => function ($query) {
        //             $query->withCount('jalshalaSchoolsJaldoots');
        //         }])
        //     ->orderBy('name')->lazy();

        // if ($districtData->isNotEmpty()) {
        //     $data = $districtData->map(fn($data) => [
        //         'district' => $data->name,
        //         'planned_jalshalas' => $data->planned_jalshalas_count,
        //         'organised_jalshalas' => $data->organised_jalshalas_count,
        //         'jalshala_schools_jaldoots' => $data->jalshalas->sum('jalshala_schools_jaldoots_count'),
        //     ])->toArray();

        //     return $this->exportToCsv($data, 'jalshala_summary.csv');
        // } else {
        //     $this->banner('Data not found');
        //     return redirect()->back();
        // }
    }
}
