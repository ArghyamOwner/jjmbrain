<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;

class RoleBasedUserListController extends Controller
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public function generate($role)
    {
        $roleData = User::query()
            ->with('divisions:id,name', 'districts:id,name', 'offices:id,name', 'blocks:id,name')
            ->where('role', $role)
            ->when(auth()->user()->isTpaAdmin(), fn($query) => 
                $query->whereRelation('divisions', fn($q) => 
                    $q->whereIn('division_id', auth()->user()->divisions()->pluck('division_id'))
                ))
            ->where('role', '!=', 'admin')        
            ->orderBy('name')
            ->lazy();

        if ($roleData->isNotEmpty()) {
            $users = $roleData->map(fn($data) => [
                'name' => $data->name,
                'phone' => $data->phone,
                'email' => $data->email,
                'role' => $data->role,
                'division' => $data->division_names ?? '-',
                'district' => $data->district_names ?? '-',
                'block' => $data->block_names ?? '-',
                'office' => $data->office_names ?? '-',
            ])->toArray();

            return $this->exportToCsv($users, $role . '_users.csv');
        } else {
            $this->banner('Data not found');
            return redirect()->back();
        }
    }
}
