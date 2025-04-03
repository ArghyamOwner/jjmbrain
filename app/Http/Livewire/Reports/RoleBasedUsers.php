<?php

namespace App\Http\Livewire\Reports;

use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class RoleBasedUsers extends Component
{
    public function getRolesProperty()
    {
        return Report::query()
            ->where('category', Report::CATEGORY_ROLE_BASED_USERS)
            ->today()
            ->orderBy('title')
            ->get();

        // return collect(config('freshman.roles'))->filter(function ($item, $key) {
        //     return $key != 'admin' && $key != 'super-admin';
        // })->sort();
    }

    public function download($file)
    {
        return Storage::disk('reports')->download($file);
    }

    public function render()
    {
        return view('livewire.reports.role-based-users');
    }
}
