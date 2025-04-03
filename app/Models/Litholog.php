<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Litholog extends Model
{
    const SHOW_DIAGRAM = 1;

    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'scheme_id',
        'well_id',
        'starting_date',
        'completion_date',
        'drilling_type',
        'driller_name',
        'driller_phone',
        'drill_vehicle_number',
        'hole_diameter',
        'casing_size',
        'compressor_capacity',
        'compressor_capacity_unit',
        'latitude',
        'longitude',
        'compressor_pressure',
        'static_water',
        'duration_pump',
        'discharge',
        'drawdown',
        'status',
        'advisory',
        'checked_by',
        'comment',
        'show_diagram',
        'verification_status',
        'verified_by',
        'advised_by',
        'elevation'
    ];

    protected static function booted()
    {
        self::created(function ($model) {
            $model->scheme->schemeActivity()->create([
                'user_id' => auth()->id(),
                'scheme_id' => $model->scheme_id,
                'activity_type' => 'litholog_updated',
                'content' => 'Scheme Litholog',
            ]);
        });

        self::deleted(function ($model) {
            $model->scheme->schemeActivity()->create([
                'user_id' => auth()->id(),
                'scheme_id' => $model->scheme_id,
                'activity_type' => 'litholog_deleted',
                'content' => 'Well-Id : '.$model->well_id ,
            ]);
        });
    }

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function checkedBy()
    {
        return $this->belongsTo(User::class, 'checked_by');
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function advisedBy()
    {
        return $this->belongsTo(User::class, 'advised_by');
    }

    protected $casts = [
        'starting_date' => 'date',
        'completion_date' => 'date',
    ];

    public function lithologies()
    {
        return $this->hasMany(Lithology::class);
    }

    public function casingDiagrams()
    {
        return $this->hasMany(CasingDiagram::class);
    }

    public function waterLevels()
    {
        return $this->hasMany(WaterLevel::class);
    }

    // public function getAdvisoryDetailAttribute()
    // {
    //     $mediumToCoarseSand = Pattern::where('number', 33021)->first();
    //     $coarseSand = Pattern::where('number', 30023)->first();

    //     $maxMediumToCoarseSand = Lithology::query()
    //         ->where('pattern_id', $mediumToCoarseSand->id)
    //         ->where('litholog_id', $this->id)
    //         ->max();
    //     $maxCoarseSand = Lithology::query()
    //         ->where('pattern_id', $coarseSand->id)
    //         ->where('litholog_id', $this->id)
    //         ->max();

    //     if (($maxMediumToCoarseSand > 50) || ($maxCoarseSand > 50)) {
    //         if ($maxMediumToCoarseSand > $maxCoarseSand) {
    //             $aquifer = $maxMediumToCoarseSand;
    //         } else {
    //             $aquifer = $maxCoarseSand;
    //         }

    //     }
    // }
}
