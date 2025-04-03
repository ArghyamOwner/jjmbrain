<?php

namespace App\Console\Commands;

use App\Models\Zone;
use App\Models\Circle;
use App\Models\Scheme;
use App\Models\Division;
use App\Models\Workorder;
use Illuminate\Console\Command;
use App\Models\ContractorDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ImportOldWorkorders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-old-workorders';

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
        try {
            DB::transaction(function () {
                $workorders = File::json(base_path('database/workorders.json'));

                $progressBar = $this->output->createProgressBar(count($workorders));

                $this->line('Old Workorders importing...');

                $progressBar->start();

                foreach ($workorders as $workorder) {

                    $schemeFound = Scheme::with('division.circle')->where('old_scheme_id', $workorder['scheme_id'])->first();
                    $contractorFound = ContractorDetail::with('user')->where('old_contractor_id', $workorder['contractor_id'])->first();

                    if ($schemeFound) {
                        $workorder = Workorder::create([
                            'pkg_id' => $workorder['pkg_id'],
                            'old_workorder_id' => $workorder['id'],
                            'issuing_authority' => $workorder['name'],
                            'contractor_id' => $contractorFound && $contractorFound->user ? $contractorFound?->user?->id : null,
                            'circle_id' => $schemeFound->division->circle->id,
                            'workorder_number' => $workorder['order_no'],
                            'workorder_funding_agency' => null,
                            'workorder_amount' => $workorder['work_value'] * 1_00_000,
                            'workorder_type' => 'work',    
                            'workorder_status' => 'ongoing',    
                            'workorder_estimated_date' => $workorder['end_date'],
                            'formal_workorder_date' => $workorder['order_date'],
                            'formal_workorder_number' => $workorder['order_no'],
                        ]);

                        $workorder->schemes()->sync($schemeFound->id);
        
                        $progressBar->advance();
                    }
                }

                $progressBar->finish();

                $this->line('');

                // the info method will display in the console as green colored text:
                $this->info('Imported Successfully!');
            });
        } catch (\Exception $e) {
            Log::info($e);
        }
    }
}
