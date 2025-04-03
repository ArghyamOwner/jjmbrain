<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Zone;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use App\Models\ContractorDetail;
use App\Traits\WithUniqueRandomNumberGenerator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ImportOldContractors extends Command
{
    use WithUniqueRandomNumberGenerator;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-old-contractors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Old Contractors';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            DB::transaction(function () {
                $contractors = File::json(base_path('database/contractors.json'));

                $progressBar = $this->output->createProgressBar(count($contractors));

                $this->line('Old Contractors importing...');

                $progressBar->start();

                foreach ($contractors as $contractor) {
                    $zoneName = match($contractor['zone']) {
                        1 => "Upper Assam Zone",
                        2 => "North Assam Zone",
                        3 => "Barak Valley Zone",
                        4 => "Dima Hasao",
                        5 => "Karbi Anglong Autonomous Council",
                        6 => "Bodoland Territory Autonomous District",
                        59 => "Lower Assam Zone",
                        0 => "Bodoland Territory Autonomous District"
                    };

                    $zone = Zone::where('name', $zoneName)->first();

                    $phoneNumber = ! blank($contractor['email']) ? Str::after($contractor['contact'], '+91') : null;

                    $emailExists = User::where('email', $contractor['email'])
                        ->orWhere('phone', $phoneNumber)
                        ->first();
 
                    $email = Str::random(10) . '@jjmbrain.in';
                   
                    $user = User::create([
                        'name' => $contractor['name'],
                        'email' => $emailExists ? $email : $contractor['email'],
                        'email_verified_at' => now(),
                        'password' => bcrypt('secret'),
                        'role' => 'contractor',
                        'phone' => $phoneNumber
                    ]);

                    ContractorDetail::create([
                        'user_id' => $user->id,
                        'entity_name' => $contractor['name'],
                        'contractor_type' => $contractor['class'],
                        'zone_id' => $zone->id,
                        'reg_dept' => $contractor['reg_dept'],
                        'bid_no' => $contractor['bid_no'], 
                        'license_no' => $contractor['license_no'],
                        'old_contractor_id' => $contractor['id'],
                        'gst' => $contractor['gst'],
                        'pan' => $contractor['pan'],
                        'address' => $contractor['address'],
                        'bank_name' => $contractor['bank_name'],
                        'account_number' => $contractor['account_no'],
                        'ifsc_code' => $contractor['ifsc'],
                    ]);    
                    
                    $progressBar->advance();
                }

                $progressBar->finish();

                $this->line('');

                // the info method will display in the console as green colored text:
                $this->info('Imported Successfully!');
            });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
