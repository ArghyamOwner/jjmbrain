<?php

namespace App\Http\Livewire\Assets;

use App\Enums\AssetCategory;
use App\Enums\AssetType;
use App\Models\Asset;
use App\Models\Circle;
use App\Models\FinancialYear;
use App\Models\Office;
use App\Traits\InteractsWithBanner;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $circle;
    public $financial_year;
    public $asset_uin;
    public $asset_type;
    public $asset_category;
    public $item_name;
    public $image;
    public $specification;
    public $manufacturer;
    public $serial_number;
    public $installed_by;
    public $commissioned_date;
    public $warranty_period;
    public $warranty_valid_upto;
    public $service_provided_by;
    public $service_cycle;
    public $remarks;
    public $newOffice;
    public $allocated_on;
    public $allocated_to;

    public $capacity;
    public $size;
    public $certification;

    public function save()
    {
        $validated = $this->validate([
            'circle' => ['required', Rule::exists('circles', 'id')],
            'financial_year' => ['required', Rule::exists('financial_years', 'id')],
            // 'asset_uin' => ['required'],
            // 'asset_type' => ['required', new Enum(AssetType::class)],
            'asset_category' => ['required', new Enum(AssetCategory::class)],
            'item_name' => ['required'],
            'image' => ['nullable', 'image', 'max:4024'],
            'serial_number' => ['nullable'],
            'newOffice' => ['required'],

            'specification' => ['nullable'],
            'manufacturer' => ['nullable'],
            'installed_by' => ['nullable'],
            'commissioned_date' => ['nullable'],
            'warranty_period' => ['nullable'],
            'warranty_valid_upto' => ['nullable'],
            'service_provided_by' => ['nullable'],
            'service_cycle' => ['nullable'],
            'remarks' => ['nullable'],
            'allocated_on' => ['nullable'],
            'allocated_to' => ['nullable'],
            
            'capacity' => ['nullable'],
            'size' => ['nullable'],
            'certification' => ['nullable'],

        ]);

        $asset = Asset::create([
            'circle_id' => $validated['circle'],
            'financial_year_id' => $validated['financial_year'],
            'asset_type' => AssetType::MOVABLE,
            'asset_category' => $validated['asset_category'],
            'item_name' => $validated['item_name'],
            'serial_number' => $validated['serial_number'],
            'office_id' => $validated['newOffice'],

            'specification' => $validated['specification'],
            'manufacturer' => $validated['manufacturer'],
            'installed_by' => $validated['installed_by'],
            'commissioned_date' => $validated['commissioned_date'],
            'warranty_period' => $validated['warranty_period'],
            'warranty_valid_upto' => $validated['warranty_valid_upto'],
            'service_provided_by' => $validated['service_provided_by'],
            'service_cycle' => $validated['service_cycle'],
            'remarks' => $validated['remarks'],
            'allocated_on' => $validated['allocated_on'],
            'allocated_to' => $validated['allocated_to'],
            'capacity' => $validated['capacity'],
            'size' => $validated['size'],
            'certification' => $validated['certification'],
        ]);

        if ($this->image) {
            $asset->update([
                'image' => $this->image->storePublicly('/', 'uploads'),
            ]);
        }

        $this->reset();

        $this->banner('Asset saved successfully.');

        return redirect()->route('assets');
    }

    public function getOfficesProperty()
    {
        return Circle::pluck('name', 'id');
    }

    public function getNewOfficesProperty()
    {
        return Office::pluck('name', 'id');
    }

    public function getFinancialYearsProperty()
    {
        return FinancialYear::all();
    }

    public function getAssetTypesProperty()
    {
        return AssetType::cases();
    }

    public function getAssetCategoriesProperty()
    {
        return Asset::getMovableCategoryOptions();
    }

    public function render()
    {
        return view('livewire.assets.create');
    }
}
