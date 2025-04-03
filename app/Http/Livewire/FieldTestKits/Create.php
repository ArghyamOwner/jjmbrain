<?php

namespace App\Http\Livewire\FieldTestKits;

use App\Enums\FieldTestKitBrand;
use App\Models\Bank;
use App\Models\Block;
use App\Models\District;
use App\Models\Division;
use App\Models\FieldTestKit;
use App\Models\Panchayat;
use App\Models\Village;
use App\Traits\InteractsWithBanner;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;

class Create extends Component
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
    public $bank_id;
    public $account_no;
    public $ifsc_no;
    public $whatsapp_no;

    public $blocks = [];
    public $villages = [];
    public $panchayats = [];

    public function save()
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
            'bank_id' => ['required', 'exists:banks,id'],
            'account_no' => ['required', 'string'],
            'ifsc_no' => ['required', 'string'],
            'whatsapp_no' => ['required', 'digits:10'],
        ]);

        FieldTestKit::create([
            'division_id' => $validated['divisionId'],
            'district_id' => $validated['districtId'],
            'block_id' => $validated['blockId'],
            'panchayat_id' => $validated['gramPanchayatId'],
            'village_id' => $validated['villageId'],
            'assigned_person_name' => $validated['assignedPersonName'],
            'assigned_person_phone' => $validated['assignedPersonPhone'],
            'brand_name' => $validated['brandName'],
            'issue_date' => $validated['issueDate'],
            'user_id' => auth()->id(),
            'bank_id' => $validated['bank_id'],
            'account_no' => $validated['account_no'],
            'ifsc_no' => $validated['ifsc_no'],
            'whatsapp_no' => $validated['whatsapp_no'],
        ]);

        $this->banner('New FTK saved.');
        return redirect()->route('fieldtestkits');
    }

    public function getDivisionsProperty()
    {
        return Division::query()->orderBy('name')->pluck('name', 'id');
    }

    public function getBanksProperty()
    {
        return Bank::query()->orderBy('name')->pluck('name', 'id');
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
        return view('livewire.field-test-kits.create');
    }
}
