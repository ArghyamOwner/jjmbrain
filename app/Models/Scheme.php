<?php

namespace App\Models;

use App\Enums\SchemeNature;
use App\Enums\SchemeOperatingStatus;
use App\Enums\SchemeStatus;
use App\Enums\SchemeTypes;
use App\Enums\SchemeWaterSource;
use App\Enums\SchemeWorkStatus;
use App\Scopes\NonArchivedSchemesScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Scheme extends Model
{
    use HasFactory;
    use HasUlids;

    const ARCHIVED = 1;
    const NON_ARCHIVED = 0;

    protected $fillable = [
        'user_id',
        'old_scheme_id',
        'division_id',
        'district_id',
        'block_id',
        'financial_year_id',
        'name',
        'scheme_uin',
        'scheme_type',
        'scheme_status',
        'financial_year',
        'panchayat',
        'village',
        'habitation',
        'lac_id',
        'work_status',
        'operating_status',
        'approved_on',
        'slssc_year',
        'imis_id',
        'has_tea_garden',
        'planned_fhtc',
        'achieved_fhtc',
        'handover_date',
        'latitude',
        'longitude',
        'no_of_villages',
        'state_share',
        'central_share',
        'total_cost',
        'consumer_no',
        'water_source',
        'consumer_bill',
        'handover_document',
        'parent_id',
        'verified_on',
        'verified_by',
        'scheme_nature',
        'is_archived',
        'archived_by',
        'archived_on',
        'energy_type',
        'tpi_progress',
        'new_name',
        'qrscan_count',
        'funding_agency'
    ];

    protected $casts = [
        'scheme_type' => SchemeTypes::class,
        'scheme_status' => SchemeStatus::class,
        'work_status' => SchemeWorkStatus::class,
        'water_source' => SchemeWaterSource::class,
        'operating_status' => SchemeOperatingStatus::class,
        'scheme_nature' => SchemeNature::class,
        'handover_date' => 'date',
        'verified_on' => 'datetime',
        'archived_on' => 'datetime',
    ];

    protected $appends = [
        'consumer_bill_url',
        'handover_document_url',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new NonArchivedSchemesScope);

        self::created(function ($model) {
            $model->schemeActivity()->create([
                'user_id' => auth()->id(),
                'scheme_id' => $model->id,
                'activity_type' => 'created',
                'content' => 'Scheme',
            ]);
        });

        self::updated(function ($model) {
            $model->schemeActivity()->create([
                'user_id' => auth()->id(),
                'scheme_id' => $model->id,
                'activity_type' => 'updated',
                'content' => 'Scheme',
            ]);
        });

        self::deleted(function ($model) {
            $model->schemeActivity()->create([
                'user_id' => auth()->id(),
                'scheme_id' => $model->id,
                'activity_type' => 'deleted',
                'content' => 'Scheme',
            ]);
        });
    }

    public function scopeCompleted($query)
    {
        return $query->whereIn('work_status', ['completed', 'handed-over']);
    }

    public function scopeParent($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeChild($query)
    {
        return $query->whereNotNull('parent_id');
    }

    public function getConsumerBillUrlAttribute()
    {
        return $this->consumer_bill ? Storage::disk('uploads')->url($this->consumer_bill) : null;
    }

    public function getHandoverDocumentUrlAttribute()
    {
        return $this->handover_document ? Storage::disk('uploads')->url($this->handover_document) : null;
    }

    public function schemeActivity()
    {
        return $this->morphOne(SchemeActivity::class, 'feedable');
    }

    public function panchayats()
    {
        return $this->belongsToMany(Panchayat::class);
    }

    public function getPanchayatNamesAttribute()
    {
        return $this->panchayats()->exists() ? $this->panchayats()->pluck('panchayat_name')->implode(', ') : null;
    }

    public function getPanchayatNamesCsvAttribute()
    {
        return $this->panchayats()->exists() ? $this->panchayats()->pluck('panchayat_name')->implode(' | ') : null;
    }

    public function habitations()
    {
        return $this->belongsToMany(Habitation::class);
    }

    public function getHabitationNamesAttribute()
    {
        return $this->habitations()->exists() ? $this->habitations()->pluck('habitation_name')->implode(', ') : null;
    }

    public function villages()
    {
        return $this->belongsToMany(Village::class);
    }

    public function getVillagesNamesAttribute()
    {
        return $this->villages()->exists() ? $this->villages()->pluck('village_name')->implode(', ') : null;
    }

    public function getVillageNamesAttribute()
    {
        return $this->villages()->exists() ? $this->villages()->pluck('village_name')->implode(', ') : null;
    }

    public function blocks()
    {
        return $this->belongsToMany(Block::class);
    }

    public function getBlockNamesAttribute()
    {
        return $this->blocks()->exists() ? $this->blocks()->pluck('name')->implode(', ') : null;
    }

    public function getBlockNamesCsvAttribute()
    {
        return $this->blocks()->exists() ? $this->blocks()->pluck('name')->implode(' | ') : null;
    }

    public function creatorName()
    {
        return $this->user->name;
    }

    public function link()
    {
        return route('schemes.show', ['scheme' => $this->id, 'tab' => 'details']);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function getDivisionNameAttribute()
    {
        return $this->division()->exists() ? $this->division()->pluck('name')->implode(', ') : null;
    }

    public function subdivisions()
    {
        return $this->belongsToMany(Subdivision::class);
    }

    public function getSubdivisionNamesAttribute()
    {
        return $this->subdivisions()->exists() ? $this->subdivisions()->pluck('name')->implode('| ') : null;
    }

    public function latestSubdivision()
    {
        return $this->hasOne(SchemeSubdivision::class, 'scheme_id', 'id')->latestOfMany();
    }

    public function getLinksAttribute()
    {
        return [
            'show' => route('schemes.show', ['scheme' => $this->id, 'tab' => 'details']),
        ];
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function lac()
    {
        return $this->belongsTo(Lac::class);
    }

    public function getDistrictNameAttribute()
    {
        return $this->district()->exists() ? $this->district()->pluck('name')->implode(', ') : null;
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function getBlockNameAttribute()
    {
        return $this->block()->exists() ? $this->block()->pluck('name')->implode(', ') : null;
    }

    public function workorders()
    {
        return $this->belongsToMany(Workorder::class);
    }

    // public function latestWorkorder()
    // {
    //     return $this->hasOne(Workorder::class)->using(SchemeWorkorder::class)->latestOfMany('id');
    // }

    // public function latestWorkorder(): HasOne
    // {
    //     return $this->hasOne(Workorder::class)->using(SchemeWorkorder::class)
    //         ->latestOfMany('id');
    // }

    public function financialYear()
    {
        return $this->belongsTo(FinancialYear::class);
    }

    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class);
    }

    public function lithologs()
    {
        return $this->hasMany(Litholog::class);
    }

    public function schemePipeNetworks()
    {
        return $this->hasMany(SchemePipeNetwork::class);
    }

    public function latestSchemePipeNetwork()
    {
        return $this->hasOne(SchemePipeNetwork::class)->latestOfMany();
    }

    public function approvedLithologs()
    {
        return $this->hasMany(Litholog::class)->where('verification_status', 'accept');
    }

    public function schemeShg()
    {
        return $this->hasOne(SchemeShg::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function grievances()
    {
        return $this->hasMany(Grievance::class);
    }

    public function user() // Jal Mitra
    {
        return $this->belongsTo(User::class);
    }

    public function parentScheme()
    {
        return $this->belongsTo(Scheme::class, 'parent_id');
    }

    public function childSchemeWithWucs()
    {
        return $this->hasMany(Scheme::class, 'parent_id')->with('wucs');
    }

    public function users() // SO Users
    {
        return $this->belongsToMany(User::class);
    }

    public function getSoNamesAttribute()
    {
        return $this->users()->exists() ? $this->users()->pluck('name')->implode(', ') : null;
    }

    public function getSoPhonesAttribute()
    {
        return $this->users()->exists() ? $this->users()->pluck('phone')->implode(', ') : null;
    }

    public function village()
    {
        return $this->belongsToMany(Village::class);
    }

    public function wucs()
    {
        return $this->belongsToMany(Wuc::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function schemeAa(): HasOne
    {
        return $this->hasOne(SchemeAa::class)->latestOfMany();
    }

    public function flowmeterDetails()
    {
        return $this->hasMany(SchemeFlowmeterDetails::class);
    }

    public function latestFlowmeterDetail(): HasOne
    {
        return $this->hasOne(SchemeFlowmeterDetails::class)->latestOfMany();
    } 

    public function latestBlock(): HasOne
    {
        return $this->hasOne(BlockScheme::class, 'scheme_id', 'id')->latestOfMany();
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function schemeQrReports()
    {
        return $this->hasMany(SchemeQrReport::class);
    }

    public function canalTrackings()
    {
        return $this->hasMany(CanalTracking::class);
    }

    public function trackedCanalTrackings()
    {
        return $this->hasMany(CanalTracking::class)->whereNotNull('geojson');
    }

    public function latestTrackedCanalTrackings()
    {
        return $this->hasOne(CanalTracking::class)->whereNotNull('geojson')->latestOfMany();
    }

    public function canalTrackingPoints()
    {
        return $this->hasMany(CanalTrackingPoint::class);
    }

    public function panchayatPayments()
    {
        return $this->hasMany(PanchayatPayment::class);
    }

    public function schemePanchayatVerification()
    {
        return $this->hasOne(SchemePanchayatVerification::class);
    }

    public function latestSchemeArchiveRequest(): HasOne
    {
        return $this->hasOne(SchemeArchiveRequest::class)->latestOfMany();
    }

    public function iotDevices()
    {
        return $this->hasMany(IotDevice::class, 'scheme_id');
    }
    public function schemeVendors()
    {
        return $this->hasMany(SchemeVendor::class, 'scheme_id');
    }

    public function  schemeDailyFlowmeter()
    {
        return $this->hasOne(SchemeDailyFlowmeter::class)->latestOfMany();
    }

    public function schemeDailyFlowmeters()
    {
        return $this->hasMany(SchemeDailyFlowmeter::class);
    }

    public function schemeBinaryData()
    {
        return $this->belongsTo(SchemeBinaryData::class, 'id', 'scheme_id');
    }

    public function  waterReport()
    {
        return $this->hasOne(WaterReport::class)->latestOfMany();
    }

    // For new flow meter start
    // Defining constants for issue types
    const TECHNICAL_ISSUES_PWSS = 'technical_issues_with_pwss';
    const ADMINISTRATIVE_ISSUES = 'administrative_issues';
    // const INSTITUTIONAL_ISSUES = 'institutional_issues';
    const TECHNICAL_ISSUES_APDCL = 'technical_issues_with_apdcl';
    public static function getIssueTypes()
    {
        return [
            self::TECHNICAL_ISSUES_PWSS => 'Technical Issues with PWSS',
            self::ADMINISTRATIVE_ISSUES => 'Administrative Issues',
            // self::INSTITUTIONAL_ISSUES => 'Institutional Issues',
            self::TECHNICAL_ISSUES_APDCL => 'Technical Issues with APDCL',
        ];
    }

    // Defining contants for Technical Issues PWSS
    const PIPELINE_DAMAGE_PWD = 'pipeline_damage_due_to_pwd_road_construction';
    const PIPELINE_DAMAGE_THIRD_PARTY = 'pipeline_damage_other_third_parties';
    const LEAKAGE_DISTRIBUTION_LINE = 'leakage_distribution_line';
    const CENTRIFUGAL_PUMP_MALFUNCTION = 'centrifugal_pump_malfunction';
    const SUBMERSIBLE_PUMP_MALFUNCTION = 'submersible_pump_malfunction';
    const VALVE_LEAKAGE_DAMAGE = 'valve_leakage_damage';
    const WATER_QUALITY_PRECAUTIONS = 'water_quality_precautions';
    const SURFACE_SOURCE_DRIED = 'surface_source_dried';
    const LEAKAGE_ESR = 'leakage_in_esr';
    const PIPELINE_WASHED_FLOODS = 'pipeline_washed_away_due_to_floods';
    const DAMAGE_RWPM = 'damage_in_rwpm';
    const ISSUE_DTW_RETROFITTING = 'issue_in_dtw_retrofitting_schemes';
    const DTW_SOURCE_DRIED = 'dtw_source_dried';
    const ELECTRICAL_FAULT_STARTER = 'electrical_fault_in_starter';
    const BARGE_OVERTURNED_FLOODS = 'barge_overturned_during_high_floods';
    const RAW_WATER_PUMP_SUCTION = 'raw_water_pump_suction_choked';
    public static function getTechnicalIssuesPwss()
    {
        return [
            self::PIPELINE_DAMAGE_PWD => 'Pipeline Damage due to PWD road construction or Augmentation',
            self::PIPELINE_DAMAGE_THIRD_PARTY => 'Pipeline damage (other third parties)',
            self::LEAKAGE_DISTRIBUTION_LINE => 'Leakage in Distribution Line',
            self::CENTRIFUGAL_PUMP_MALFUNCTION => 'Centrifugal Pump Malfunction',
            self::SUBMERSIBLE_PUMP_MALFUNCTION => 'Submersible Pump Malfunction',
            self::VALVE_LEAKAGE_DAMAGE => 'Valve Leakage/Damage',
            self::WATER_QUALITY_PRECAUTIONS => 'Water Quality Precautions',
            self::SURFACE_SOURCE_DRIED => 'Surface Source Dried Up',
            self::LEAKAGE_ESR => 'Leakage in ESR (Elevated Storage Reservoir)',
            self::PIPELINE_WASHED_FLOODS => 'Pipeline Washed Away due to Floods',
            self::DAMAGE_RWPM => 'Damage in Raw Water Pumping Main (RWPM)',
            self::ISSUE_DTW_RETROFITTING => 'Issue in Deep Tube Well (DTW) for Retrofitting Schemes',
            self::DTW_SOURCE_DRIED => 'Deep Tube Well (DTW) Source Dried Up',
            self::ELECTRICAL_FAULT_STARTER => 'Electrical Fault in the Starter',
            self::BARGE_OVERTURNED_FLOODS => 'Barge overturned during high floods',
            self::RAW_WATER_PUMP_SUCTION => 'Raw water pump suction choked by floating debris',
        ];
    }

    // Defining contants for Administrative Issues
    const ELECTRICITY_DISCONNECTED = 'electricity_disconnected_due_to_non_payment';
    const INACTIVE_JAL_MITRA = 'inactive_jal_mitra';
    const IRREGULAR_SALARY_JAL_MITRA = 'irregular_salary_jal_mitra';
    const INADEQUATE_OM_FUNDING = 'inadequate_om_funding';
    const DELAY_PROCUREMENT_SPARE_PARTS = 'delay_procurement_spare_parts';
    public static function getAdministrativeIssues()
    {
        return [
            self::ELECTRICITY_DISCONNECTED => 'Electricity Disconnected due to Non-Payment',
            self::INACTIVE_JAL_MITRA => 'Inactive Jal Mitra',
            self::IRREGULAR_SALARY_JAL_MITRA => 'Irregular Salary of Jal Mitra',
            self::INADEQUATE_OM_FUNDING => 'Inadequate O&M Funding',
            self::DELAY_PROCUREMENT_SPARE_PARTS => 'Delay in Procurement of Spare Parts',
        ];
    }

    // Defining constants for Technical Issues
    const VOLTAGE_LOAD_ISSUES = 'voltage_load_issues';
    const PIPELINE_DAMAGE_APDCL = 'pipeline_damage_due_to_apdcl_powerline_work';
    const TRANSFORMER_DAMAGE = 'transformer_damage';
    public static function getInstitutionalIssues()
    {
        return [
            self::VOLTAGE_LOAD_ISSUES => 'Voltage or Load Issues',
            self::PIPELINE_DAMAGE_APDCL => 'Pipeline Damage due to APDCL Powerline work',
            self::TRANSFORMER_DAMAGE => 'Transformer Damage',
        ];
    }
    // For new flow meter end
    // New Attributes
    public function getDlpDaysLeftAttribute()
    {
        
        if ($this->handover_date) {
            $handoverDate = Carbon::parse($this->handover_date);
            $currentDate = Carbon::now();
            // $monthsDifference = $handoverDate->diffInMonths($currentDate);
            // if ($monthsDifference <= 6) {
            //     $handedOverColor = 'green';
            //     $handedOverToolTip = 'DLP 6 months completed';
            // } elseif ($monthsDifference >= 7 && $monthsDifference <= 10) {
            //     $handedOverColor = 'orange';
            //     $handedOverToolTip = 'DLP 7th to 10th months completed';
            // } elseif ($monthsDifference >= 11 && $monthsDifference <= 12) {
            //     $handedOverColor = 'red';
            //     $handedOverToolTip = 'DLP 11th to 12th months completed';
            // } else {
            //     $handedOverColor = 'red';
            //     $handedOverToolTip = 'DLP period completed';
            // }
            // get percentage //
            $daysDifference = $handoverDate->diffInDays($currentDate);
            // is time over
            if ($daysDifference >= 365) {
                // $handedOverPercentage = 100;
               return 0;
            } else {
                // $handedOverPercentage = ($daysDifference / 365) * 100;
                return 365 - $daysDifference;
            }
        }
        return 0;
    }
    public function getDlpBadgeColorAttribute()
    { 
        if ($this->handover_date) {
            $handoverDate = Carbon::parse($this->handover_date);
            $currentDate = Carbon::now();
            $monthsDifference = $handoverDate->diffInMonths($currentDate);
            if ($monthsDifference <= 6) {
               return 'success';
            } elseif ($monthsDifference >= 7 && $monthsDifference <= 10) {
                return 'warning';
            } elseif ($monthsDifference >= 11 && $monthsDifference <= 12) {
                return 'danger';
            } else {
                return 'danger';
            } 
        }
        return 'danger';
    }
}
