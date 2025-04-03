<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CanalTrackingPoint extends Model
{
    use HasFactory, HasUlids;

    const CATEGORY_VALVE = 'Valve';
    const CATEGORY_ROAD_CROSSING = 'Road_Crossing';
    const CATEGORY_RAILWAY_CROSSING = 'Railway_Crossing';
    const CATEGORY_CULVERTS = 'Culverts';
    const CATEGORY_BRIDGES = 'Bridges';

    const TYPE_AIR_VALVES = 'Air_Valves';
    const TYPE_SLUICE_VALVES = 'Sluice_Valves';
    const TYPE_REDUCING_VALVES = 'Reducing_Valves';
    const TYPE_NON_RETURN_VALVES = 'Non_Return_Valves';
    const TYPE_SCOUR_VALVES = 'Scour_Valves';
    const TYPE_STATE_ROAD = 'State_Road';
    const TYPE_VILLAGE_ROAD = 'Village_Road';
    const TYPE_NATIONAL_HIGHWAY = 'National_Highway';
    const TYPE_INDIAN_RAILWAY = 'Indian_Railway';
    const TYPE_OVER_CULVERT_DECK = 'Over_Culvert_Deck';
    const TYPE_SIDE_OF_CULVERT_DECK = 'Side_of_Culvert_Deck';
    const TYPE_OVER_RIVER = 'Over_River';
    const TYPE_OVER_DRAIN = 'Over_Drain';
    const TYPE_OVER_BRIDGE_DECK = 'Over_Bridge_Deck';
    const TYPE_ATTACHED_TO_SIDE_OF_DECK = 'Attached_to_Side_of_Deck';
    const TYPE_DEDICATED_SUPPORT_PHE = 'Dedicated_support_PHE';
    const TYPE_NO_SUPPORT = 'No_Support';

    const CASING_GI = 'GI';
    const CASING_DI = 'DI';
    const CASING_MS = 'MS';
    const CASING_HDPE = 'HDPE';
    const CASING_NO_CASING = 'No_Casing';

    public static function getCategoryOptions()
    {
        return [
            self::CATEGORY_VALVE => "Valve",
            self::CATEGORY_ROAD_CROSSING => "Road Crossing",
            self::CATEGORY_RAILWAY_CROSSING => "Railway Crossing",
            self::CATEGORY_CULVERTS => "Culverts",
            self::CATEGORY_BRIDGES => "Bridges",
        ];
    }

    public static function getTypeOptions()
    {
        return [
            self::TYPE_AIR_VALVES => 'Air Valves',
            self::TYPE_SLUICE_VALVES => 'Sluice Valves',
            self::TYPE_REDUCING_VALVES => 'Reducing Valves',
            self::TYPE_NON_RETURN_VALVES => 'Non-Return Valves',
            self::TYPE_SCOUR_VALVES => 'Scour Valves',
            self::TYPE_STATE_ROAD => 'State Road',
            self::TYPE_VILLAGE_ROAD => 'Village Road',
            self::TYPE_NATIONAL_HIGHWAY => 'National Highway',
            self::TYPE_INDIAN_RAILWAY => 'Indian Railway',
            self::TYPE_OVER_CULVERT_DECK => 'Over Culvert Deck',
            self::TYPE_SIDE_OF_CULVERT_DECK => 'Side of Culvert Deck',
            self::TYPE_OVER_RIVER => 'Over River',
            self::TYPE_OVER_DRAIN => 'Over Drain',
            self::TYPE_OVER_BRIDGE_DECK => 'Over Bridge Deck',
            self::TYPE_ATTACHED_TO_SIDE_OF_DECK => 'Attached to Side of Deck',
            self::TYPE_DEDICATED_SUPPORT_PHE => 'Dedicated Support (PHE)',
            self::TYPE_NO_SUPPORT => 'No Support',
        ];
    }

    public static function getValveTypeOptions()
    {
        return [
            self::TYPE_AIR_VALVES => 'Air Valves',
            self::TYPE_SLUICE_VALVES => 'Sluice Valves',
            self::TYPE_REDUCING_VALVES => 'Reducing Valves',
            self::TYPE_NON_RETURN_VALVES => 'Non-Return Valves',
            self::TYPE_SCOUR_VALVES => 'Scour Valves',
        ];
    }

    public static function getRoadCrossingTypeOptions()
    {
        return [
            self::TYPE_STATE_ROAD => 'State Road',
            self::TYPE_VILLAGE_ROAD => 'Village Road',
            self::TYPE_NATIONAL_HIGHWAY => 'National Highway',
        ];
    }

    public static function getRailwayCrossingTypeOptions()
    {
        return [
            self::TYPE_INDIAN_RAILWAY => 'Indian Railway',
        ];
    }

    public static function getCulvertTypeOptions()
    {
        return [
            self::TYPE_OVER_CULVERT_DECK => 'Over Culvert Deck',
            self::TYPE_SIDE_OF_CULVERT_DECK => 'Side of Culvert Deck',
            self::TYPE_OVER_RIVER => 'Over River',
            self::TYPE_OVER_DRAIN => 'Over Drain',
        ];
    }

    public static function getBridgeTypeOptions()
    {
        return [
            self::TYPE_OVER_BRIDGE_DECK => 'Over Bridge Deck',
            self::TYPE_ATTACHED_TO_SIDE_OF_DECK => 'Attached to Side of Deck',
            self::TYPE_DEDICATED_SUPPORT_PHE => 'Dedicated Support (PHE)',
            self::TYPE_NO_SUPPORT => 'No Support',
        ];
    }

    public static function getCasingTypeOptions()
    {
        return [
            self::CASING_GI => 'GI',
            self::CASING_DI => 'DI',
            self::CASING_MS => 'MS',
            self::CASING_HDPE => 'HDPE',
            self::CASING_NO_CASING => 'No Casing',
        ];
    }

    protected $fillable = [
        'scheme_id',
        'type',
        'category',
        'casing_type',
        'size',
        'valve_manufacturer',
        'image',
        'latitude',
        'longitude',
        'created_by',
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::disk('canaltracking')->url($this->image) : null;
    }
}
