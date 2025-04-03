<?php

namespace App\Http\Livewire\Reports;

use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class DivisionWiseLitholog extends Component
{
    public function getReportsProperty()
    {
        $user = auth()->user();
        // return Report::query()
        //     ->whereIn('category', [
        //         Report::CATEGORY_LITHOLOG_LOCATION_REPORT,
        //         Report::CATEGORY_LITHOLOG_ORIENTATION_REPORT,
        //         Report::CATEGORY_LITHOLOG_LITHOLOGY_REPORT,
        //         Report::CATEGORY_LITHOLOG_WELL_CONSTRUCTION_REPORT,
        //         Report::CATEGORY_LITHOLOG_AQUIFER_REPORT,
        //     ])
        //     ->today()
        //     ->when(($user->isExecutiveEngineer() || $user->isSectionOfficer() || $user->isSdo()),
        //         fn($query) => $query->whereIn('division_id', $user->divisions()->pluck('division_id')))
        //     ->orderBy('title')
        //     ->get();
        return Report::query()
            ->select('id', 'file', 'division_id', 'title')
            ->with('division:id,name')
            ->whereIn('category', [
                Report::CATEGORY_LITHOLOG_LOCATION_REPORT,
                Report::CATEGORY_LITHOLOG_ORIENTATION_REPORT,
                Report::CATEGORY_LITHOLOG_LITHOLOGY_REPORT,
                Report::CATEGORY_LITHOLOG_WELL_CONSTRUCTION_REPORT,
                Report::CATEGORY_LITHOLOG_AQUIFER_REPORT,
            ])
            ->today()
            ->get()
            ->groupBy('division.name');
    }

    public function download($file)
    {
        return Storage::disk('reports')->download($file);
    }

    // public function getDivisionsProperty()
    // {
    //     $user = auth()->user();

    //     return Division::query()
    //         ->select('name', 'id')
    //         ->when(($user->isExecutiveEngineer() || $user->isSectionOfficer() || $user->isSdo()),
    //             fn($query) => $query->whereIn('id', $user->divisions()->pluck('division_id')))
    //         ->orderBy('name', 'asc')
    //         ->get();
    // }

    public function render()
    {
        return view('livewire.reports.division-wise-litholog', [
            // 'divisions' => $this->divisions,
            'reports' => $this->reports,
        ]);
    }
}
