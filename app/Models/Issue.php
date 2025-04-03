<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory, HasUlids;

    const TYPE_SERVICE = 'service';
    const TYPE_DEVELOPMENT = 'development';
    const TYPE_ENQUIRY = 'enquiry';
    const TYPE_OTHER = 'other';

    const ESCALATION = 1;
    const ESCALATION_NO = 0;

    protected $fillable = [
        'issue',
        'type',
        'category_id',
        'sub_category_id',
        'sla',
        'has_escalation',
    ];

    protected $appends = [
        'type_name',
    ];

    public static function getTypeOptions()
    {
        return [
            self::TYPE_SERVICE => "Service",
            self::TYPE_DEVELOPMENT => "Development",
            self::TYPE_ENQUIRY => "Enquiry",
            self::TYPE_OTHER => "Other",
        ];
    }

    public function getTypeNameAttribute()
    {
        $list = self::getTypeOptions();
        return isset($list[$this->type]) ? $list[$this->type] : 'Not Defined';
    }

    public static function getEscalationOptions()
    {
        return [
            self::ESCALATION => "Need Escalation",
            self::ESCALATION_NO => "Does Not Need Escalation",
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

}
