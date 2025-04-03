<?php

namespace App\Console\Commands\Reports;

use App\Models\Report;
use App\Models\User;
use App\Traits\WithGenerateAndUploadCsv;
use Illuminate\Console\Command;

class RoleBasedUsers extends Command
{
    use WithGenerateAndUploadCsv;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:role-based-users';

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
        $roles = collect(config('freshman.roles'))->filter(function ($item, $key) {
            return $key != 'admin' && $key != 'super-admin';
        })->sort()->all();

        foreach ($roles as $role => $value) {

            $this->line($role);
            $this->line('  ');

            // if($role != 'section-officer')
            // {
            //     continue;
            // }

            $roleData = User::query()
                ->with('divisions:id,name', 'districts:id,name', 'offices:id,name', 'blocks:id,name', 'subdivisions:id,name')
                ->where('role', $role)
            // ->when(auth()->user()->isTpaAdmin(), fn($query) =>
            //     $query->whereRelation('divisions', fn($q) =>
            //         $q->whereIn('division_id', auth()->user()->divisions()->pluck('division_id'))
            //     ))
                ->when($role === 'section-officer', fn($query) =>
                    $query->withCount('parentSchemes'))
                ->orderBy('name')
                ->lazy();

            if ($roleData->isNotEmpty()) {
                if ($role === 'section-officer') {
                    $users = $roleData->map(fn($data) => [
                        'name' => $data->name,
                        'phone' => $data->phone,
                        'email' => $data->email,
                        'role' => $data->role,
                        'division' => $data->division_names,
                        'sub-division' => $data->subdivision_names,
                        'district' => $data->district_names,
                        'block' => $data->block_names,
                        'office' => $data->office_names,
                        'status' => $data->blocked_at ? 'Blocked' : 'Active',
                        'blocked_at' => $data->blocked_at?->format('d/m/Y'),
                        'schemes(parent)' => $data?->parent_schemes_count,
                        'last_online' => $data->last_online_at?->format('d/m/Y')
                    ])->toArray();
                } else {
                    $users = $roleData->map(fn($data) => [
                        'name' => $data->name,
                        'phone' => $data->phone,
                        'email' => $data->email,
                        'role' => $data->role,
                        'division' => $data->division_names,
                        'sub-division' => $data->subdivision_names,
                        'district' => $data->district_names,
                        'block' => $data->block_names,
                        'office' => $data->office_names,
                        'status' => $data->blocked_at ? 'Blocked' : 'Active',
                        'blocked_at' => $data->blocked_at?->format('d/m/Y'),
                        'last_online' => $data->last_online_at?->format('d/m/Y')
                    ])->toArray();
                }
                $hashedName = $this->generateAndUpload($users, $role . '_users.csv', 'reports');
                $this->line($hashedName);
                $this->line('  ');
                Report::create([
                    'report_number' => 'RBUR04',
                    'title' => $value . ' Users Details',
                    'category' => Report::CATEGORY_ROLE_BASED_USERS,
                    'file' => $hashedName,
                ]);
            }
        }
    }
}
