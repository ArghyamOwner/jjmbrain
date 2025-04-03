<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Scheme;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\Storage;

class SchemesWithoutSo extends Controller
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public function generate()
    {
        $file = Report::where('category', Report::CATEGORY_SCHEMES_WITHOUT_SO)->today()->first();
        if (!$file) {
            $this->banner('Unable to Download Report', 'danger');
            return redirect()->route('reports');
        }
        return Storage::disk('reports')->download($file->file);
        // $schemes = Scheme::query()
        //     ->with('division')
        //     ->doesntHave('users')
        //     ->orderBy('division_id')
        //     ->lazy();

        // if ($schemes->isNotEmpty()) {
        //     $data = $schemes->map(fn($data) => [
        //         'Division' => $data->division?->name,
        //         'Name' => $data->name,
        //         'Scheme_Type' => $data->scheme_type->name,
        //         'IMIS-Id' => $data->imis_id,
        //     ])->toArray();

        //     return $this->exportToCsv($data, 'schemes_without_so.csv');
        // } else {
        //     $this->banner('Data not found');
        //     return redirect()->back();
        // }
    }
}
