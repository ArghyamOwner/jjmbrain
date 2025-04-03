<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Report extends Model
{
    use HasFactory, HasUlids;

    const CATEGORY_STATE_MASTER_SCHEME = 'state_master_scheme';
    const CATEGORY_DIVISION_WISE_SCHEME_DETAILS = 'division_wise_schemes';
    const CATEGORY_DIVISION_SUMMARY_REPORT = 'division_summary_report';
    const CATEGORY_PG_SUMMARY_REPORT = 'pg_summary_report';
    const CATEGORY_ROLE_BASED_USERS = 'role_based_users';
    const CATEGORY_DIVISION_WISE_VILLAGE_FTK = 'division_wise_village_ftk';
    const CATEGORY_DISTRICT_WISE_ISA = 'district_wise_isa';
    const CATEGORY_DISTRICT_WISE_SCHOOLS = 'district_wise_schools';
    const CATEGORY_DISTRICT_WISE_JALSHALA_SUMMARY = 'district_wise_jalshala_summary';
    const CATEGORY_DIVISION_SO_TASK_SUMMARY = 'division_so_task_summary';
    const CATEGORY_SO_TASK_REPORT = 'so_task_report';
    const CATEGORY_SCHEMES_WITHOUT_SO = 'schemes_without_so';
    const CATEGORY_CONTRACTOR_COMPLETED_TASK = 'contractor_completed_task';
    const CATEGORY_SCHEMES_WITHOUT_OR_WRONG_IMIS = 'schemes_without_or_wrong_imis';
    const CATEGORY_DISTRICT_SUMMARY = 'district_summary';
    const CATEGORY_WORKORDERS_WITHOUT_PG = 'workorders_without_pg';
    const CATEGORY_DISTRICT_WISE_WUC = 'district_wise_wuc';
    const CATEGORY_VILLAGES_WITHOUT_ISA = 'villages_without_isa';
    const CATEGORY_DISTRICT_WISE_SCHEMES_WITHOUT_WUC = 'district_wise_schemes_without_wuc';
    const CATEGORY_SCHEMES_WITHOUT_ISA = 'schemes_without_isa';
    const CATEGORY_LITHOLOG_LOCATION_REPORT = 'litholog_location_report';
    const CATEGORY_LITHOLOG_ORIENTATION_REPORT = 'litholog_orientation_report';
    const CATEGORY_LITHOLOG_LITHOLOGY_REPORT = 'litholog_lithology_report';
    const CATEGORY_LITHOLOG_WELL_CONSTRUCTION_REPORT = 'litholog_well_construction_report';
    const CATEGORY_LITHOLOG_AQUIFER_REPORT = 'litholog_aquifer_report';
    const CATEGORY_DIVISION_HANDOVER_SUMMARY = 'division_handover_summary';
    const CATEGORY_DIVISION_PIPE_NETWORK = 'division_pipe_network';
    const CATEGORY_PLEDGED_FAVOR_PG_DETAIL = 'pledged_favor_pg_detail';
    const CATEGORY_LATEST_FLOWMETER_SCHEME = 'latest_flowmeter_scheme';
    const CATEGORY_METER_READING_MONTHLY = 'meter_reading_monthly';
    const CATEGORY_METER_READING_WEEKLY = 'meter_reading_weekly'; 
    const CATEGORY_WATER_DISRUPTION_WEEKLY_REPORT = 'water_disruption_weekly_report';

    protected $fillable = [
        'report_number',
        'category',
        'title',
        'file',
        'division_id',
        'district_id',
        'block_id',
    ];

    protected $appends = [
        'file_url',
    ];

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', now());
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function getFileUrlAttribute()
    {
        return $this->file ? Storage::disk('reports')->url($this->file) : null;
    }
}
