<?php

namespace App\Http\Controllers\Reports;

use Illuminate\Http\Request;
use App\Traits\WithExportToCsv;
use App\Traits\InteractsWithBanner;
use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Village;
use Illuminate\Support\Facades\Storage;

class VillagesWithoutIsaReportController extends Controller
{
    use InteractsWithBanner;

    public function generate()
    {
        $file = Report::where('category', Report::CATEGORY_VILLAGES_WITHOUT_ISA)->today()->first();
        if (!$file) {
            $this->banner('Unable to Download Report', 'danger');
            return redirect()->route('reports');
        }
        return Storage::disk('reports')->download($file->file);
        
        // $villages = Village::query()
        //     ->with('district', 'panchayat.block')
        //     ->doesntHave('isas')
        //     ->lazy()
        //     ->sortBy('district.name');

        // if ($villages->isNotEmpty()) {
        //     $data = $villages->map(fn ($data) => [
        //         'district_name' => $data->district?->name,
        //         'block_name' => $data->panchayat?->block?->name,
        //         'village_name' => $data->village_name,
        //     ])->toArray();

        //     return $this->exportToCsv($data, 'villages_without_isa.csv');

        // } else {
        //     $this->banner('Data not found');
        //     return redirect()->back();
        // }
    }
}
