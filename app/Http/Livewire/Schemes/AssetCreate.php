<?php

namespace App\Http\Livewire\Schemes;

use App\Enums\AssetCategory;
use App\Enums\AssetType;
use App\Models\Asset;
use App\Models\FinancialYear;
use App\Models\Scheme;
use App\Traits\InteractsWithBanner;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;
use Livewire\WithFileUploads;

class AssetCreate extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    // public $circle;
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
    // public $newOffice;
    public $allocated_on;
    public $allocated_to;

    public $capacity;
    public $length;
    public $breadth;
    public $height;
    public $certification;
    public $certificate_file;
    public $additional_detail_one;
    public $additional_detail_two;

    public $scheme;
    public $schemeId;
    public $assetCategories = [];
    public $itemOptions = [];

    public $showCapacityField = true;
    public $showCertificationField = false;
    public $showSizeField = true;

    public $showAdditionalFieldOne = false;
    public $labelAdditionalOne;
    public $additionalOneOptions;

    public $showAdditionalFieldTwo = false;
    public $labelAdditionalTwo;
    public $additionalTwoOptions;

    public function mount(Scheme $scheme)
    {
        
        $scheme->loadMissing('division');
        $this->scheme = $scheme;
        // $this->circle = $scheme->division->circle_id;
        $this->schemeId = $scheme->id;
    }

    public function save()
    {
        $validated = $this->validate([
            // 'circle' => ['required', Rule::exists('circles', 'id')],
            'financial_year' => ['required', Rule::exists('financial_years', 'id')],
            'asset_type' => ['required', new Enum(AssetType::class)],
            'asset_category' => ['required', new Enum(AssetCategory::class)],
            'item_name' => ['required'],
            // 'newOffice' => ['required'],
            'image' => ['required', 'image', 'max:4024'],
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
            'allocated_on' => ['nullable'],
            'allocated_to' => ['nullable'],
            'capacity' => ['bail', 'nullable', 'required_if:asset_category,pump,ugr,transformer,chlorine_pump,esr', 'numeric'],
            'certification' => ['nullable'], //, 'required_if:asset_category,pump,transformer,chlorine_pump,esr'
            'additional_detail_one' => ['nullable', 'required_if:asset_category,ugr,transformer,chlorine_pump,esr,barge,control_panel,boundary_wall,gate'],
            'additional_detail_two' => ['nullable', 'required_if:asset_category,ugr,chlorine_pump,esr,barge,control_panel'],
            
            'length' => ['bail', 'nullable', 'required_if:asset_category,ugr,esr,barge,control_panel,boundary_wall,gate', 'numeric'],
            'breadth' => ['bail', 'nullable', 'required_if:asset_category,ugr,esr,barge,control_panel,boundary_wall,gate', 'numeric'],
            'height' => ['bail', 'nullable', 'required_if:asset_category,ugr,esr,barge,control_panel,boundary_wall,gate', 'numeric'],
            'certificate_file' => ['nullable', 'mimes:pdf', 'max:4024'],
        ]);
        $addData = [];
        $sizeData = [];
        if ($validated['additional_detail_one']) {
            $addData[] = [
                $this->labelAdditionalOne => $validated['additional_detail_one'],
            ];
        }
        if ($validated['additional_detail_two']) {
            $addData[] = [
                $this->labelAdditionalTwo => $validated['additional_detail_two'],
            ];
        }
        if ($validated['length'] && $validated['breadth'] && $validated['height']) {
            $sizeData = [
                'Length' => $validated['length'],
                'Breadth' => $validated['breadth'],
                'Height' => $validated['height'],
            ];
        }
        $asset = Asset::create([
            'scheme_id' => $this->schemeId,
            'circle_id' => $this->scheme->division->circle_id,
            'financial_year_id' => $validated['financial_year'],
            'asset_type' => $validated['asset_type'],
            'asset_category' => $validated['asset_category'],
            'item_name' => $validated['item_name'],
            'serial_number' => $validated['serial_number'],
            // 'office_id' => $validated['newOffice'],

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
            'size' => sizeof($sizeData) ? $sizeData : null,
            'certification' => $validated['certification'],
            'additional_details' => sizeof($addData) ? $addData : null,
        ], [], [
            'financial_year_id' => 'Year of Installation',
        ]);
        if ($this->image) {
            $asset->update([
                'image' => $this->image->storePublicly('/', 'uploads'),
            ]);
        }
        if ($this->certificate_file) {
            $asset->update([
                'certificate_file' => $this->certificate_file->storePublicly('/', 'asset'),
            ]);
        }
        $this->banner('Asset saved successfully.');
        return redirect()->route('schemes.show', [$this->schemeId, 'tab' => 'assets']);
    }

    public function getFinancialYearsProperty()
    {
        return FinancialYear::all();
    }

    public function getAssetTypesProperty()
    {
        return AssetType::cases();
    }

    public function updatedAssetType()
    {
        if ($this->asset_type == Asset::TYPE_MOVABLE) {
            $this->assetCategories = Asset::getMovableCategoryOptions();
        } else {
            $this->assetCategories = Asset::getImmovableCategoryOptions();
        }
    }

    public function updatedAssetCategory()
    {
        $this->reset('certification', 'additional_detail_one', 'additional_detail_two', 'capacity', 'length', 'breadth', 'height');
        $this->showCertificationField = false;
        $this->showAdditionalFieldOne = false;
        $this->showAdditionalFieldTwo = false;
        $this->showCapacityField = false;
        $this->showSizeField = false;

        $options = [];

        switch ($this->asset_category) {

            case (Asset::CATEGORY_PUMP):
                $this->showCapacityField = true;
                $this->showCertificationField = true;
                $options = Asset::getPumpSubCatOptions();
                break;

            case (Asset::CATEGORY_UGR):
                $this->showCapacityField = true;
                $this->showSizeField = true;
                $options = Asset::getUgrSubCatOptions();

                $this->labelAdditionalOne = 'Is the HFL marker installed ?';
                $this->additionalOneOptions = ['Yes', 'No'];
                $this->showAdditionalFieldOne = true;

                $this->labelAdditionalTwo = 'Is the UGR above 1m of the HFL ?';
                $this->additionalTwoOptions = ['Yes', 'No'];
                $this->showAdditionalFieldTwo = true;
                break;

            case (Asset::CATEGORY_TRANSFORMER):
                $this->showCapacityField = true;
                $this->showCertificationField = true;
                $options = Asset::getTransformerSubCatOptions();

                $this->labelAdditionalOne = 'Where is the transformer is installed ?';
                $this->additionalOneOptions = ['Intake', 'Treatment Plant'];
                $this->showAdditionalFieldOne = true;
                break;

            case (Asset::CATEGORY_CHLORINE_PUMP):
                $this->showCapacityField = true;
                $this->showCertificationField = true;
                $options = Asset::getChlorinePumpSubCatOptions();

                $this->labelAdditionalOne = 'Where is the location of CP installed ?';
                $this->additionalOneOptions = ['Pump House', 'Below ESR', 'UGR Top'];
                $this->showAdditionalFieldOne = true;

                $this->labelAdditionalTwo = 'What certification CP has ?';
                $this->additionalTwoOptions = ['NSF', 'ACS'];
                $this->showAdditionalFieldTwo = true;
                break;

            case (Asset::CATEGORY_ESR):

                $this->showCapacityField = true;
                $this->showSizeField = true;
                $this->showCertificationField = true;
                $options = Asset::getEsrSubCatOptions();

                $this->labelAdditionalOne = 'Select the installations on ESR ?';
                $this->additionalOneOptions = [
                    'Aviation lamp + Lighting arrester + JJM logo',
                    'Lighting arrester + JJM logo',
                    'Aviation lamp + JJM logo',
                    'JJM logo',
                    'Aviation lamp + Lighting arrester',
                    'Lighting arrester',
                    'Aviation lamp',
                ];
                $this->showAdditionalFieldOne = true;

                $this->labelAdditionalTwo = 'Is the ESR has covered inspection (internal) ladder ?';
                $this->additionalTwoOptions = ['Yes', 'No'];
                $this->showAdditionalFieldTwo = true;
                break;

            case (Asset::CATEGORY_BARGE):
                $this->showSizeField = true;
                $options = Asset::getBargeSubCatOptions();

                $this->labelAdditionalOne = 'Number of pumps in the barge ?';
                $this->additionalOneOptions = ['1', '2', '3', '4', '5'];
                $this->showAdditionalFieldOne = true;

                $this->labelAdditionalTwo = 'Where is the barge installed ?';
                $this->additionalTwoOptions = ['Static water', 'River water'];
                $this->showAdditionalFieldTwo = true;
                break;

            case (Asset::CATEGORY_CONTROL_PANEL):
                $this->showSizeField = true;
                $options = Asset::getControlPanelSubCatOptions();

                $this->labelAdditionalOne = 'Instruments available in the control panel ?';
                $this->additionalOneOptions = [
                    'Motor starter + Low voltage protection + High Voltage Protection + Change over',
                    'Motor starter',
                    'Motor starter + Low voltage protection + High Voltage Protection',
                    'Motor starter + Low voltage protection + High Voltage Protection + Change over ',
                    'Motor starter + High Voltage Protection + Change over',
                    'Motor starter + Low voltage protection + Change over',
                ];
                $this->showAdditionalFieldOne = true;

                $this->labelAdditionalTwo = 'Does your Control Panel has automation installed ?';
                $this->additionalTwoOptions = ['Yes', 'No'];
                $this->showAdditionalFieldTwo = true;
                break;

            case (Asset::CATEGORY_BOUNDARY_WALL):
                $this->showSizeField = true;
                $options = Asset::getBoundaryWallSubCatOptions();

                $this->labelAdditionalOne = 'Campus lighting facility ?';
                $this->additionalOneOptions = ['Yes', 'No'];
                $this->showAdditionalFieldOne = true;
                break;

            case (Asset::CATEGORY_GATE):
                $this->showSizeField = true;
                $options = Asset::getGateSubCatOptions();

                $this->labelAdditionalOne = 'Gate light installed ?';
                $this->additionalOneOptions = ['Yes', 'No'];
                $this->showAdditionalFieldOne = true;
                break;
            default:
        }
        $this->itemOptions = $options;
    }

    public function render()
    {
        return view('livewire.schemes.asset-create');
    }
}
