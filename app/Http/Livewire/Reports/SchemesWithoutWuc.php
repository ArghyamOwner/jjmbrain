<?php

namespace App\Http\Livewire\Reports;

use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class SchemesWithoutWuc extends Component
{
    public function getReportsProperty()
    {
        return Report::where('category', Report::CATEGORY_DISTRICT_WISE_SCHEMES_WITHOUT_WUC)->today()->orderBy('title')->get();
    }

    public function download($file)
    {
        return Storage::disk('reports')->download($file);
    }

    // public function getDistrictsProperty()
    // {
    //     return District::orderBy('name', 'asc')->select('name', 'id')->get();
    // }

    // public function generate(District $district)
    // {
    //     $data = [];

    //     $schemes = Scheme::query()
    //         ->where('district_id', $district->id)
    //         ->doesntHave('wucs')
    //         ->with('district', 'division', 'villages')
    //         ->lazy();

    //     foreach ($schemes as $scheme) {
    //         $data[] = [
    //             'district' => $scheme->district?->name,
    //             'division' => $scheme->division?->name,
    //             'village_name' => $scheme->villages?->pluck('village_name')->join(','),
    //             'scheme_name' => $scheme->name,
    //             'imis_id' => $scheme->imis_id,
    //             'smt' => $scheme->old_scheme_id,
    //             'work_status' => $scheme->work_status?->label() ?? '-'
    //         ];
    //     }
    //     if (count($data)) {
    //         return $this->exportToCsv($data, $district->name . '_scheme_without_wuc_report.csv');
    //     } else {
    //         $this->notify('Data not found', 'error');
    //         return redirect()->back();
    //     }
    // }

    public function render()
    {
        return view('livewire.reports.schemes-without-wuc', [
            'reports' => $this->reports,
        ]);
    }
}
