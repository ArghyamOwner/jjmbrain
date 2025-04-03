<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ImportDpmuUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-dpmu-users';

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
                $users = File::json(base_path('database/dpmu_users.json'));

                $progressBar = $this->output->createProgressBar(count($users));

                $this->line('DPMU users importing...');

                $progressBar->start();

                foreach ($users as $user) {
                    $user = User::create([
                        'district_id' => $user['id'],
                        'name' => $user['district'],
                        'email' => 'dpmu_'.$user['email'],
                        'email_verified_at' => now(),
                        'password' => bcrypt('secret'),
                        'role' => 'dpmu',
                        'phone' => $user['phone']
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
