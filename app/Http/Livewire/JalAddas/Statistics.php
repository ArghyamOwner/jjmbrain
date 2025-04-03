<?php

namespace App\Http\Livewire\JalAddas;

use App\Enums\JaladdaStatus;
use App\Models\JalAdda;
use Livewire\Component;

class Statistics extends Component
{
    public $type;

    public function mount()
    {
        $this->type = request('type', '');
    }

    public function render()
    {
        $jaladda = JalAdda::query()
            ->when(!auth()->user()->isAdministratorOrStateJaldootCell(), function ($query) {
                $query->whereIn('district_id', auth()->user()->districts()->pluck('district_id'));
            })
            ->where('type', $this->type)
            ->withCount('jaladdaStudents')
            ->get();

        return view('livewire.jal-addas.statistics', [
            'totalJalAdda' => $jaladda->count(),
            'jaldootsParticipatedCount' => $jaladda->sum('jaladda_students_count'),
            'pendingJalAdda' => $jaladda->where('status', JaladdaStatus::PENDING)->count(),
            'conpletedJalAdda' => $jaladda->where('status', JaladdaStatus::COMPLETED)->count(),
        ]);
    }
}