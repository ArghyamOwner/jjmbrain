<?php

namespace App\Console\Commands;

use App\Models\ContractorDetail;
use App\Models\PerformanceGuarantee;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ImportPgData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-pg-data';

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
        // try {
        //     DB::transaction(function () {
        $pgs = File::json(base_path('database/10.json'));

        $progressBar = $this->output->createProgressBar(count($pgs));

        $this->line('PG Data Importing...');

        $progressBar->start();

        foreach ($pgs as $pg) {

            $contractor = ContractorDetail::where('bid_no', $pg['bid_no'])->latest()->first();

            $performanceGuarantee = PerformanceGuarantee::create([
                'pg_amount' => str_replace(',', '', $pg['pg_amount']),
                'pg_type' => $pg['pg_type'],
                'pg_number' => $pg['pg_number'],
                'pg_date' => Carbon::parse($pg['pg_date'])->format('Y-m-d'),
                'expired_date' => Carbon::parse($pg['expired_date'])->format('Y-m-d'),
                'bank_name' => $pg['bank_name'],
                'bank_branch' => $pg['bank_branch'],
                'account_no' => $pg['account_no'],
                'contractor_id' => $contractor?->user_id ?? null,
                'contractor_name' => $pg['contractor_name'] . ' (' . $pg['bid_no'] . ')',
            ]);

            $filePath = 'pg/10/' . $pg['SL_No'] . '.pdf';
            if ($filePath) {
                $fileContent = file_get_contents(public_path($filePath)); // Read the file content
                $hashedName = md5(time()) . '_' . basename($filePath); // Generate a unique filename
                Storage::disk('uploads')->put($hashedName, $fileContent);
                $performanceGuarantee->update([
                    'pg_copy' => $hashedName,
                ]);
            }
            $progressBar->advance();
        }
        $progressBar->finish();
        $this->line('');

        // the info method will display in the console as green colored text:
        $this->info('Imported Successfully!');
        //     });
        // } catch (\Exception $e) {
        //     Log::info($e->getMessage());
        // }
    }
}
