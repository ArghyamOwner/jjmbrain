<?php

namespace App\Console\Commands;

use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteOldReports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-reports';

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
        $twoDaysAgo = Carbon::now()->subDays(2);
        $reports = Report::where('created_at', '<', $twoDaysAgo)->get();
        foreach ($reports as $report) {
            if ($report->file && Storage::disk('reports')->exists($report->file)) {
                Storage::disk('reports')->delete($report->file);
            }
            $report->delete();
        }
    }
}
