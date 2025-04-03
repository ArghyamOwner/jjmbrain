<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemeBinaryData extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'scheme_id',

        'source',
        'source_date',
        'source_updated_by',

        'tp',
        'tp_date',
        'tp_updated_by',

        'ugr',
        'ugr_date',
        'ugr_updated_by',

        'esr',
        'esr_date',
        'esr_updated_by',

        'pump_house',
        'pump_house_date',
        'pump_house_updated_by',

        'apdcl',
        'apdcl_date',
        'apdcl_updated_by',

        'internal_connection',
        'internal_connection_date',
        'internal_connection_updated_by',

        'gen_set',
        'gen_set_date',
        'gen_set_updated_by',

        'lds',
        'lds_date',
        'lds_updated_by',

        'site_development',
        'site_development_date',
        'site_development_updated_by',

        'boundary_wall',
        'boundary_wall_date',
        'boundary_wall_updated_by',

        'painting',
        'painting_date',
        'painting_updated_by',

        'rwp',
        'rwp_date',
        'rwp_updated_by',

        'cwp',
        'cwp_date',
        'cwp_updated_by',

        'network',
        'network_date',
        'network_updated_by',

        'fhtc',
        'fhtc_date',
        'fhtc_updated_by',

        'trial_run',
        'trial_run_date',
        'trial_run_updated_by',

        'work_completion',
        'work_completion_date',
        'work_completion_updated_by',

        'scheme_handover',
        'scheme_handover_date',
        'scheme_handover_updated_by',

        'panchayat_verified',
        'panchayat_verified_date',
        'panchayat_verified_updated_by',

        'preliminary_workorder',
        'preliminary_workorder_date',
        'preliminary_workorder_updated_by',

        'preliminary_activities',
        'preliminary_activities_date',
        'preliminary_activities_updated_by',

        'formal_workorder',
        'formal_workorder_date',
        'formal_workorder_updated_by',
    ];

    protected $casts = [
        'source_date' => 'date',
        'tp_date' => 'date',
        'ugr_date' => 'date',
        'esr_date' => 'date',
        'pump_house_date' => 'date',
        'apdcl_date' => 'date',
        'internal_connection_date' => 'date',
        'gen_set_date' => 'date',
        'lds_date' => 'date',
        'site_development_date' => 'date',
        'boundary_wall_date' => 'date',
        'painting_date' => 'date',
        'rwp_date' => 'date',
        'cwp_date' => 'date',
        'network_date' => 'date',
        'fhtc_date' => 'date',
        'trial_run_date' => 'date',
        'work_completion_date' => 'date',
        'scheme_handover_date' => 'date',
        'panchayat_verified_date' => 'date',
        'preliminary_workorder_date' => 'date',
        'preliminary_activities_date' => 'date',
        'formal_workorder_date' => 'date',
    ];

    public function sourceUpdatedBy()
    {
        return $this->belongsTo(User::class, 'source_updated_by');
    }

    public function tpUpdatedBy()
    {
        return $this->belongsTo(User::class, 'tp_updated_by');
    }

    public function ugrUpdatedBy()
    {
        return $this->belongsTo(User::class, 'ugr_updated_by');
    }

    public function esrUpdatedBy()
    {
        return $this->belongsTo(User::class, 'esr_updated_by');
    }

    public function pumpHouseUpdatedBy()
    {
        return $this->belongsTo(User::class, 'pump_house_updated_by');
    }

    public function apdclUpdatedBy()
    {
        return $this->belongsTo(User::class, 'apdcl_updated_by');
    }

    public function internalConnectionUpdatedBy()
    {
        return $this->belongsTo(User::class, 'internal_connection_updated_by');
    }

    public function genSetUpdatedBy()
    {
        return $this->belongsTo(User::class, 'gen_set_updated_by');
    }

    public function ldsUpdatedBy()
    {
        return $this->belongsTo(User::class, 'lds_updated_by');
    }

    public function siteDevelopmentUpdatedBy()
    {
        return $this->belongsTo(User::class, 'site_development_updated_by');
    }

    public function boundaryWallUpdatedBy()
    {
        return $this->belongsTo(User::class, 'boundary_wall_updated_by');
    }

    public function paintingUpdatedBy()
    {
        return $this->belongsTo(User::class, 'painting_updated_by');
    }

    public function rwpUpdatedBy()
    {
        return $this->belongsTo(User::class, 'rwp_updated_by');
    }

    public function cwpUpdatedBy()
    {
        return $this->belongsTo(User::class, 'cwp_updated_by');
    }

    public function networkUpdatedBy()
    {
        return $this->belongsTo(User::class, 'network_updated_by');
    }

    public function fhtcUpdatedBy()
    {
        return $this->belongsTo(User::class, 'fhtc_updated_by');
    }

    public function trialRunUpdatedBy()
    {
        return $this->belongsTo(User::class, 'trial_run_updated_by');
    }

    public function workCompletionUpdatedBy()
    {
        return $this->belongsTo(User::class, 'work_completion_updated_by');
    }

    public function schemeHandoverUpdatedBy()
    {
        return $this->belongsTo(User::class, 'scheme_handover_updated_by');
    }

    public function panchayatVerifiedUpdatedBy()
    {
        return $this->belongsTo(User::class, 'panchayat_verified_updated_by');
    }

    public function preliminaryActivitiesUpdatedBy()
    {
        return $this->belongsTo(User::class, 'preliminary_activities_updated_by');
    }

    public function preliminaryWorkorderUpdatedBy()
    {
        return $this->belongsTo(User::class, 'preliminary_workorder_updated_by');
    }

    public function formalWorkorderUpdatedBy()
    {
        return $this->belongsTo(User::class, 'formal_workorder_updated_by');
    }

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }
}
