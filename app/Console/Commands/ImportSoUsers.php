<?php

namespace App\Console\Commands;

use App\Models\Division;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ImportSoUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-so-users';

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
                $users = File::json(base_path('database/so_users.json'));

                $progressBar = $this->output->createProgressBar(count($users));

                $this->line('SO users importing...');
 
                $progressBar->start();

                foreach ($users as $user) {

                    $division = Division::with('circle')->where('name', $user['DIVISION'])->first();

                    if ($division) {
                        $roleName = match($user['ROLE']) {
                            'SDO TC' => 'sdo',
                            'SO' => 'section-officer',
                            'SDO' => 'sdo',
                            'executive-engineer' => 'executive-engineer'
                        };
    
                        $user = User::create([
                            'designation' => $user['ROLE'],
                            'name' => $user['NAME'],
                            'email' => $user['EMAIL'],
                            'email_verified_at' => now(),
                            'password' => bcrypt('secret'),
                            'role' => $roleName,
                            'phone' => $user['MOBILE NO.']
                        ]);
        
                        $user->offices()->sync($division->circle_id);
                        $user->divisions()->sync($division->id);
                       
                        $progressBar->advance();
                    }
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
