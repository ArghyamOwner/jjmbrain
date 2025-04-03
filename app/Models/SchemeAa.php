<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SchemeAa extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'scheme_id',
        'aa_number',
        'aa_date',
        'aa_document',
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function getAaDocumentUrlAttribute()
    {
        return $this->photo ? Storage::disk('uploads')->url($this->aa_document) : null;
    }
}
