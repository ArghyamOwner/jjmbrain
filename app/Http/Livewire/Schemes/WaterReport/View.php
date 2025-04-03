<?php

namespace App\Http\Livewire\Schemes\WaterReport;

use App\Enums\SchemeOperatingStatus;
use App\Models\Scheme;
use App\Models\WaterReport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class View extends Component
{
    public WaterReport $waterReport;
    public $isResolved;
    public $remarks;
    public $resolvedDate;
    public $operating_status;

    public function mount(WaterReport $waterReport)
    {
        $this->waterReport = $waterReport->loadMissing(['scheme', 'approvedBy:id,name', 'closedBy:id,name']);
        $this->remarks = $this->waterReport->remarks;
        $this->isResolved = $this->waterReport->resolved;
        $this->resolvedDate = Carbon::parse($this->waterReport->resolved_date)->format('Y-m-d');
    }

    public function getSchemeOperatingStatusesProperty()
    {
        return collect(SchemeOperatingStatus::cases());
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['isResolved', 'updateStatus', 'operating_status'])) {}
    }

    public function updateStatus()
    {
        $this->validate([
            'remarks' => ['required'],
            'isResolved' => ['required', 'boolean'],
            'resolvedDate' => ['required', 'date', 'before_or_equal:' . Carbon::now()->format('Y-m-d')],
        ]);
        if ($this->isResolved == false) {
            return $this->notify('Please check the "Resolved" option if the report is marked as resolved.', 'error');
        }
        $this->waterReport->status = $this->isResolved ? 'resolved' : 'pending';
        $this->waterReport->remarks = $this->remarks;
        $this->waterReport->resolved = $this->isResolved;
        $this->waterReport->resolved_date = $this->resolvedDate;
        $this->waterReport->save();
        $this->notify('Water Report updated successfully.');
    }

    public function approved()
    {
        try {
            DB::transaction(function () {
                $this->waterReport->status = 'approved';
                $this->waterReport->approved_by = auth()->id();
                $this->waterReport->approved_date = now();
                $this->waterReport->save();
                $this->waterReport->refresh();
                Scheme::where('id', $this->waterReport->scheme_id)
                    ->update(['operating_status' => $this->waterReport->operating_status]);
                $this->notify('Approved successfully.');
            });
        } catch (\Exception $e) {
            Log::info($e);
            $this->notify('Please try again', 'error');
        }
    }

    public function closed()
    {
        $validated = $this->validate([
            'operating_status' => ['required'],
        ]);
        try {
            DB::transaction(function () use ($validated) {
                $this->waterReport->status = 'closed';
                $this->waterReport->closed_by = auth()->id();
                $this->waterReport->save();
                Scheme::where('id', $this->waterReport->scheme_id)
                    ->update(['operating_status' => $validated['operating_status']]);
                $this->waterReport->refresh();
                $this->notify('Resolved successfully.');
            });
        } catch (\Exception $e) {
            Log::info($e);
            $this->notify('Please try again', 'error');
        }
    }

    public function render()
    {
        return view('livewire.schemes.water-report.view');
    }
}
