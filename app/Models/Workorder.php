<?php

namespace App\Models;

use App\Enums\TaskCategory;
use App\Enums\WorkorderStatus;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Workorder extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'pkg_id',
        'old_workorder_id',
        'circle_id',
        'contractor_id',
        'administrative_approval_id',
        'technicalsanction_id',

        'workorder_name',
        'issuing_authority',
        'workorder_number',
        'workorder_funding_agency',
        'workorder_amount',
        'workorder_type',
        'workorder_status',
        'workorder_estimated_date',
        'remarks',

        'pg_percentage',
        'pg_status',
        'formal_workorder_number',
        'formal_workorder_date',

        'aa_number',
        'aa_date',
        'aa_document',

        'ts_number',
        'ts_date',
        'ts_document',
        'division_id',
        'fhtc_no',
        'formal_workorder_amount',
        'ts_amount',
    ];

    protected $casts = [
        'workorder_estimated_date' => 'date',
        'workorder_type' => TaskCategory::class,
        'workorder_status' => WorkorderStatus::class,
    ];

    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function assignmentTasks()
    {
        return $this->hasMany(AssignmentTask::class);
    }

    public function workdocuments()
    {
        return $this->hasMany(Workdocument::class);
    }

    public function performanceGuarantees()
    {
        return $this->belongsToMany(PerformanceGuarantee::class);
    }

    public function schemes()
    {
        return $this->belongsToMany(Scheme::class);
    }

    public function getSchemeNamesAttribute()
    {
        return $this->schemes()->exists() ? $this->schemes()->pluck('name')->implode(', ') : null;
    }

    public function getSchemeSmtIdsAttribute()
    {
        return $this->schemes()->exists() ? $this->schemes()->pluck('old_scheme_id')->implode(', ') : null;
    }

    public function getSchemeImisIdsAttribute()
    {
        return $this->schemes()->exists() ? $this->schemes()->pluck('imis_id')->implode(', ') : null;
    }

    public function contractor()
    {
        return $this->belongsTo(User::class, 'contractor_id');
    }

    public function calculateWorkorderValue()
    {
        if ($this->pg_status === 'PG incomplete') {
            $totalPgAmount = $this->performanceGuarantees()
                ->whereDate('expired_date', '>', now()->format('Y-m-d'))
                ->sum('pg_amount');

            $expectedPgAmount = $this->workorder_amount * 0.05;

            if ($totalPgAmount >= $expectedPgAmount) {
                $this->pg_status = 'PG complete';
            } else {
                $this->pg_status = 'PG incomplete';
            }

            $this->pg_amount = $expectedPgAmount - $totalPgAmount;
            $this->save();
        }
    }

    public function schemeActivity()
    {
        return $this->morphOne(SchemeActivity::class, 'feedable');
    }

    public function link()
    {
        return route('workorders.show', $this->id);
    }
}
