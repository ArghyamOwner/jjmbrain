<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grievance extends Model
{
    use HasFactory;
    use HasUlids;

    const TYPE_INBOUND = 'inbound';
    const TYPE_OUTBOUND = 'outbound';

    const PLATFORM_CALL = 'call';
    const PLATFORM_WHATSAPP = 'whatsapp';
    const PLATFORM_FACEBOOK = 'facebook';
    const PLATFORM_APP = 'app';
    const PLATFORM_WEB = 'web';
    const PLATFORM_QR = 'QR';
    const PLATFORM_OTHER = 'other';

    const RAISEDBY_CALL_CENTRE = 'call-centre';
    const RAISEDBY_CITIZEN = 'citizen';
    const RAISEDBY_BENEFICIARY = 'beneficiary';

    const PRIORITY_HIGH = 'high';
    const PRIORITY_MEDIUM = 'medium';
    const PRIORITY_LOW = 'low';

    const STATUS_PENDING = 'pending';
    const STATUS_RESOLVED = 'resolved';
    const STATUS_UNRESOLVED = 'unresolved';

    public static function getTypeOptions()
    {
        return [
            self::TYPE_INBOUND => "Inbound",
            self::TYPE_OUTBOUND => "Outbound",
        ];
    }

    public static function getPlatformOptions()
    {
        return [
            self::PLATFORM_CALL => "Call",
            self::PLATFORM_WHATSAPP => "Whatsapp",
            self::PLATFORM_FACEBOOK => "Facebook",
            self::PLATFORM_APP => "App",
            self::PLATFORM_WEB => "Web",
            self::PLATFORM_QR => "QR",
            self::PLATFORM_OTHER => "Other",
        ];
    }

    public static function geRaiseByOptions()
    {
        return [
            self::RAISEDBY_CALL_CENTRE => "Call-Center",
            self::RAISEDBY_BENEFICIARY => "Beneficiary",
            self::RAISEDBY_CITIZEN => "Citizen",
        ];
    }

    public static function gePriorityOptions()
    {
        return [
            self::PRIORITY_HIGH => "High",
            self::PRIORITY_MEDIUM => "Medium",
            self::PRIORITY_LOW => "Low",
        ];
    }

    public static function getStatusOptions()
    {
        return [
            self::STATUS_PENDING => "Pending",
            self::STATUS_RESOLVED => "Resolved",
            self::STATUS_UNRESOLVED => "Un-Resolved",
        ];
    }

    protected $fillable = [
        'division_id',
        'scheme_type',
        'scheme_id',
        'beneficiary_id',
        'citizen_name',
        'citizen_phone',
        'issue_type',
        'issue_id',
        'priority',
        'description',
        'reference_no',
        'status',
        'type',
        'platform',
        'raised_by_category',
        'escalation_matrix',
        'created_by',
        'remarks',
        'closed_by',
        'block_id',
        'panchayat_id',
        'village_id',
        'attachment',
        'district_id',
        'category_id',
        'sub_category_id',
        'wid',
        'closed_at',
    ];

    protected $casts = [
        'escalation_matrix' => 'array',
        'closed_at' => 'datetime',
    ];

    protected $appends = [
        'priority_color',
        'platform_color',
        'status_color',
        'pendency',
        // 'attachment_url',
    ];

    public function grievancable()
    {
        return $this->morphTo();
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }

    public function issue()
    {
        return $this->belongsTo(Issue::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getPriorityColorAttribute()
    {
        return [
            self::PRIORITY_HIGH => 'danger',
            self::PRIORITY_MEDIUM => 'warning',
            self::PRIORITY_LOW => 'info',
        ][$this->priority ?? self::PRIORITY_LOW];
    }

    public function getPlatformColorAttribute()
    {
        return [
            self::PLATFORM_CALL => 'danger',
            self::PLATFORM_QR => 'warning',
            self::PLATFORM_WEB => 'info',
            self::PLATFORM_WHATSAPP => 'success',
        ][$this->platform ?? self::PLATFORM_WEB];
    }

    public function getPendencyAttribute()
    {
        $sla = $this->issue?->sla;
        if ($sla) {
            if (now()->gt($this->created_at->addDays($sla))) {
                $otherDate = $this->closed_at ? $this->closed_at : now();
                return $this->created_at->addDays($sla)->diff($otherDate)->days;
            }
        }
        return '-';
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function assignGrievanceTasks()
    {
        return $this->hasMany(AssignGrievanceTask::class);
    }

    public function latestAssignedTask()
    {
        return $this->hasOne(AssignGrievanceTask::class)->latestOfMany();
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

    public function hasSchemeWorkStatus()
    {
        return $this->scheme()->whereNotNull('work_status')->exists();
    }

    // public function getAttachmentUrlAttribute()
    // {
    //     return $this->attachment ? Storage::disk('uploads')->url($this->attachment) : null;
    // }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function images()
    {
        return $this->hasMany(GrievanceImage::class);
    }

    public function getStatusColorAttribute()
    {
        return [
            self::STATUS_PENDING => 'info',
            self::STATUS_RESOLVED => 'success',
            self::STATUS_UNRESOLVED => 'danger',
        ][$this->status ?? self::STATUS_PENDING];
    }
}
