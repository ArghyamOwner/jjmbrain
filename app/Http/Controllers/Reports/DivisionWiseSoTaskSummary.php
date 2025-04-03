<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\Storage;

class DivisionWiseSoTaskSummary extends Controller
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public function generate()
    {
        $file = Report::where('category', Report::CATEGORY_DIVISION_SO_TASK_SUMMARY)->today()->first();
        if (!$file) {
            $this->banner('Unable to Download Report', 'danger');
            return redirect()->route('reports');
        }
        return Storage::disk('reports')->download($file->file);

        // $divisions = Division::query()
        //     ->with([
        //         'sectionOfficers' => function ($query) {
        //             $query->withCount('assignmentTask');
        //         }])
        //     ->withCount('sectionOfficers')
        //     ->orderBy('name')->lazy();

        // if ($divisions->isNotEmpty()) {
        //     $data = $divisions->map(fn($data) => [
        //         'division' => $data->name,
        //         'so_count' => $data->section_officers_count,
        //         'assignment_task_count' => $data->sectionOfficers->sum('assignment_task_count'),
        //     ])->toArray();

        //     return $this->exportToCsv($data, 'so_task_summary.csv');
        // } else {
        //     $this->banner('Data not found');
        //     return redirect()->back();
        // }
    }
}
