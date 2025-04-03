<?php

namespace App\Models;

use App\Enums\ESRStatus;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class EsrComplaint extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'scheme_id',
        'status',
        'tpi_agency_name',
        'tpi_officer_name',
        'tpi_officer_phone',
        'doc_file',
        'created_by',
    ];

    protected $casts = [
        'status' => ESRStatus::class,
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getDocFileUrlAttribute()
    {
        return  $this->doc_file ? Storage::disk('esrComplaint')->url($this->doc_file) : null;
    }

    public function getStatusFormatAttribute()
    {
        return match ($this->status) {
            ESRStatus::FULLY_COMPLIANT => 'Fully Compliant',
            ESRStatus::PARTIALLY_COMPLIANT => 'Partially Compliant',
            ESRStatus::NON_COMPLIANT => 'NON Compliant',
            default => '',
        };
    } 

    const EGIS_INDIA = 'egis_india';
    const INTERTEK = 'intertek';
    const FEEDBACK_INFRA = 'feedback_infra';
    const BUERO_VERITAS = 'buero_veritas';
    const WAPCOS = 'wapcos';
    public static function getTPIAgencyOptions(): array
    {
        return [
            self::EGIS_INDIA => 'Egis India',
            self::INTERTEK => 'Intertek',
            self::FEEDBACK_INFRA => 'Feedback Infra',
            self::BUERO_VERITAS => 'Buero Veritas',
            self::WAPCOS => 'Wapcos',
        ];
    }
    public function getTPIAgencyFormatAttribute()
    {
        return match ($this->tpi_agency_name) {
            self::EGIS_INDIA => 'Egis India',
            self::INTERTEK => 'Intertek',
            self::FEEDBACK_INFRA => 'Feedback Infra',
            self::BUERO_VERITAS => 'Buero Veritas',
            self::WAPCOS => 'Wapcos',
            default => $this->tpi_agency_name ?? '',
        };
    }
}
