<?php

namespace App\Http\Livewire\Reports;

use App\Models\PerformanceGuarantee;
use App\Models\Report;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

class FavourWisePg extends Component
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public function getReportsProperty()
    {
        return Report::query()
            ->where('category', Report::CATEGORY_PLEDGED_FAVOR_PG_DETAIL)
            ->today()
            ->orderBy('title')
            ->get();
    }

    public function download($file)
    {
        return Storage::disk('reports')->download($file);
    }

    // public function getFavoursProperty()
    // {
    //     return PerformanceGuarantee::query()
    //         ->select('pledged_infavour_of')
    //         ->groupBy('pledged_infavour_of')
    //         ->orderBy('pledged_infavour_of', 'asc')
    //         ->get();
    // }

    // public function generate($favour = null)
    // {
    //     if ($favour) {
    //         $pgs = PerformanceGuarantee::query()
    //             ->select('id', 'pg_amount', 'contractor_id', 'expired_date', 'pledged_infavour_of')
    //             ->with(
    //                 'workorders:id,workorder_number,workorder_amount',
    //                 'workorders.schemes:id,name,old_scheme_id,imis_id',
    //                 'contractor:id,name',
    //                 'contractor.contractor:id,user_id,bid_no'
    //             )
    //             ->withSum('workorders', 'workorder_amount')
    //             ->where('pledged_infavour_of', $favour)
    //             ->lazy();
    //     } else {
    //         $pgs = PerformanceGuarantee::query()
    //             ->select('id', 'pg_amount', 'contractor_id', 'expired_date', 'pledged_infavour_of')
    //             ->with(
    //                 'workorders:id,workorder_number,workorder_amount',
    //                 'workorders.schemes:id,name,old_scheme_id,imis_id',
    //                 'contractor:id,name',
    //                 'contractor.contractor:id,user_id,bid_no'
    //             )
    //             ->withSum('workorders', 'workorder_amount')
    //             ->whereNull('pledged_infavour_of')
    //             ->lazy();
    //     }

    //     if ($pgs->isNotEmpty()) {
    //         $divs = $pgs->map(fn($data) => [
    //             // 'id' => $data->id,
    //             'Pledged_Infavour_Of' => $data->pledged_infavour_of,
    //             'Scheme' => $data->workorders?->pluck('scheme_names')->join('||'),
    //             'SMT_IDs' => $data->workorders?->pluck('scheme_smt_ids')->join('||'),
    //             'IMIS_IDs' => $data->workorders?->pluck('scheme_imis_ids')->join('||'),
    //             'Bid_ID' => $data->contractor?->contractor?->bid_no,
    //             'Contractor' => $data->contractor?->name,
    //             'Workorder_Nos' => $data->workorders?->pluck('workorder_number')->join('||'),
    //             'Workorder_Amount' => $data->workorders?->pluck('workorder_amount')->join('||'),
    //             'PG_Amount' => Str::money($data->pg_amount ?? 0),
    //             'PG_to_be_Submitted' => $data->workorders_sum_workorder_amount ? Str::money($data->workorders_sum_workorder_amount * 0.05) : '-',
    //             'Expiry_Date' => $data->expired_date?->format('d-m-Y'),
    //         ])->toArray();

    //         $fileName = $favour ? preg_replace('/\s+/', '', $favour).'.csv' :'PgDetaisReport.csv';
    //         return $this->exportToCsv($divs, $fileName);
    //     } else {
    //         $this->banner('Data not found');
    //         return redirect()->back();
    //     }
    // }

    public function render()
    {
        return view('livewire.reports.favour-wise-pg',[
            'reports' => $this->reports,
        ]);
    }
}
