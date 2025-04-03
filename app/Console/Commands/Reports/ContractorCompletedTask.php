<?php

namespace App\Console\Commands\Reports;

use App\Enums\AssignmentTaskStatus;
use App\Models\AssignmentTask;
use App\Models\Report;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class ContractorCompletedTask extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:contractor-completed-task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tasks = AssignmentTask::query()
            ->with('scheme.division', 'workorder.contractor', 'task')
            ->where('status', AssignmentTaskStatus::COMPLETED)
            ->get()
            ->sortBy('scheme.division.name');

        if ($tasks->isNotEmpty()) {
            $data = $tasks->map(fn($data) => [
                'division' => $data->scheme?->division?->name,
                'contractor' => $data->workorder?->contractor?->name,
                'task' => $data->task?->task_name,
                'task_status' => $data->status->name,
            ])->toArray();
            $hashedName = $this->generateAndUpload($data, 'contractor_completed_tasks_report.csv', 'reports');
            $this->line($hashedName);
            $this->line('  ');
            Report::create([
                'report_number' => 'CONCTR',
                'title' => "List of Contractor's Completed Task Report",
                'category' => Report::CATEGORY_CONTRACTOR_COMPLETED_TASK,
                'file' => $hashedName,
            ]);
        }
    }
}
