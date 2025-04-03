<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ActivityDetail extends Model
{
    use HasFactory;
    use HasUlids;

    const PHASE_1 = 'phase_1';
    const PHASE_2 = 'phase_2';
    const PHASE_3 = 'phase_3';

    const CAT_SOCIAL = 'social';
    const CAT_RESOURCE = 'resource';
    const CAT_BOTH = 'both';

    const APPLIED_YES = 'yes';
    const APPLIED_NO = 'no';
    const APPLIED_FOR = 'af';

    public static function getPhaseOptions()
    {
        return [
            self::PHASE_1 => "Planning & Mobilization (Phase-1)",
            self::PHASE_2 => "Implementation (Phase-2)",
            self::PHASE_3 => "Post Implementation (Phase - 3)",
        ];
    }

    public static function getCategoryOptions()
    {
        return [
            self::CAT_SOCIAL => "Social Mapping",
            self::CAT_RESOURCE => "Resource Mapping",
            self::CAT_BOTH => "Both",
        ];
    }

    public static function getAppliedOptions()
    {
        return [
            self::APPLIED_YES => "Yes",
            self::APPLIED_NO => "No",
            self::APPLIED_FOR => "A/F",
        ];
    }

    public function getPhaseNameAttribute()
    {
        $list = self::getPhaseOptions();
        return isset($list[$this->phase]) ? $list[$this->phase] : 'Not Defined';
    }

    public function getCategoryNameAttribute()
    {
        $list = self::getCategoryOptions();
        return isset($list[$this->category]) ? $list[$this->category] : 'Not Defined';
    }

    protected $appends = [
        'phase_name',
        'category_name',
        // 'minutes_url',
        // 'pra_url',
        // 'resolution_url',
        // 'attendance_url',
        // 'photo1_url',
        // 'photo2_url',
        // 'committee_photo_url',
        // 'members_url',
        // 'message_url',
        // 'vap_url',
        // 'letter_url',
        // 'gp_approved_copy_url',
        // 'bank_passbook_url',
    ];

    protected $casts = [
        'date' => 'date',
        'block_approved_date' => 'date',
        'district_approved_date' => 'date',
        'phed_office_approved_date' => 'date',
    ];

    protected $fillable = [
        'phase',
        'activity_id',
        'district_id',
        'block_id',
        'panchayat_id',
        'village_id',
        'scheme_id',
        'venue',
        'topics',
        'date',
        'locations_visited',
        'category',
        'summary',
        'key_points',
        'is_registered',
        'registration_no',
        'is_acc_opened',
        'account_no',
        'is_gp_approved',

        'minutes',
        'pra',
        'resolution',
        'attendance',
        'photo1',
        'photo2',
        'committee_photo',
        'members',
        'message',
        'vap',
        'letter',
        'bank_passbook',
        'gp_approved_copy',

        'block_user_id',
        'block_approved_date',
        'district_user_id',
        'district_approved_date',
        'phed_office_user_id',
        'phed_office_approved_date',
    ];

    public function districtUser()
    {
        return $this->belongsTo(User::class, 'district_user_id');
    }

    public function presidingMembers()
    {
        return $this->hasMany(PresidingMember::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
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

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function isas()
    {
        return $this->belongsToMany(Isa::class);
    }

    public function getMinutesUrlAttribute()
    {
        return $this->minutes ? Storage::disk('activity')->url($this->minutes) : null;
    }

    public function getResolutionUrlAttribute()
    {
        return $this->resolution ? Storage::disk('activity')->url($this->resolution) : null;
    }

    public function getAttendanceUrlAttribute()
    {
        return $this->attendance ? Storage::disk('activity')->url($this->attendance) : null;
    }

    public function getPhoto1UrlAttribute()
    {
        return $this->photo1 ? Storage::disk('activity')->url($this->photo1) : null;
    }

    public function getPhoto2UrlAttribute()
    {
        return $this->photo2 ? Storage::disk('activity')->url($this->photo2) : null;
    }

    public function getCommitteePhotoUrlAttribute()
    {
        return $this->committee_photo ? Storage::disk('activity')->url($this->committee_photo) : null;
    }

    public function getMembersUrlAttribute()
    {
        return $this->members ? Storage::disk('activity')->url($this->members) : null;
    }

    public function getMessageUrlAttribute()
    {
        return $this->message ? Storage::disk('activity')->url($this->message) : null;
    }

    public function getVapUrlAttribute()
    {
        return $this->vap ? Storage::disk('activity')->url($this->vap) : null;
    }

    public function getLetterUrlAttribute()
    {
        return $this->letter ? Storage::disk('activity')->url($this->letter) : null;
    }

    public function getBankPassbookUrlAttribute()
    {
        return $this->bank_passbook ? Storage::disk('activity')->url($this->bank_passbook) : null;
    }

    public function getGpApprovedCopyUrlAttribute()
    {
        return $this->gp_approved_copy ? Storage::disk('activity')->url($this->gp_approved_copy) : null;
    }

    public function getPraUrlAttribute()
    {
        return $this->pra ? Storage::disk('activity')->url($this->pra) : null;
    }
}
