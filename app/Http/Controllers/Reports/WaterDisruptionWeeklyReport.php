<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\DocumentReport;
use App\Models\Report;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WaterDisruptionWeeklyReport extends Controller
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public function generate()
    {
        $file = Report::where('category', Report::CATEGORY_WATER_DISRUPTION_WEEKLY_REPORT)->latest('id')->first();
        if (!$file) {
            $this->banner('Unable to Download Report', 'danger');
            return redirect()->route('reports');
        }
        return Storage::disk('reports')->download($file->file);
    }
}
