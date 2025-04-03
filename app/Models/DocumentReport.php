<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DocumentReport extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'report_number',
        'category',
        'title',
        'file',
        'division_id',
        'district_id',
        'block_id',
    ]; 

    const CATEGORY_METER_READING_MONTHLY = 'meter_reading_monthly';
    const CATEGORY_METER_READING_WEEKLY = 'meter_reading_weekly';

    public function getFileUrlAttribute()
    {
        return $this->file ? Storage::disk('reports')->url($this->file) : null;
    }
}
