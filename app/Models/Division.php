<?php

namespace App\Models;

use App\Enums\SchemeWorkStatus;
use App\Scopes\NonArchivedDivisionsScope;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Division extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'zone_id',
        'circle_id',
        'name',
        'archived_on',
    ];

    protected $casts = [
        'archived_on' => 'datetime',
    ];

    protected static function booted()
    {
        static::addGlobalScope(new NonArchivedDivisionsScope);
    }

    public function schemes()
    {
        return $this->hasMany(Scheme::class);
    }

    public function parentSchemes()
    {
        return $this->hasMany(Scheme::class)->whereNull('parent_id');
    }

    public function lithologs(): HasManyThrough
    {
        return $this->hasManyThrough(Litholog::class, Scheme::class);
    }

    public function pendingLithologs(): HasManyThrough
    {
        return $this->hasManyThrough(Litholog::class, Scheme::class)->whereNull('lithologs.verified_by');
    }

    public function verifiedLithologs(): HasManyThrough
    {
        return $this->hasManyThrough(Litholog::class, Scheme::class)->whereNotNull('lithologs.verified_by');
    }

    public function handedoverSchemes()
    {
        return $this->hasMany(Scheme::class)->where('work_status', SchemeWorkStatus::HANDED_OVER);
    }

    public function handedoverParentSchemes()
    {
        return $this->hasMany(Scheme::class)->where('work_status', SchemeWorkStatus::HANDED_OVER)->whereNull('parent_id');
    }

    public function flowmeters()
    {
        return $this->hasManyThrough(
            SchemeFlowmeterDetails::class,
            Scheme::class,
            'division_id', // Foreign key on the schemes table
            'scheme_id', // Foreign key on the scheme_daily_flowmeters table
            'id', // Local key on the divisions table
            'id' // Local key on the schemes table
        );
    }

    public function schemesWithSo()
    {
        return $this->hasMany(Scheme::class)->whereHas('users');
    }

    public function panchayatVerifiedSchemes(): HasManyThrough
    {
        return $this->hasManyThrough(SchemePanchayatVerification::class, Scheme::class);
    }

    public function qrInstalledSchemes(): HasManyThrough
    {
        return $this->hasManyThrough(SchemeQrReport::class, Scheme::class)->distinct();
    }

    public function trackedCanalTrackings(): HasManyThrough
    {
        return $this->hasManyThrough(CanalTracking::class, Scheme::class)->whereNotNull('geojson');
    }

    public function jalmitraSchemes()
    {
        return $this->hasMany(Scheme::class)->whereNotNull('user_id');
    }

    public function jalMitras()
    {
        return $this->users()->where('role', 'jal-mitra');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }

    public function subdivisions()
    {
        return $this->hasMany(Subdivision::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function districts()
    {
        return $this->belongsToMany(District::class);
    }

    public function sectionOfficers()
    {
        return $this->users()->where('role', 'section-officer');
    }

    public function sdos()
    {
        return $this->users()->where('role', 'sdo');
    }

    public function grievances()
    {
        return $this->hasMany(Grievance::class);
    }

    public function resolvedGrievances()
    {
        return $this->grievances()->where('status', Grievance::STATUS_RESOLVED);
    }
}
