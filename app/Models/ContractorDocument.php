<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContractorDocument extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'contractor_detail_id',
        'user_id',
        'document_type',
        'document_name',
        'path',
        'size',
        'extension',
    ];

    protected $casts = [
        // 'document_type' => ContractorDocumentTypes::class
    ];

    protected $appends = [
        'document_url'
    ];

    public function contractorDetail()
    {
        return $this->belongsTo(ContractorDetail::class);
    }

    public function getDocumentUrlAttribute()
    {
        return $this->path ? Storage::disk('uploads')->url($this->path) : null;
    }
}
