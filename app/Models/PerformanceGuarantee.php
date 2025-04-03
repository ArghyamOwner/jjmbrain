<?php

namespace App\Models;

use App\Enums\PerformanceGuaranteeType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PerformanceGuarantee extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'workorder_id',
        'circle_id',
        'user_id',
        'pledged_infavour_of',
        'pg_type',
        'pg_number',
        'pg_amount',
        'pg_date',
        'expired_date',
        'bank_name',
        'bank_branch',
        'pg_copy',

        'withdrawn_at',
        'withdraw_certificate',
        'receiver_details',
        'remarks',
        'contractor_id',
        'contractor_name',
        'account_no'
    ];

    protected $casts = [
        'pg_type' => PerformanceGuaranteeType::class,
        'expired_date' => 'date',
        'withdrawn_at' => 'date',
        'pg_date' => 'date',
    ];

    protected $appends = [
        'expired_status',
        'withdraw_status',
    ];

    public function getPgPhotoUrlAttribute()
    {
        return $this->pg_copy
        ? Storage::disk('uploads')->url($this->pg_copy)
        : null;
    }

    public function getExpiredStatusAttribute($value)
    {
        $expiredDate = Carbon::parse($this->expired_date);

        return $expiredDate->isFuture() ? 'not-expired' : 'expired';
    }

    public function scopeFilterByExpiringWithin($query, $expiring_within)
    {
        // $day = Carbon::now()->addDays($expiring_within);
        // $query->whereDate('expired_date', '>', $day);
        $query->whereBetween('expired_date', [now(), now()->addDays($expiring_within)]);
    }

    public function getWithdrawStatusAttribute()
    {
        return !is_null($this->withdrawn_at) ? true : false;
    }

    public function workorder()
    {
        return $this->belongsTo(Workorder::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function contractor()
    {
        return $this->belongsTo(User::class, 'contractor_id');
    }

    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }

    public function workorders()
    {
        return $this->belongsToMany(Workorder::class);
    }

}
