<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueEscalation extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'issue_id',
        'role',
        'level',
        'days'
    ];
}
