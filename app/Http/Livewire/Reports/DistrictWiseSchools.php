<?php

namespace App\Http\Livewire\Reports;

use Livewire\Component;
use App\Models\Report;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\Storage;

class DistrictWiseSchools extends Component
{
    use WithExportToCsv;

    public function getReportsProperty()
    {
        return Report::query()
            ->where('category', Report::CATEGORY_DISTRICT_WISE_SCHOOLS)
            ->today()
            ->when((auth()->user()->isDistrictJaldootCell()),
                fn($query) => $query->whereIn('district_id', auth()->user()->districts()->pluck('district_id')))
            ->orderBy('title')
            ->get();
    }

    public function download($file)
    {
        return Storage::disk('reports')->download($file);
    }

    public function render()
    {
        return view('livewire.reports.district-wise-schools', [
            'reports' => $this->reports,
        ]);
    }
}
