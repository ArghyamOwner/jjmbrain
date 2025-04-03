<?php

namespace App\Http\Livewire\Jalshalas;

use App\Enums\TrainerOrganisation;
use App\Models\Trainer;
use Livewire\Component;
use App\Models\District;
use App\Models\EducationBlock;
use Illuminate\Validation\Rule;
use App\Traits\InteractsWithBanner;
use Livewire\WithFileUploads;

class CreateTrainer extends Component
{
    use InteractsWithBanner;
    use WithFileUploads;

    public $trainer_name;
    public $phone_number;
    public $district;
    public $bank_name;
    public $account_number;
    public $ifsc_code;
    public $education_block_id;
    public $organisation;

    public $trainerType;
    public $bank_document;

    public $educationBlocks = [];

    public function save()
    {
        $validated = $this->validate([
            'district' => ['required'],
            'trainer_name' => ['required'],
            'phone_number' => ['required', 'digits:10'],
            'education_block_id' => ['nullable', 'required_if:trainerType,block_trainer', Rule::in(collect($this->educationBlocks)->keys()->all())],
            'bank_name' => ['required'],
            'account_number' => ['required'],
            'ifsc_code' => ['required'],
            'organisation' => ['required', Rule::in(TrainerOrganisation::values())],
            'trainerType' => ['required'],
            'bank_document' => ['required', 'image', 'max:2000']
        ], [], [
            'education_block_id' => 'education block'

        ]);

        $trainer = Trainer::create([
            'ifsc_code' => $validated['ifsc_code'],
            'bank_name' => $validated['bank_name'],
            'district_id' => $validated['district'],
            'organisation' => $validated['organisation'],
            'trainer_name' => $validated['trainer_name'],
            'phone_number' => $validated['phone_number'],
            'account_number' => $validated['account_number'],
            'education_block_id' => $validated['education_block_id'],
            'trainer_type' => $validated['trainerType'],
        ]);

        $trainer->update([
            'bank_document' => $validated['bank_document']->storePublicly('/', 'uploads'),
        ]);

        $this->banner('Trainer added.');

        return redirect()->route('trainers.index');
    }

    public function getDistrictsProperty()
    {
        //  return District::orderBy('name')->pluck('name', 'id');
        return auth()->user()->districts->pluck('name', 'id');
    }

    public function updatedDistrict($value)
    {
        $this->educationBlocks = EducationBlock::query()->where('district_id', $value)->pluck('block_name', 'id');
    }

    public function getOrganisationsProperty()
    {
        return TrainerOrganisation::cases();
    }

    public function getTrainerTypesProperty()
    {
        return [
            'district_trainer' => 'District Trainer',
            'block_trainer' => 'Block Trainer'
        ];
    }

    public function render()
    {
        return view('livewire.jalshalas.create-trainer');
    }
}
