<?php

namespace App\Models;

use App\Enums\JalshalaType;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationBlock extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'district_id',
        'block_name',
        'block_code'
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function jalshalas()
    {
        return $this->belongsToMany(Jalshala::class);
    }

    public function organisedJalshalas()
    {
        return $this->jalshalas()->where('status', 'completed');
    }

    public function plannedJalshalas()
    {
        return $this->jalshalas()->where('status', 'pending');
    }

    public function phaseIOrganisedJalshalas()
    {
        return $this->jalshalas()->where('type', JalshalaType::PHASE_I)->where('status', 'completed');
    }

    public function phaseIPlannedJalshalas()
    {
        return $this->jalshalas()->where('type', JalshalaType::PHASE_I)->where('status', 'pending');
    }

    public function phaseIIOrganisedJalshalas()
    {
        return $this->jalshalas()->where('type', JalshalaType::PHASE_II)->where('status', 'completed');
    }

    public function phaseIIPlannedJalshalas()
    {
        return $this->jalshalas()->where('type', JalshalaType::PHASE_II)->where('status', 'pending');
    }

    public function educationBlockJalshalas()
    {
        return $this->hasMany(EducationBlockJalshala::class,  'id');
    }
}
