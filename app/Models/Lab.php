<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lab extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'circle_id',
        'lab_name',
        'contact_person',
        'phone',
        'image',
        'nabl_certification',
        'latitude',
        'longitude',
        'document',
        'nabl_certification_expiry'
    ];

    protected $casts = [
        'nabl_certification_expiry' => 'date'
    ];

    protected $appends = [
        'lab_image_url',
        'document_url'
    ];

    public function getLabImageUrlAttribute()
    {
        return $this->image ? Storage::disk('uploads')->url($this->image) : null;
    }

    public function transfers()
    {
        return $this->hasMany(Transfer::class, 'source_lab_id');
    }

    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }

    public function getDocumentUrlAttribute()
    {
        return $this->document ? Storage::disk('uploads')->url($this->document) : null;
    }
}
