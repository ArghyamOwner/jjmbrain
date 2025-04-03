<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContractorGrievance extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'user_id',
        'workorder_id',
        'type',
        'remarks',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function workorder()
    {
        return $this->belongsTo(Workorder::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->image
            ? Storage::disk('grievances')->url($this->image)
            : 'https://avatars.dicebear.com/api/initials/'. urlencode(trim($this->image)) .'.svg?&width=64&height=64';
    }
}
