<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignGrievanceTask extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'grievance_id',
        'assigned_to',
        'assigned_by',
        'due_date',
        'role',
        'remarks'
    ];

    protected $casts = [
        'due_date' => 'date'
    ];

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function grievance()
    {
        return $this->belongsTo(Grievance::class);
    }
}
