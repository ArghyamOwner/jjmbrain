<?php

namespace App\Console\Commands;

use App\Models\District;
use App\Models\Division;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ImportLabUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-lab-users';

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
        $users = File::json(base_path('database/lab_users.json'));

        $progressBar = $this->output->createProgressBar(count($users));

        $this->line('LAB users importing...');

        $progressBar->start();

        foreach ($users as $user) {
            $district = District::where('name', $user['District'])->first();
            if (!$district) {
                $this->line($user['District'] . " Not found");
            }
            $division = Division::where('name', $user['Division'])->first();
            if (!$division) {
                $this->line($user['Division'] . " Not found");
            }

            $userNodal = User::create([
                'name' => $user['name'],
                'email' => 'nodal_' . $user['LoginId'],
                'email_verified_at' => now(),
                'password' => bcrypt('secret'),
                'role' => 'lab-nodal-officer',
            ]);
            $userNodal->divisions()->sync($division);
            $userNodal->districts()->sync($district);

            $userTechnical = User::create([
                'name' => $user['name'],
                'email' => 'technical_' . $user['LoginId'],
                'email_verified_at' => now(),
                'password' => bcrypt('secret'),
                'role' => 'lab-technical-officer',
            ]);
            $userTechnical->divisions()->sync($division);
            $userTechnical->districts()->sync($district);

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
