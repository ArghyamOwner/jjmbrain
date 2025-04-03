<?php

namespace App\Models;

use App\Enums\AssetCategory;
use App\Enums\AssetType;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Asset extends Model
{
    use HasFactory;
    use HasUlids;

    const TYPE_MOVABLE = "movable";
    const TYPE_IMMOVABLE = "immovable";

    const CATEGORY_MOTOR = "motor";
    const CATEGORY_PUMP = "pump";
    const CATEGORY_OHR = "ohr";
    const CATEGORY_UGR = "ugr";
    const CATEGORY_ESR = "esr";
    const CATEGORY_DTW = "dtw";
    const CATEGORY_TRANSFORMER = "transformer";
    const CATEGORY_CHLORINE_PUMP = "chlorine_pump";
    const CATEGORY_CONTROL_PANEL = "control_panel";
    const CATEGORY_BARGE = "barge";
    const CATEGORY_COMPUTER = "computer";
    const CATEGORY_PRINTER = "printer";
    const CATEGORY_FURNITURE = "furniture";
    const CATEGORY_BOUNDARY_WALL = "boundary_wall";
    const CATEGORY_GATE = "gate";

    const SUB_CAT_SUBMERSIBLE = 'Submersible';
    const SUB_CAT_CENTRIFUGAL = 'Centrifugal';
    const SUB_CAT_OPENWELL = 'Openwell';
    const SUB_CAT_RCC_UGR = 'RCC_UGR';
    const SUB_CAT_SINGLE_PHASE = 'Single_Phase';
    const SUB_CAT_THREE_PHASE = 'Three_Phase';
    const SUB_CAT_INLINE = 'Inline';
    const SUB_CAT_TANK = 'Tank';
    const SUB_CAT_RCC_RCC = 'RCC_RCC';
    const SUB_CAT_RCC_GRP = 'RCC_GRP';
    const SUB_CAT_RCC_ZINC_COLUMN = 'RCC_Zinc_Column';
    const SUB_CAT_MILD_STEEL_GRP = 'Mild-Steel_GRP';
    const SUB_CAT_MILD_STEEL_ZINC_COLUMN = 'Mild_Steel-Zinc_Column';
    const SUB_CAT_ABS_PONTOON = 'ABS_Pontoon';
    const SUB_CAT_MS_STEEL_BARGE = 'MS_Steel_Barge ';
    const SUB_CAT_BRAND = 'Brand';
    const SUB_CAT_CUSTOMIZED = 'Customized';
    const SUB_CAT_BRICK = 'Brick';
    const SUB_CAT_HALF_FENCED = 'Half-Fenced';
    const SUB_CAT_IRON_FENCED = 'Iron Fenced';
    const SUB_CAT_BAMBOO_FENCING = 'Bamboo_Fencing';
    const SUB_CAT_WOODEN_FENCING = 'Wooden_Fencing';
    const SUB_CAT_TWO_DOOR = 'Two_Door';
    const SUB_CAT_SINGLE_DOOR = 'Single_Door';
    const SUB_CAT_SLIDING = 'Sliding';

    public static function getMovableCategoryOptions()
    {
        return [
            // self::CATEGORY_COMPUTER => "Computer",
            // self::CATEGORY_PRINTER => "Printer",
            // self::CATEGORY_FURNITURE => "Furniture",
        ];
    }

    public static function getApiMovableCategoryOptions()
    {
        return [
            // [
            //     'key' => self::CATEGORY_COMPUTER,
            //     'value' => "Computer",
            // ],
            // [
            //     'key' => self::CATEGORY_PRINTER,
            //     'value' => "Printer",
            // ],
            // [
            //     'key' => self::CATEGORY_FURNITURE,
            //     'value' => "Furniture",
            // ],
        ];
    }

    public static function getPumpSubCatOptions()
    {
        return [
            self::SUB_CAT_SUBMERSIBLE => 'Submersible',
            self::SUB_CAT_CENTRIFUGAL => 'Centrifugal',
            self::SUB_CAT_OPENWELL => 'Openwell',
        ];
    }

    public static function getUgrSubCatOptions()
    {
        return [
            self::SUB_CAT_RCC_UGR => 'RCC UGR',
        ];
    }

    public static function getTransformerSubCatOptions()
    {
        return [
            self::SUB_CAT_SINGLE_PHASE => 'Single Phase',
            self::SUB_CAT_THREE_PHASE => 'Three Phase',
        ];
    }

    public static function getChlorinePumpSubCatOptions()
    {
        return [
            self::SUB_CAT_INLINE => 'Inline',
            self::SUB_CAT_TANK => 'Tank',
        ];
    }

    public static function getEsrSubCatOptions()
    {
        return [
            self::SUB_CAT_RCC_RCC => 'RCC + RCC',
            self::SUB_CAT_RCC_GRP => 'RCC + GRP',
            self::SUB_CAT_RCC_ZINC_COLUMN => 'RCC + Zinc Column',
            self::SUB_CAT_MILD_STEEL_GRP => 'Mild Steel + GRP',
            self::SUB_CAT_MILD_STEEL_ZINC_COLUMN => 'Mild Steel + Zinc Column',
        ];
    }

    public static function getBargeSubCatOptions()
    {
        return [
            self::SUB_CAT_ABS_PONTOON => 'ABS Pontoon',
            self::SUB_CAT_MS_STEEL_BARGE => 'MS Steel Barge',
        ];
    }

    public static function getControlPanelSubCatOptions()
    {
        return [
            self::SUB_CAT_BRAND => 'Brand',
            self::SUB_CAT_CUSTOMIZED => 'Customized',
        ];
    }

    public static function getBoundaryWallSubCatOptions()
    {
        return [
            self::SUB_CAT_BRICK => 'Brick',
            self::SUB_CAT_HALF_FENCED => 'Half-Fenced',
            self::SUB_CAT_IRON_FENCED => 'Iron Fenced',
            self::SUB_CAT_BAMBOO_FENCING => 'Bamboo Fencing',
            self::SUB_CAT_WOODEN_FENCING => 'Wooden Fencing',
        ];
    }

    public static function getGateSubCatOptions()
    {
        return [
            self::SUB_CAT_TWO_DOOR => 'Two Door',
            self::SUB_CAT_SINGLE_DOOR => 'Single Door',
            self::SUB_CAT_SLIDING => 'Sliding',
        ];
    }

    public static function getImmovableCategoryOptions()
    {
        return [
            // self::CATEGORY_MOTOR => "Motor",
            // self::CATEGORY_OHR => "OHR",
            // self::CATEGORY_DTW => "DTW",
            self::CATEGORY_PUMP => "Pump",
            self::CATEGORY_UGR => "UGR",
            self::CATEGORY_TRANSFORMER => "Transformer",
            self::CATEGORY_CHLORINE_PUMP => "Chlorine Pump",
            self::CATEGORY_ESR => "ESR",
            self::CATEGORY_BARGE => "Barge",
            self::CATEGORY_CONTROL_PANEL => "Control Panel",
            self::CATEGORY_BOUNDARY_WALL => "Boundary Wall",
            self::CATEGORY_GATE => "Gate",
        ];
    }
    public static function getApiImmovableCategoryOptions()
    {
        return [
            // [
            //     'key' => self::CATEGORY_MOTOR,
            //     'value' => "Motor",
            // ],
            // [
            //     'key' => self::CATEGORY_OHR,
            //     'value' => "OHR",
            // ],
            // [
            //     'key' => self::CATEGORY_DTW,
            //     'value' => "DTW",
            // ],
            [
                'key' => self::CATEGORY_PUMP,
                'value' => "Pump",
            ],
            [
                'key' => self::CATEGORY_UGR,
                'value' => "UGR",
            ],
            [
                'key' => self::CATEGORY_TRANSFORMER,
                'value' => "Transformer",
            ],
            [
                'key' => self::CATEGORY_CHLORINE_PUMP,
                'value' => "Chlorine Pump",
            ],
            [
                'key' => self::CATEGORY_ESR,
                'value' => "ESR",
            ],
            [
                'key' => self::CATEGORY_BARGE,
                'value' => "Barge",
            ],
            [
                'key' => self::CATEGORY_CONTROL_PANEL,
                'value' => "Control Panel",
            ],
            [
                'key' => self::CATEGORY_BOUNDARY_WALL,
                'value' => "Boundary Wall",
            ],
            [
                'key' => self::CATEGORY_GATE,
                'value' => "Gate",
            ],
        ];
    }

    protected $fillable = [
        'circle_id',
        'scheme_id',
        'financial_year_id',
        'asset_uin',
        'asset_type',
        'asset_category',
        'item_name',
        'image',
        'specification',
        'manufacturer',
        'serial_number',
        'installed_by',
        'commissioned_date',
        'doc_plate_image',
        'warranty_period',
        'warranty_valid_upto',
        'service_provided_by',
        'service_cycle',
        'remarks',
        'office_id',
        'allocated_to',
        'allocated_on',
        'additional_details',
        'capacity',
        'size',
        'certification',
        'certificate_file',
    ];

    protected $casts = [
        'asset_type' => AssetType::class,
        'asset_category' => AssetCategory::class,
        'commissioned_date' => 'date',
        'warranty_valid_upto' => 'date',
        'allocated_on' => 'date',
        'additional_details' => 'json',
        'size' => 'json',
    ];

    protected static function booted()
    {
        self::created(function ($model) {
            $model->update([
                'asset_uin' => 'PHE' . $model->financialYear->year . mt_rand(1111111, 9999999),
            ]);
        });

        self::created(function ($model) {
            if ($model->scheme) {
                $model->scheme->schemeActivity()->create([
                    'user_id' => auth()->id(),
                    'scheme_id' => $model->scheme_id,
                    'activity_type' => 'asset_created',
                    'content' => 'Scheme Asset',
                ]);
            }
        });
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::disk('uploads')->url($this->image) : null;
    }
    
    public function getCertificateFileUrlAttribute()
    {
        return $this->certificate_file ? Storage::disk('asset')->url($this->certificate_file) : null;
    }

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function circle()
    {
        return $this->belongsTo(Circle::class);
    }

    public function financialYear()
    {
        return $this->belongsTo(FinancialYear::class);
    }
}
