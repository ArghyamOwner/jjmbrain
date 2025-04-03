<?php

namespace App\Console\Commands;

use App\Models\ContractorDetail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class UpdateContractorDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-contractor-details';

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
        DB::transaction(function () {
            $csv = Reader::createFromPath(base_path('database/contactors_phone.csv'), 'r');
            $csv->setHeaderOffset(0);
            // $header = $csv->getHeader(); // get the CSV header row
            $records = $csv->getRecords(); // get all the records

            $progressBar = $this->output->createProgressBar(count($csv));
            $this->line('Updating Contractors...');
            $progressBar->start();

            // $contractors = File::json(base_path('database/contractors-data.json'));

            // $progressBar = $this->output->createProgressBar(count($contractors));

            // $this->line('Updating Contractors...');

            // $progressBar->start();

            foreach ($records as $contractor) {
                $existingContractor = ContractorDetail::query()
                    ->with('user')
                    ->where('bid_no', $contractor['bid_no'])
                    ->first();

                if ($existingContractor) {
                    if ($existingContractor->user) {
                        $phoneExists = User::where('phone', $contractor['contact'])
                            ->where('id', '!=', $existingContractor->user_id)
                            ->exists();
                        if ($phoneExists) {
                            $this->line('');
                            $this->line('PHONE_ALREADY_EXISTS : ' . $contractor['contact']);
                            $this->line('');
                        } else {
                            $existingContractor->user->update([
                                // 'phone' => $existingContractor->phone ? $existingContractor->phone : ($contractor['contact'] ? substr(str_replace(' ', '', $contractor['contact']), -10) : null),
                                'phone' => $contractor['contact']
                            ]);
                        }
                    }
                    // $existingContractor->update([
                    //     'old_contractor_id' => $contractor['id']
                    // ]);
                } else {
                    $this->line('Does_NO_Exists : ' . $contractor['bid_no']);
                    $this->line('');
                }

                $progressBar->advance();
            }
            $progressBar->finish();

            $this->line('');

            // the info method will display in the console as green colored text:
            $this->info('Updated Successfully!');
        });
    }
}
