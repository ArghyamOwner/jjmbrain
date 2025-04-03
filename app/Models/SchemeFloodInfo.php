<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemeFloodInfo extends Model
{
    use HasFactory;
    use HasUlids;

    const Inundated_Option_Barge_House = 'barge_house';
    const Inundated_Option_Transformer_Platform_Barge_Partially = 'transformer_platform_barge_partially';
    const Inundated_Option_Transformer_Platform_Barge_Fully = 'transformer_platform_barge_fully';
    const Inundated_Option_Internal_Pathway = 'internal_Pathway';
    const Inundated_Option_Boundary_Wall = 'boundary_wall';
    const Inundated_Option_ESR_Staging_Above_Base_Plate = 'esr_staging_above_base_plate';
    const Inundated_Option_Aerator = 'aerator';
    const Inundated_Option_Flash_Mixture = 'flash_mixture';
    const Inundated_Option_Sedimentation_Tank = 'sedimentation_tank';
    const Inundated_Option_Clarifloculator = 'clarifloculator';
    const Inundated_Option_Staff_Quarters = 'staff_quarters';
    const Inundated_Option_Transformer_Platform_TP_Partially = 'transformer_platform_tp_partially';
    const Inundated_Option_Transformer_Platform_TP_Fully = 'transformer_platform_tp_fully';
    const Inundated_Option_UGR_Partially = 'ugr_partially';
    const Inundated_Option_UGR_Fully = 'urg_fully';
    const Inundated_Option_Filter_Unit_Partially_Below_Backwash_Valve = 'filter_unit_partially_below_backwash_valve';
    const Inundated_Option_Filter_Unit_Full_Above_Backwash_Valve = 'filter_unit_full_above_backwash_valve';
    const Inundated_Option_Sluice_Valves_ESR_Distribution = 'sluice_valves_esr_distribution';
    const Inundated_Option_FHTC_Distribution_Pipelines_Fully = 'fhtc_distribution_pipelines_fully';
    const Inundated_Option_Toilet_Pit = 'toilet_pit';
    const Inundated_Option_DTW_Sanitary_Sealing  = 'dtw_sanitary_sealing';
    const Inundated_Option_DTW_Area_Inundated  = 'dtw_area_inundated';
    const Inundated_Option_Transformer_Platform_Partially  = 'transformer_platform_partially';
    const Inundated_Option_Transformer_Platform_Fully  = 'transformer_platform_fully';

    public static function getInundatedInfrastructureOptions()
    {
        return [
            self::Inundated_Option_Barge_House => "Barge House",
            self::Inundated_Option_Transformer_Platform_Barge_Partially => "Transformer Platform at Barge (Partially)",
            self::Inundated_Option_Transformer_Platform_Barge_Fully => "Transformer Platform at Barge (Fully)",
            self::Inundated_Option_Internal_Pathway => "Internal Pathway",
            self::Inundated_Option_Boundary_Wall => "Boundary Wall",
            self::Inundated_Option_ESR_Staging_Above_Base_Plate => "ESR Staging (Above Base Plate)",
            self::Inundated_Option_Aerator => "Aerator",
            self::Inundated_Option_Flash_Mixture => "Flash Mixture",
            self::Inundated_Option_Sedimentation_Tank => "Sedimentation Tank",
            self::Inundated_Option_Clarifloculator => "Clarifloculator",
            self::Inundated_Option_Staff_Quarters => "Staff Quarters",
            self::Inundated_Option_Transformer_Platform_TP_Partially => "Transformer Platform at TP (Partially)",
            self::Inundated_Option_Transformer_Platform_TP_Fully => "Transformer Platform at TP(Fully)",
            self::Inundated_Option_UGR_Partially => "UGR (Partially)",
            self::Inundated_Option_UGR_Fully => "UGR (Fully)",
            self::Inundated_Option_Filter_Unit_Partially_Below_Backwash_Valve => "Filter Unit (partially) – Below backwash valve",
            self::Inundated_Option_Filter_Unit_Full_Above_Backwash_Valve => "Filter Unit (Full) – Above backwash valve",
            self::Inundated_Option_Sluice_Valves_ESR_Distribution => "Sluice valves (ESR to Distribution)",
            self::Inundated_Option_FHTC_Distribution_Pipelines_Fully => "FHTC & Distribution Pipelines (Fully)",
            self::Inundated_Option_Toilet_Pit => "Toilet Pit",
            self::Inundated_Option_DTW_Sanitary_Sealing => "DTW Sanitary Sealing",
            self::Inundated_Option_DTW_Area_Inundated => "DTW Area Inundated",
            self::Inundated_Option_Transformer_Platform_Partially => "Transformer Platform (Partially)",
            self::Inundated_Option_Transformer_Platform_Fully => "Transformer Platform (Fully)",
        ];
    }

    const PRIORITY_HIGH = 'high';
    const PRIORITY_MEDIUM = 'medium';
    const PRIORITY_LOW = 'low';
    public static function getSeverityOptions()
    {
        return [
            self::PRIORITY_HIGH => "High",
            self::PRIORITY_MEDIUM => "Medium",
            self::PRIORITY_LOW => "Low",
        ];
    }

    const Barge = 'barge';
    const Hose_Pipe = 'hose_pipe';
    const Barge_Approach = 'barge_Approach';

    public static function getPartialDamageOptions()
    {
        return [
            self::Barge => "Barge",
            self::Hose_Pipe => "Hose Pipe",
            self::Barge_Approach => "Barge Approach",
        ];
    }

    public static function filterInundatedInfrastructureOptions(array $keys)
    {
        $allOptions = SchemeFloodInfo::getInundatedInfrastructureOptions();
        $filteredOptions = [];
        foreach ($keys as $key) {
            if (isset($allOptions[$key])) {
                $filteredOptions[] = $allOptions[$key];
            }
        }
        return implode(', ', $filteredOptions);
    }
    public static function filterPartialDamageOptions(array $keys)
    {
        $allOptions = SchemeFloodInfo::getPartialDamageOptions();
        $filteredOptions = [];
        foreach ($keys as $key) {
            if (isset($allOptions[$key])) {
                $filteredOptions[] = $allOptions[$key];
            }
        }
        return implode(', ', $filteredOptions);
    }

    protected $fillable = [
        'id',
        'user_id',
        'scheme_id',
        'start_date',
        'water_stagnation_period',
        'inundated_infrastructure',
        'severity',
        'partial_damage',
        'approx_inundation_height'
    ];

    // protected $casts = [
    //     'start_date' => 'date'
    // ];
}
