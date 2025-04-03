<?php

namespace App\Http\Livewire\Reports;

use App\Models\Report;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DivisionWise extends Component
{
    use WithExportToCsv;
    use InteractsWithBanner;

    // public function getDivisionsProperty()
    // {
    //     $user = auth()->user();
    //     return Division::query()
    //         ->select('name', 'id')
    //         ->when(($user->isExecutiveEngineer() || $user->isSectionOfficer() || $user->isSdo()),
    //                 fn($query) => $query->whereIn('id', $user->divisions()->pluck('division_id')))
    //         ->orderBy('name', 'asc')
    //         ->get();
    // }

    public function getReportsProperty()
    {
        $user = auth()->user();
        return Report::query()
            ->where('category', Report::CATEGORY_DIVISION_WISE_SCHEME_DETAILS)
            ->today()
            ->when(($user->isExecutiveEngineer() || $user->isSectionOfficer() || $user->isSdo()),
                fn($query) => $query->whereIn('division_id', $user->divisions()->pluck('division_id')))
            ->orderBy('title')
            ->get();
    }

    public function download($file)
    {
        return Storage::disk('reports')->download($file);
    }

    // public function generate(Division $division)
    // {

    //     $schemeLazyCollection = Scheme::query()
    //         ->with('district:id,name', 'block:id,namek')
    //         ->where('division_id', $division->id)
    //         ->cursor();

    //     if ($schemeLazyCollection->isNotEmpty()) {
    //         $schemes = $schemeLazyCollection->map(fn ($data) => [
    //             'name' => $data->name,
    //             'SMT_id' => $data->old_scheme_id,
    //             'imis_id' => $data->imis_id,
    //             'scheme_type' => $data->scheme_type?->name,
    //             'division' => 'div',
    //             'district' => $data->district?->name,
    //             'block' => $data->block?->name,
    //             'work_status' => $data->work_status?->name,
    //             'operating_status' => $data->operating_status?->name,
    //             'scheme_status' => $data->scheme_status?->name,
    //             'villages' => $data->village_names,
    //             'lac' => $data->lac?->name,
    //             'approved_on' => $data->approved_on,
    //             'slssc_year' => $data->slssc_year,
    //             'planned_fhtc' => $data->planned_fhtc,
    //             'achieved_fhtc' => $data->achieved_fhtc,
    //             'handover_date' => $data->handover_date?->format('Y-m-d'),
    //             'state_share' => $data->state_share,
    //             'central_share' => $data->central_share,
    //             'total_cost' => $data->total_cost,
    //             'consumer_no' => $data->consumer_no,
    //             'latitude' => $data->latitude,
    //             'longitude' => $data->longitude,
    //         ])->toArray();

    //         return  $this->exportToCsv($schemes, $division->name);
    //     } else {
    //         $this->banner('Data not found');
    //         return redirect()->back();
    //     }
    // }

    public function render()
    {
        return view('livewire.reports.division-wise', [
            // 'divisions' => $this->divisions,
            'reports' => $this->reports,
        ]);
    }
}
