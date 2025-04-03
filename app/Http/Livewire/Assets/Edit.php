<?php

namespace App\Http\Livewire\Assets;

use App\Models\Asset;
use App\Models\Circle;
use Livewire\Component;
use App\Enums\AssetType;
use App\Enums\AssetCategory;
use App\Models\FinancialYear;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Traits\InteractsWithBanner;
use Illuminate\Validation\Rules\Enum;

class Edit extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $assetId;
    public $imageUrl;

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

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function mount(Asset $asset)
    {
        $this->assetId = $asset->id;

        $this->circle = $asset->circle_id;
        $this->financial_year = $asset->financial_year_id;
        // $this->asset_uin = $asset->asset_uin;
        $this->asset_type = $asset->asset_type;
        $this->asset_category = $asset->asset_category;
        $this->item_name = $asset->item_name;
        $this->imageUrl = $asset->image_url;
        $this->specification = $asset->specification;
        $this->manufacturer = $asset->manufacturer;
        $this->serial_number = $asset->serial_number;
        $this->installed_by = $asset->installed_by;
        $this->commissioned_date = $asset->commissioned_date;
        $this->warranty_period = $asset->warranty_period;
        $this->warranty_valid_upto = $asset->warranty_valid_upto;
        $this->service_provided_by = $asset->service_provided_by;
        $this->service_cycle = $asset->service_cycle;
        $this->remarks = $asset->remarks;
    }

    public function save()
    {
        $validated = $this->validate([
            'circle' => ['required', Rule::exists('circles', 'id')],
            'financial_year' => ['required', Rule::exists('financial_years', 'id')],
            // 'asset_uin' => ['required'],
            'asset_type' => ['required', new Enum(AssetType::class)],
            'asset_category' => ['required', new Enum(AssetCategory::class)],
            'item_name' => ['required'],
            'serial_number' => ['nullable'],
            'specification' => ['nullable'],
            'manufacturer' => ['nullable'],
            'installed_by' => ['nullable'],
            'commissioned_date' => ['nullable'],
            'warranty_period' => ['nullable'],
            'warranty_valid_upto' => ['nullable'],
            'service_provided_by' => ['nullable'],
            'service_cycle' => ['nullable'],
            'remarks' => ['nullable'],
        ]);
 
        $this->asset->update([
            'circle_id' => $validated['circle'],
            'financial_year_id' => $validated['financial_year'],
            // 'asset_uin' => $validated['asset_uin'],
            'asset_type' => $validated['asset_type'],
            'asset_category' => $validated['asset_category'],
            'item_name' => $validated['item_name'],
            'serial_number' => $validated['serial_number'],

            'specification' => $validated['specification'],
            'manufacturer' => $validated['manufacturer'],
            'installed_by' => $validated['installed_by'],
            'commissioned_date' => $validated['commissioned_date'],
            'warranty_period' => $validated['warranty_period'],
            'warranty_valid_upto' => $validated['warranty_valid_upto'],
            'service_provided_by' => $validated['service_provided_by'],
            'service_cycle' => $validated['service_cycle'],
            'remarks' => $validated['remarks'],
        ]);

        $asset = $this->asset->refresh();
        
        $this->circle = $asset->circle_id;
        $this->financial_year = $asset->financial_year_id;
        $this->asset_uin = $asset->asset_uin;
        $this->asset_type = $asset->asset_type;
        $this->asset_category = $asset->asset_category;
        $this->item_name = $asset->item_name;
        $this->imageUrl = $asset->image_url;
        $this->specification = $asset->specification;
        $this->manufacturer = $asset->manufacturer;
        $this->serial_number = $asset->serial_number;
        $this->installed_by = $asset->installed_by;
        $this->commissioned_date = $asset->commissioned_date;
        $this->warranty_period = $asset->warranty_period;
        $this->warranty_valid_upto = $asset->warranty_valid_upto;
        $this->service_provided_by = $asset->service_provided_by;
        $this->service_cycle = $asset->service_cycle;
        $this->remarks = $asset->remarks;

        $this->emit('refreshData');
        $this->notify('Asset updated successfully.');
    }

    public function updateImage()
    {
        $validated = $this->validate([
            'image' => ['required', 'image', 'max:4024']
        ]);

        $this->asset->update([
            'image' => $this->image->storePublicly('/', 'uploads')
        ]);

        $asset = $this->asset->refresh();

        $this->imageUrl = $asset->image_url;

        $this->dispatchBrowserEvent('destroy-filepond');
        $this->emit('refreshData');
        $this->notify('Asset image updated successfully.');
    }

    public function getAssetProperty()
    {
        return Asset::findOrFail($this->assetId);
    }

    public function getOfficesProperty()
    {
        return Circle::pluck('name', 'id');
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
        return AssetCategory::cases();
    }
    
    public function render()
    {
        return view('livewire.assets.edit');
    }
}
