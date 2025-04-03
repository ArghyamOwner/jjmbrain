<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportPanchayatUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-panchayat-users';

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
                $users = \App\Models\Panchayat::all();

                $progressBar = $this->output->createProgressBar(count($users));

                $this->line('Panchayat users importing...');

                $progressBar->start();

                foreach($users as $user) {
                    User::create([
                        'panchayat_id' => $user->id,
                        'name' => $user->panchayat_name,
                        'email' => Str::slug($user->panchayat_name, '_') . '_' .Str::random(4) .'@jjmbrain.in',
                        'password' => bcrypt('secret'),
                        'role' => 'panchayat'
                    ]);

                    $progressBar->advance();
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
