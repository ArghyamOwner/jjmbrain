<?php

namespace App\Http\Livewire\Reports;

use App\Models\District;
use App\Models\Report;
use App\Models\Wuc;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DistrictWiseWuc extends Component
{

    public function getReportsProperty()
    {
        $user = auth()->user();
        return Report::query()
            ->where('category', Report::CATEGORY_DISTRICT_WISE_WUC)
            ->today()
            ->when($user->isAsrlmBlock(), 
                fn($query) => $query->whereIn('district_id', $user->blocks()->pluck('district_id')))
            ->orderBy('title')
            ->get();
    }

    public function download($file)
    {
        return Storage::disk('reports')->download($file);
    }

    // public function getDistrictsProperty()
    // {
    //     return District::select('name', 'id')
    //         ->when(auth()->user()->isAsrlmBlock(), 
    //             fn($query) => $query->whereIn('id', auth()->user()->blocks()->pluck('district_id')))
    //         ->orderBy('name', 'asc')
    //         ->get();
    // }

    // public function generate(District $district)
    // {
    //     $data = [];
    //     $wucs = Wuc::query()
    //         ->with(
    //             "district:id,name",
    //             "schemes:id,name",
    //             "schemes.villages",
    //             "schemes.panchayats",
    //             "isas:id,name,type",
    //             "wucPresidents",
    //             'block:id,name')
    //         ->when(auth()->user()->isAsrlmBlock(), 
    //             fn($query) => $query->whereIn('block_id', auth()->user()->blocks()->pluck('block_id')))
    //         ->where('district_id', $district->id)
    //         ->lazy();

    //     foreach ($wucs as $wuc) {
    //         $data[] = [
    //             "District" => $wuc->district?->name,
    //             "Block" => $wuc->block?->name,
    //             "Panchayats of Scheme" => $wuc->schemes?->pluck("panchayat_names")->join(","),
    //             "WUC Name" => $wuc->name,
    //             "Villages of Scheme" => $wuc->schemes?->pluck("village_names")->join(","),
    //             "Schemes" => $wuc->scheme_names,
    //             "Formation Date" => $wuc->formation_date?->format("d-m-Y"),
    //             "President Name" => $wuc->wucPresidents?->pluck("name")->join(","),
    //             "President Phone" => $wuc->wucPresidents?->pluck("phone")->join(","),
    //             "Account Number Status" => $wuc->account_number ? "Yes" : "No",
    //             "ISA Name" => $wuc->isas?->first()?->name,
    //             "ISA Type" => $wuc->isas?->first()?->type
    //         ];
    //     }
    //     if (count($data)) {
    //         return $this->exportToCsv($data, $district->name . '_wuc_report.csv');
    //     } else {
    //         $this->notify('Data not found', 'error');
    //         return redirect()->back();
    //     }
    // }

    public function render()
    {
        return view('livewire.reports.district-wise-wuc',[
            'reports' => $this->reports,
        ]);
    }
}
