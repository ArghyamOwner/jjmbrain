<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Models\User;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\Storage;

class SoAssignedTaskCompletionReport extends Controller
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public function generate()
    {
        $file = Report::where('category', Report::CATEGORY_SO_TASK_REPORT)->today()->first();
        if (!$file) {
            $this->banner('Unable to Download Report', 'danger');
            return redirect()->route('reports');
        }
        return Storage::disk('reports')->download($file->file);
        
        // $users = User::query()
        //     ->with('divisions')
        //     ->where('role', 'section-officer')
        //     ->withCount(['assignmentTaskCompleted', 'assignmentTaskOngoing', 'assignmentTaskNotStarted'])
        //     ->orderBy('name')
        //     ->lazy();

        // if ($users->isNotEmpty()) {
        //     $data = $users->map(fn($data) => [
        //         'SO_Name' => $data->name,
        //         'division' => $data->division_names,
        //         'Completed_Tasks' => $data->assignment_task_completed_count,
        //         'Ongoing_Tasks' => $data->assignment_task_ongoing_count,
        //         'Not-Started_Tasks' => $data->assignment_task_not_started_count,
        //     ])->toArray();

        //     return $this->exportToCsv($data, 'so_task_completion_report.csv');
        // } else {
        //     $this->banner('Data not found');
        //     return redirect()->back();
        // }
    }
}
