<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemeArchiveRequest extends Model
{
    use HasFactory, HasUlids;

    const STATUS_PENDING = 'pending';
    const STATUS_REJECTED = 'rejected';
    const STATUS_APPROVED = 'approved';
    const STATUS_ARCHIVED = 'archived';

    protected $append = [
        'status_name',
    ];

    public static function getStatusOptions()
    {
        return [
            self::STATUS_PENDING => "<span class='text-yellow-700'>Pending</span>",
            self::STATUS_APPROVED => "<span class='text-green-700'>Approved</span>",
            self::STATUS_REJECTED => "<span class='text-red-700'>Rejected</span>",
            self::STATUS_ARCHIVED => "<span class='text-indigo-700'>Archived</span>",
        ];
    }

    public function getStatusNameAttribute()
    {
        $list = self::getStatusOptions();
        return isset($list[$this->status]) ? $list[$this->status] : 'Not Defined';
    }

    protected $fillable = [
        'scheme_id',
        'scheme_name',
        'smt_id',
        'imis_id',
        'division_id',
        'reason',
        'status',
        'comment',
        'created_by',
        'checked_by',
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function checkedBy()
    {
        return $this->belongsTo(User::class, 'checked_by');
    }
}
