<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class MeetingMinute extends Model
{
    use HasFactory, HasUlids;

    const VERTICAL_IEC = 'iec';
    const VERTICAL_IMIS = 'imis';
    const VERTICAL_ISA = 'isa';
    const VERTICAL_FINANCE = 'finance';
    const VERTICAL_DPR_TECHNICAL = 'dpr_technical';
    const VERTICAL_WATER_QUALITY = 'water_quality';
    const VERTICAL_IT = 'it';
    const VERTICAL_PROCUREMENT = 'procurement';
    const VERTICAL_TRAINING_CAPACITY_BUILDING = 'training_capacity_building';
    const VERTICAL_QUALITY_CONTROL_INSPECTION = 'quality_control_inspection';
    const VERTICAL_JAL_DOOT = 'jal_doot';
    const VERTICAL_NHM_PARTNERSHIP = 'nhm_partnership';

    public static function getVerticalOptions()
    {
        return [
            self::VERTICAL_IEC => 'IEC',
            self::VERTICAL_IMIS => 'IMIS',
            self::VERTICAL_ISA => 'ISA',
            self::VERTICAL_FINANCE => 'FINANCE',
            self::VERTICAL_DPR_TECHNICAL => 'DPR / TECHNICAL',
            self::VERTICAL_WATER_QUALITY => 'WATER QUALITY',
            self::VERTICAL_IT => 'IT',
            self::VERTICAL_PROCUREMENT => 'PROCUREMENT',
            self::VERTICAL_TRAINING_CAPACITY_BUILDING => 'TRAINING & CAPACITY BUILDING',
            self::VERTICAL_QUALITY_CONTROL_INSPECTION => 'QUALITY CONTROL & INSPECTION',
            self::VERTICAL_JAL_DOOT => 'JAL DOOT',
            self::VERTICAL_NHM_PARTNERSHIP => 'NHM PARTNERSHIP',
        ];
    }

    public function getVerticalNameAttribute()
    {
        $list = self::getVerticalOptions();
        return isset($list[$this->vertical]) ? $list[$this->vertical] : 'Not Defined';
    }

    protected $fillable = [
        'meeting_name',
        'meeting_date',
        'description',
        'user_id',
        'user_group',
        'link',
        'venue',
        'pdf',
        'minutes',
        'created_by',
        'meeting_id',
        'minute_date',
        'type',
        'vertical',
    ];

    protected $casts = [
        'meeting_date' => 'datetime',
        'minute_date' => 'date',
    ];

    public function getMinuteUrlAttribute()
    {
        return $this->minutes ? Storage::disk('uploads')->url($this->minutes) : null;
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
