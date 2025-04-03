<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Report;
use App\Models\Wuc;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\Storage;

class DivisionHandoverSummaryReportController extends Controller
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public function generate()
    {
        $file = Report::where('category', Report::CATEGORY_DIVISION_HANDOVER_SUMMARY)->today()->first();
        if (!$file) {
            $this->banner('Unable to Download Report', 'danger');
            return redirect()->route('reports');
        }
        return Storage::disk('reports')->download($file->file);
        
        // $divisionsData = Division::query()
        //     ->select('id', 'name')
        //     ->withCount([
        //         'schemes',
        //         'handedoverSchemes',
        //         'schemesWithSo',
        //         'panchayatVerifiedSchemes',
        //         'jalmitraSchemes',
        //         'qrInstalledSchemes',
        //         'trackedCanalTrackings',
        //     ])
        //     ->orderBy('name')
        //     ->lazy();

        // if ($divisionsData->isNotEmpty()) {
        //     $divs = $divisionsData->map(fn($data) => [
        //         'Division' => $data->name,
        //         'Schemes' => $data->schemes_count,
        //         'Handedover_Schemes' => $data->handedover_schemes_count,
        //         'Schemes_With_SO' => $data->schemes_with_so_count,
        //         'Panchayat_Verified_Schemes' => $data->panchayat_verified_schemes_count,
        //         'Jalmitra_Assigned' => $data->jalmitra_schemes_count,
        //         'QRCode_Installed' => $data->qr_installed_schemes_count,
        //         'Network_Tracked' => $data->tracked_canal_trackings_count,
        //         'WUCs' => Wuc::whereRelation('schemes', 'division_id', $data->id)->count()
        //     ])->toArray();

        //     return $this->exportToCsv($divs, 'divisionHandoverSummaryReport.csv');
        // } else {
        //     $this->banner('Data not found');
        //     return redirect()->back();
        // }
    }
}
