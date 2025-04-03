<?php

namespace App\Models;

use App\Enums\SchemeOperatingStatus;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterReport extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'scheme_id',
        'user_id',
        'approved_by',
        'status',
        'operating_status',
        'reasons_disruption',
        'specific_reasons',
        'days',
        'remarks',
        'resolved',
        'resolved_date',
        'closed_by',
        'approved_date',
        'operating_status_from',
    ];

    protected $casts = [
        'resolved' => 'boolean',
        'resolved_date' => 'date',
        'approved_date' => 'date',
        'specific_reasons' => 'array',
        'operating_status' => SchemeOperatingStatus::class,
        'operating_status_from' => SchemeOperatingStatus::class,
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function sectionOfficer()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function closedBy()
    {
        return $this->belongsTo(User::class, 'closed_by');
    }

    public function getFilteredReasonsDisruptionAttribute()
    {
        return  Scheme::getIssueTypes()[$this->reasons_disruption] ?? '';
    }
    public function getFilteredSpecificReasonsAttribute()
    { 
        if (empty($this->specific_reasons)) {
            return '';
        }
        $transformedReasons = [];
        foreach ($this->specific_reasons as $reason) {
            if (array_key_exists($reason, Scheme::getTechnicalIssuesPwss())) {
                $transformedReasons[] = Scheme::getTechnicalIssuesPwss()[$reason];
            } elseif (array_key_exists($reason, Scheme::getAdministrativeIssues())) {
                $transformedReasons[] = Scheme::getAdministrativeIssues()[$reason];
            } elseif (array_key_exists($reason, Scheme::getInstitutionalIssues())) {
                $transformedReasons[] = Scheme::getInstitutionalIssues()[$reason];
            } else {
                $transformedReasons[] = '';
            }
        }
        return implode(", ", $transformedReasons);
    }

    public function getWaterDisruptionStatusAttribute()
    { 
        if ($this->status == 'closed') {
            return 'Resolved';
        } else if ($this->status == 'resolved') {
            return 'Resolution approval pending';
        } else if ($this->status == 'approved') {
            return 'Waiting for resolution';
        } else if  ($this->status == 'pending') {
            return 'Pending at SDO for Approval';
        }
        return '--';
    }
}
