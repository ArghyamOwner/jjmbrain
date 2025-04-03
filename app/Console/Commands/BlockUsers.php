<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class BlockUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:block-users';

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

                $users = File::json(base_path('database/block_jalmitra.json'));

                $progressBar = $this->output->createProgressBar(count($users));

                $this->line('Blocking Users...');

                $progressBar->start();

                foreach ($users as $user) {
                    $data = User::where('email', $user['email'])->first();

                    if ($data) {
                        $data->update([
                            'blocked_by' => '01gy7ktz1cgvjqm4txff3r122p',
                            'blocked_at' => now(),
                            'phone' => NULL
                        ]);
                    }
                    $progressBar->advance();

                }

                $progressBar->finish();

                $this->line('');

                // the info method will display in the console as green colored text:
                $this->info('Blocked Successfully!');
            });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }
    }
}
