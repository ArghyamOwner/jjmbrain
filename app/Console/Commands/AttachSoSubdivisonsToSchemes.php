<?php

namespace App\Console\Commands;

use App\Models\Scheme;
use Illuminate\Console\Command;

class AttachSoSubdivisonsToSchemes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:attach-so-subdivisons-to-schemes';

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
        $schemes = Scheme::query()
            ->with('users:id,name', 'users.subdivisions')
            ->withCount('users')
            ->doesntHave('subdivisions')
            ->has('users.subdivisions')
            ->having('users_count', '=', 1)
            ->get();

        foreach ($schemes as $scheme) {
            $subDivs = [];
            $users = $scheme->users;
            foreach ($users as $user) {
                $subDivs[] = $user->subdivisions->pluck('id')->all();
            }
            $mergedIds = array_unique(array_merge(...array_values($subDivs)));
            $scheme->subdivisions()->sync($mergedIds);
            $this->line('Scheme : ' . $scheme->name);
            $this->line('');
            $this->line('SMT : ' . $scheme->old_scheme_id);
            $this->line('');
            $this->line('IMIS : ' . $scheme->imis_id);
            $this->line('');
        }
    }
}
