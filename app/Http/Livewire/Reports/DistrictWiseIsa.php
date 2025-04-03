<?php

namespace App\Http\Livewire\Reports;

use App\Models\Report;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DistrictWiseIsa extends Component
{
    use WithExportToCsv;

    // public function getDistrictsProperty()
    // {
    //     $user = auth()->user();

    //     return District::query()
    //         ->select('name', 'id')
    //         ->when(($user->isIsaCoordinator()),
    //             fn($query) => $query->whereIn('id', $user->districts()->pluck('district_id')))
    //         ->orderBy('name', 'asc')
    //         ->get();
    // }

    public function getReportsProperty()
    {
        return Report::query()
            ->where('category', Report::CATEGORY_DISTRICT_WISE_ISA)
            ->today()
            ->when((auth()->user()->isIsaCoordinator()),
                fn($query) => $query->whereIn('district_id', auth()->user()->districts()->pluck('district_id')))
            ->orderBy('title')
            ->get();
    }

    public function download($file)
    {
        return Storage::disk('reports')->download($file);
    }

    // public function generate(District $district)
    // {
    //     $data = [];
    //     $districtVillagesWithISAS = Village::query()
    //         ->with("isas", "panchayat.block")
    //         ->whereHas("panchayat.block.district", function ($query) use ($district) {
    //             $query->where("id", $district->id);
    //         })
    //         ->orderBy("village_name")
    //         ->get();
    //     foreach ($districtVillagesWithISAS as $dataW) {
    //         $data[] = [
    //             "DISTRICT" => $district->name,
    //             "BLOCK" => $dataW->panchayat->block->name,
    //             "VILLAGE_NAME" => $dataW->village_name,
    //             "GP" => $dataW->panchayat?->panchayat_name,
    //             "ISA" => $dataW->isas->isNotEmpty() ? "Yes" : "No",
    //             "ISA Type" => $dataW->isas?->pluck("type")?->join(","),
    //             "Name" => $dataW->isas?->pluck("name")?->join(","),
    //             "Contact Person" => $dataW->isas?->pluck("contact_name")?->join(","),
    //             "Contact Phone" => $dataW->isas?->pluck("contact_phone")?->join(","),
    //         ];
    //     }
    //     if (count($data)) {
    //         return $this->exportToCsv($data, $district->name . '_isa_report.csv');
    //     } else {
    //         $this->notify('Data not found', 'error');
    //         return redirect()->back();
    //     }
    // }

    public function render()
    {
        return view('livewire.reports.district-wise-isa', [
            'reports' => $this->reports,
        ]);
    }
}
