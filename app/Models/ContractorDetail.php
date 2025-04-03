<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractorDetail extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'user_id',
        'entity_name',
        'business_type',
        'contractor_type',
        'approval_file',

        'registerable_type',
        'registerable_id',

        'uin',
        'gst',
        'pan',
        'departmental_registration_no',
        'registration_number',
        'registration_valid_upto',
        'address',
        'bank_name',
        'branch_name',
        'account_number',
        'ifsc_code',

        'zone_id',
        'reg_dept',
        'bid_no',
        'license_no',
        'old_contractor_id',
    ];

    protected $casts = [
        'registration_valid_upto' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contractorDocuments()
    {
        return $this->hasMany(ContractorDocument::class);
    }

    public function schemeActivity()
    {
        return $this->morphOne(SchemeActivity::class, 'feedable');
    }

    public function link()
    {
        return route('contractors.show', $this->id);
    }
}
