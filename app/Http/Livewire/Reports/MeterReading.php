<?php

namespace App\Http\Livewire\Reports;

use App\Models\Block;
use App\Models\District;
use App\Models\DocumentReport;
use App\Models\Report;
use App\Models\Scheme;
use App\Traits\InteractsWithBanner;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class MeterReading extends Component
{
    use WithExportToCsv;
    use InteractsWithBanner;

    public $districtId;
    public $block;
    public $blocks = [];

    public function download($type)
    {
        $this->validate([
            'block' => 'required|exists:blocks,id',
        ]);
        $report =  DocumentReport::query()
            ->where('district_id', $this->districtId)
            ->where('block_id', $this->block)
            ->when(($type == 'monthly'),
                fn($query) => $query->where('category', DocumentReport::CATEGORY_METER_READING_MONTHLY)
            )
            ->when(($type == 'weekly'),
                fn($query) => $query->where('category', DocumentReport::CATEGORY_METER_READING_WEEKLY)
            )
            ->latest()
            ->first();
        if ($report) {
            return Storage::disk('reports')->download($report->file);
        } else {
            $this->notify('Data not found', 'error');
            return;
        }
    }


    public function getDistrictsProperty()
    {
        return District::orderBy('name')->pluck('name', 'id')->all();
    }

    public function updatedDistrictId()
    {
        if ($this->districtId) {
            $district = District::find($this->districtId);
            $this->blocks = $district?->blocks()?->pluck('name', 'blocks.id') ?? [];
        } else {
            $this->blocks = [];
        }
    }

    public function render()
    {
        return view('livewire.reports.meter-reading');
    }
}
