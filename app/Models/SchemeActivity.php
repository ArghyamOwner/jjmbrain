<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemeActivity extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'user_id',
        'scheme_id',
        'division_id',
        'activity_type',
        'content',
        'link',
        'feedable_type',
        'feedable_id',
    ];

    public function feedable()
    {
        return $this->morphTo();
    }

    public function creatorName()
    {
        return $this->feedable->creatorName();
    }

    public function url()
    {
        return $this->feedable?->link();
    }

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function wuc()
    {
        return $this->belongsTo(Wuc::class);
    }

    public function contractorDetail()
    {
        return $this->belongsTo(ContractorDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workorder()
    {
        return $this->belongsTo(Workorder::class);
    }
}
