<?php

namespace App\Http\Controllers\Reports;

use App\Enums\AssignmentTaskStatus;
use App\Http\Controllers\Controller;
use App\Models\AssignmentTask;
use App\Models\Report;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\Storage;

class ContractorsCompletedTasksReport extends Controller
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public function generate()
    {
        $file = Report::where('category', Report::CATEGORY_CONTRACTOR_COMPLETED_TASK)->today()->first();
        if (!$file) {
            $this->banner('Unable to Download Report', 'danger');
            return redirect()->route('reports');
        }
        return Storage::disk('reports')->download($file->file);
        
        // $tasks = AssignmentTask::query()
        //     ->with('scheme.division', 'workorder.contractor', 'task')
        //     ->where('status', AssignmentTaskStatus::COMPLETED)
        //     ->get()
        //     ->sortBy('scheme.division.name');

        // if ($tasks->isNotEmpty()) {
        //     $data = $tasks->map(fn($data) => [
        //         'division' => $data->scheme?->division?->name,
        //         'contractor' => $data->workorder?->contractor?->name,
        //         'task' => $data->task?->task_name,
        //         'task_status' => $data->status->name,
        //     ])->toArray();

        //     return $this->exportToCsv($data, 'contractor_completed_tasks_report.csv');
        // } else {
        //     $this->banner('Data not found');
        //     return redirect()->back();
        // }
    }
}
