<?php

namespace App\Http\Livewire\Reports;

use App\Models\Division;
use App\Models\Report;
use App\Models\Scheme;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DivisionDistributionReport extends Component
{
    use InteractsWithBanner;

    public function getReportsProperty()
    {
        return Report::query()
            ->where('category', Report::CATEGORY_DIVISION_PIPE_NETWORK)
            ->today()
            ->orderBy('title')
            ->get();
    }

    public function download($file)
    {
        return Storage::disk('reports')->download($file);
    }

    // public function getDivisionsProperty()
    // {
    //     return Division::orderBy('name', 'asc')->select('name', 'id')->get();
    // }

    // public function generate(Division $division)
    // {
    //     $schemes = Scheme::query()
    //         ->with([
    //             'district:id,name',
    //             'workorders:id,contractor_id',
    //             'workorders.contractor:id,name,phone',
    //             'workorders.contractor.contractor:id,user_id,bid_no',
    //             'users:id,name,phone',
    //             'latestSchemePipeNetwork.verifiedBy:id,name',
    //             'latestTrackedCanalTrackings'
    //         ])->withCount('beneficiaries')
    //         ->where('division_id', $division->id)
    //         ->orderBy('name')
    //         ->lazy();

    //     $data = $schemes->map(fn($data) => [
    //         'Division' => $division->name,
    //         'District' => $data->district?->name,
    //         'Scheme_Name' => $data->name,
    //         'IMIS_ID' => $data->imis_id ?? '-',
    //         'SMT_ID' => $data->old_scheme_id ?? '-',
    //         'FHTC_Planned' => $data->planned_fhtc ?? '-',
    //         'FHTC_Achieved' => $data->achieved_fhtc ?? '-',
    //         'TPI_Progress' => $data->tpi_progress ?? '-',
    //         'Bid_ID' => $data->workorders->map(fn($item) => $item?->contractor?->contractor?->bid_no)->implode(' | '),
    //         'Contractor_Name' => $data->workorders->pluck('contractor.name')->implode(" | "),
    //         'Contractor_Phone' => $data->workorders->pluck('contractor.phone')->implode(" | "),
    //         'SO_Name(s)' => $data->users->pluck('name')->implode(" | "),
    //         'SO_Phone' => $data->users->pluck('phone')->implode(" | "),
    //         'Json_File_Uploaded' => $data->latestSchemePipeNetwork ? 'Yes' : 'No',
    //         // 'Date_Mapped' => $data->latestSchemePipeNetwork?->created_at?->format('d-m-Y'),
    //         'Latest_Tracking_date' => $data->latestTrackedCanalTrackings?->updated_at?->format('d-m-Y'),
    //         'Verification_Status' => $data->latestSchemePipeNetwork?->verification_status,
    //         'Verification_date' => $data->latestSchemePipeNetwork?->verified_at?->format('d-m-Y'),
    //         'Verified_by' => $data->latestSchemePipeNetwork?->verifiedBy?->name,
    //         'FHTC_Mapped' => $data->beneficiaries_count
    //     ])->toArray();

    //     if (count($data)) {
    //         return $this->exportToCsv($data, 'distribution_report_'.$division->name.'.csv');
    //     } else {
    //         $this->notify('Data not found', 'error');
    //         return redirect()->back();
    //     }

    // }

    public function render()
    {
        return view('livewire.reports.division-distribution-report', [
            // 'divisions' => $this->divisions,
            'reports' => $this->reports,
        ]);
    }
}
