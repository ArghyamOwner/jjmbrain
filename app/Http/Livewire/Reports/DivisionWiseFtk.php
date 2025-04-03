<?php

namespace App\Http\Livewire\Reports;

use App\Models\Division;
use App\Models\Report;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DivisionWiseFtk extends Component
{
    use WithExportToCsv;
    use InteractsWithBanner;
    
    // public function getDivisionsProperty()
    // {
    //     return Division::orderBy('name', 'asc')->select('name', 'id')->get();
    // }

    public function getReportsProperty()
    {
        return Report::query()
            ->where('category', Report::CATEGORY_DIVISION_WISE_VILLAGE_FTK)
            ->today()
            ->orderBy('title')
            ->get();
    }
    
    public function download($file)
    {
        return Storage::disk('reports')->download($file);
    }


    // public function generate(Division $division)
    // {
    //     $query = "SELECT V.village_name AS village_name,
    //                 CASE WHEN F.id IS NOT NULL THEN 'Yes' ELSE 'No' END AS field_test_kits_data
    //                 -- F.assigned_person_name as assigned_person,
    //                 -- F.assigned_person_phone as assigned_person_phone,
    //                 -- F.brand_name as FTK_brand,
    //                 -- F.issue_date as issue_date
    //             FROM villages V
    //             LEFT JOIN field_test_kits F ON V.id = F.village_id
    //             WHERE V.panchayat_id IN (
    //                 SELECT P.id
    //                 FROM panchayats P
    //                 JOIN blocks B ON P.block_id = B.id
    //                 WHERE B.district_id IN (
    //                     SELECT district_id
    //                     FROM district_division
    //                     WHERE division_id = :division_id
    //                 )
    //             )
    //             ORDER BY V.village_name;";
    //     $villages = DB::select($query, ['division_id' => $division->id]);

    //     if (count($villages)) {
    //         $villagesData = collect($villages)->map(fn($data) => [
    //             'division' => $division->name,
    //             'village_name' => $data->village_name,
    //             'ftk' => $data->field_test_kits_data,
    //             // 'assigned_person' => $data->assigned_person ,
    //             // 'assigned_person_phone' => $data->assigned_person_phone,
    //             // 'FTK_brand' => $data->FTK_brand ?? '-',
    //             // 'issue_date' => $data->issue_date ?? '-'
    //         ])->toArray();

    //         return $this->exportToCsv($villagesData, $division->name.'_ftk.csv');
    //     } else {
    //         $this->notify('Data not found', 'error');
    //         return redirect()->back();
    //     }

    // }

    public function render()
    {
        return view('livewire.reports.division-wise-ftk',[
            'reports' => $this->reports,
        ]);
    }
}
