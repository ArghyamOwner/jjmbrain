<?php

namespace App\Console\Commands\Reports;

use App\Models\Division;
use App\Models\Report;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class DivisionWiseSOTaskSummary extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:division-wise-s-o-task-summary';

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
        $divisions = Division::query()
            ->with([
                'sectionOfficers' => function ($query) {
                    $query->withCount('assignmentTask');
                }])
            ->withCount('sectionOfficers')
            ->orderBy('name')->lazy();
        if ($divisions->isNotEmpty()) {
            $data = $divisions->map(fn($data) => [
                'division' => $data->name,
                'so_count' => $data->section_officers_count,
                'assignment_task_count' => $data->sectionOfficers->sum('assignment_task_count'),
            ])->toArray();
            $hashedName = $this->generateAndUpload($data, 'so_task_summary.csv', 'reports');
            $this->line($hashedName);
            $this->line('  ');
            Report::create([
                'report_number' => 'DVSOTS',
                'title' => 'Division-Wise Section-Officer Task Assignment Summary',
                'category' => Report::CATEGORY_DIVISION_SO_TASK_SUMMARY,
                'file' => $hashedName,
            ]);
        }
    }
}
