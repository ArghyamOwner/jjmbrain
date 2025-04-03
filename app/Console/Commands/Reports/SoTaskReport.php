<?php

namespace App\Console\Commands\Reports;

use App\Models\Report;
use App\Models\User;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class SoTaskReport extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:so-task-report';

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
        $users = User::query()
        ->with('divisions')
        ->where('role', 'section-officer')
        ->withCount(['assignmentTaskCompleted', 'assignmentTaskOngoing', 'assignmentTaskNotStarted'])
        ->orderBy('name')
        ->lazy();
    if ($users->isNotEmpty()) {
        $data = $users->map(fn($data) => [
            'SO_Name' => $data->name,
            'division' => $data->division_names,
            'Completed_Tasks' => $data->assignment_task_completed_count,
            'Ongoing_Tasks' => $data->assignment_task_ongoing_count,
            'Not-Started_Tasks' => $data->assignment_task_not_started_count,
        ])->toArray();
        $hashedName = $this->generateAndUpload($data, 'so_task_report.csv', 'reports');
            $this->line($hashedName);
            $this->line('  ');
            Report::create([
                'report_number' => 'SOTASK',
                'title' => "Section-Officer's Task Assignment Completion Report",
                'category' => Report::CATEGORY_SO_TASK_REPORT,
                'file' => $hashedName,
            ]);
    } 
    }
}
