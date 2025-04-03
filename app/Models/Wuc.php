<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;

class Wuc extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'district_id',
        'revenue_circle_id',
        'block_id',
        'formation_date',
        'approval_date',
        'approval_document',
        'constitution_document',
        'bank_name',
        'account_number',
        'ifsc',
        'fhtc',
        'household',
        'tariff_per_hh',
        'president_name',
        'secretary_name',
    ];

    protected $casts = [
        'formation_date' => 'date',
        'approval_date' => 'date',
    ];

    protected $appends = [
        'approval_document_url',
        'constitution_document_url',
    ];

    protected static function booted()
    {
        self::deleted(function ($model) {
            $model->schemeActivity()->create([
                'user_id' => auth()->id(),
                'scheme_id' => $model->schemes?->pluck('id')?->first(),
                'activity_type' => 'wuc_deleted',
                'content' => $model->name,
            ]);
        });
    }

    public function schemeActivity()
    {
        return $this->morphOne(SchemeActivity::class, 'feedable');
    }

    public function getApprovalDocumentUrlAttribute()
    {
        return $this->approval_document ? Storage::disk('uploads')->url($this->approval_document) : null;
    }

    public function getConstitutionDocumentUrlAttribute()
    {
        return $this->constitution_document ? Storage::disk('uploads')->url($this->constitution_document) : null;
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function revenueCircle()
    {
        return $this->belongsTo(RevenueCircle::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function schemes()
    {
        return $this->belongsToMany(Scheme::class);
    }

    public function getSchemeNamesAttribute()
    {
        return $this->schemes()->exists() ? $this->schemes()->pluck('name')->implode(', ') : null;
    }

    public function isas()
    {
        return $this->belongsToMany(Isa::class);
    }

    public function latestIsa()
    {
        return $this->belongsToMany(Isa::class)->orderBy('id')->limit(1);
    }

    public function wucVolunteers()
    {
        return $this->hasMany(WucVolunteer::class);
    }

    public function wucMembers()
    {
        return $this->hasMany(WucMember::class);
    }

    public function wucPresidents()
    {
        return $this->hasMany(WucMember::class)->where('designation', 'president');
    }

    public function monthlyExpenditures()
    {
        return $this->hasMany(MonthlyExpenditure::class);
    }

    public function panchayatPayments()
    {
        return $this->hasMany(PanchayatPayment::class);
    }

    public function wucDocuments()
    {
        return $this->hasMany(WucDocument::class)->latest();
    }
}
