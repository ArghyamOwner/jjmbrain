<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\Scheme;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\Storage;

class SchemeWithoutOrWrongImis extends Controller
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public function generate()
    {
        $file = Report::where('category', Report::CATEGORY_SCHEMES_WITHOUT_OR_WRONG_IMIS)->today()->first();
        if (!$file) {
            $this->banner('Unable to Download Report', 'danger');
            return redirect()->route('reports');
        }
        return Storage::disk('reports')->download($file->file);
        
        // $schemes = Scheme::query()
        //     ->with('division:id,name')
        //     ->whereNull('imis_id')
        //     ->orWhereColumn('imis_id', 'old_scheme_id')
        //     ->lazy()
        //     ->sortBy('scheme.division.name');

        // if ($schemes->isNotEmpty()) {
        //     $data = $schemes->map(fn($data) => [
        //         'Division' => $data->division?->name,
        //         'Name' => $data->name,
        //         'Scheme_Type' => $data->scheme_type->name,
        //         'IMIS-ID' => $data->imis_id ?? '-',
        //         'SMT-ID' => $data->old_scheme_id
        //     ])->toArray();

        //     return $this->exportToCsv($data, 'schemes_without_imis.csv');
        // } else {
        //     $this->banner('Data not found');
        //     return redirect()->back();
        // }
    }
}
