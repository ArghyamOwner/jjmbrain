<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Scheme;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class ImportSoScheme extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-so-scheme';

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
                $users = File::json(base_path('database/so_scheme.json'));

                $progressBar = $this->output->createProgressBar(count($users));

                $this->line('SO Scheme importing...');
 
                $progressBar->start();

                foreach ($users as $user) {
                    $userFound = User::where('phone', $user['phone'])->orWhere('email', $user['email'])->first();
  
                    if ($userFound) {

                        $scheme = Scheme::where('old_scheme_id', $user['scheme_id'])->first();
 

                        if ($scheme) {
                            $userFound->schemes()->attach($scheme->id);
                        }
                       
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
