<?php

namespace App\Http\Livewire\FieldTestKits;

use App\Models\Block;
use App\Models\Village;
use Livewire\Component;
use App\Models\District;
use App\Models\Division;
use App\Models\Panchayat;
use App\Models\FieldTestKit;
use App\Enums\FieldTestKitBrand;
use App\Traits\InteractsWithBanner;
use Illuminate\Validation\Rules\Enum;

class Edit extends Component
{
    use InteractsWithBanner;

    public $blockId;
    public $villageId;
    public $divisionId;
    public $districtId;
    public $assignedPersonName;
    public $assignedPersonPhone;
    public $brandName;
    public $issueDate;
    public $gramPanchayatId;

    public $blocks = [];
    public $villages = [];
    public $panchayats = [];

    public $ftk;

    public function mount(FieldTestKit $ftk)
    {
        $this->ftk = $ftk;

        $this->blockId = $ftk->block_id;
        $this->brandName = $ftk->brand_name;
        $this->villageId = $ftk->village_id;
        $this->issueDate = $ftk->issue_date;
        $this->divisionId = $ftk->division_id;
        $this->districtId = $ftk->district_id;
        $this->gramPanchayatId = $ftk->panchayat_id;
        $this->assignedPersonName = $ftk->assigned_person_name;
        $this->assignedPersonPhone = $ftk->assigned_person_phone;


        $this->blocks = Block::where('id', $this->blockId)->pluck('name', 'id');
        $this->villages = Village::where('id', $this->villageId)->pluck('village_name', 'id');
        $this->panchayats = Panchayat::where('id', $this->gramPanchayatId)->pluck('panchayat_name', 'id');
    }

    public function update()
    {
        $validated = $this->validate([
            'divisionId' => ['required'],
            'districtId' => ['required'],
            'blockId' => ['required'],
            'gramPanchayatId' => ['required'],
            'villageId' => ['required'],
            'assignedPersonName' => ['required', 'string'],
            'assignedPersonPhone' => ['required', 'digits:10'],
            'brandName' => ['required', new Enum(FieldTestKitBrand::class)],
            'issueDate' => ['required', 'date'],
        ]);

        $this->ftk->update([
            'division_id' => $validated['divisionId'],
            'district_id' => $validated['districtId'],
            'block_id' => $validated['blockId'],
            'panchayat_id' => $validated['gramPanchayatId'],
            'village_id' => $validated['villageId'],
            'assigned_person_name' => $validated['assignedPersonName'],
            'assigned_person_phone' => $validated['assignedPersonPhone'],
            'brand_name' => $validated['brandName'],
            'issue_date' => $validated['issueDate'],
        ]);

        $this->banner('FTK updated.');
        return redirect()->route('fieldtestkits');
    }

    public function getDivisionsProperty()
    {
        return Division::query()->orderBy('name')->pluck('name', 'id');
    }

    public function getDistrictsProperty()
    {
        return District::query()
            ->when(!(auth()->user()->isAdministratorOrSuper() || auth()->user()->isLabHo()), function ($query) {
                $query->whereIn('id', auth()->user()->districts()->pluck('district_id'));
            })
            ->orderBy('name')->pluck('name', 'id');
    }

    public function updatedDistrictId($value)
    {
        $this->blocks = Block::where('district_id', $value)->orderBy('name')->pluck('name', 'id');
    }

    public function updatedBlockId($value)
    {
        $this->panchayats = Panchayat::where('block_id', $value)->orderBy('panchayat_name')->pluck('panchayat_name', 'id');
    }

    public function updatedgramPanchayatId($value)
    {
        $this->villages = Village::where('panchayat_id', $value)->orderBy('village_name')->pluck('village_name', 'id');
    }

    public function getBrandsProperty()
    {
        return FieldTestKitBrand::cases();
    }

    public function render()
    {
        return view('livewire.field-test-kits.edit');
    }
}
