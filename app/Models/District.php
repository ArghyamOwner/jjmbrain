<?php

namespace App\Models;

use App\Enums\JalshalaType;
use App\Enums\PanchayatPaymentTypes;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'targeted_jalshala',
        'slug',
        'phase2_targeted_jalshala'
    ];

    public function blocks()
    {
        return $this->hasMany(Block::class);
    }

    public function panchayats()
    {
        return $this->hasManyThrough(Panchayat::class, Block::class);
    }

    public function wucs()
    {
        return $this->hasMany(Wuc::class);
    }

    public function isas()
    {
        return $this->hasMany(Isa::class);
    }

    public function activityDetails()
    {
        return $this->hasMany(ActivityDetail::class);
    }

    public function schemes()
    {
        return $this->hasMany(Scheme::class);
    }

    public function parentSchemes()
    {
        return $this->hasMany(Scheme::class)->whereNull('parent_id');
    }

    public function villages()
    {
        return $this->hasMany(Village::class);
    }

    public function handoverSchemes()
    {
        return $this->schemes()->where('work_status', 'handed-over');
    }

    public function parentHandoverSchemes()
    {
        return $this->parentSchemes()->where('work_status', 'handed-over');
    }

    public function revenueCircles()
    {
        return $this->hasMany(RevenueCircle::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function jalshalas()
    {
        return $this->hasMany(Jalshala::class);
    }

    public function organisedJalshalas()
    {
        return $this->jalshalas()->where('status', 'completed');
    }

    public function plannedJalshalas()
    {
        return $this->jalshalas()->where('status', 'pending');
    }

    public function jalMitras()
    {
        return $this->users()->where('role', 'jal-mitra');
    }

    public function panchayatPayments()
    {
        return $this->hasMany(PanchayatPayment::class);
    }

    public function electricalPanchayatPayments()
    {
        return $this->panchayatPayments()->where('amount_for', PanchayatPaymentTypes::ELECTRICITY_BILL);
    }

    public function chemicalPanchayatPayments()
    {
        return $this->panchayatPayments()->where('amount_for', PanchayatPaymentTypes::CHEMICAL);
    }

    public function jalmitraPanchayatPayments()
    {
        return $this->panchayatPayments()->where('amount_for', PanchayatPaymentTypes::JALMITRA_SALARY);
    }

    public function maintenancePanchayatPayments()
    {
        return $this->panchayatPayments()->where('amount_for', PanchayatPaymentTypes::MAINTENANCE);
    }

    public function otherPanchayatPayments()
    {
        return $this->panchayatPayments()->where('amount_for', PanchayatPaymentTypes::OTHER);
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

    public function phaseIJalshalaStatics()
    {
        $today = Carbon::today();
        return $this->hasMany(JalshalaStatics::class, 'district_id')->whereDate('created_at', $today)->where('type', JalshalaType::PHASE_I);
    }
    public function phaseIIJalshalaStatics()
    {
        $today = Carbon::today();
        return $this->hasMany(JalshalaStatics::class, 'district_id')->whereDate('created_at', $today)->where('type', JalshalaType::PHASE_II);
    }
}
