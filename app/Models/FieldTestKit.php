<?php

namespace App\Models;

use App\Enums\FieldTestKitBrand;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FieldTestKit extends Model
{
    use HasFactory;
    use HasUlids;
    
    protected $fillable = [
        'user_id',
        'division_id',
        'district_id',
        'block_id',
        'panchayat_id',
        'village_id',
        'assigned_person_name',
        'assigned_person_phone',
        'brand_name',
        'issue_date',
        'bank_id',
        'account_no',
        'ifsc_no',
        'whatsapp_no'
    ];

    protected $catsts = [
        'brand_name' => FieldTestKitBrand::class
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function panchayat()
    {
        return $this->belongsTo(Panchayat::class);
    }

    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }
    
}
