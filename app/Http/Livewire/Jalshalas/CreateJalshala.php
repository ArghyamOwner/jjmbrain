<?php

namespace App\Http\Livewire\Jalshalas;

use App\Models\Block;
use App\Models\Scheme;
use App\Models\School;
use Livewire\Component;
use App\Models\District;
use App\Models\Jalshala;
use App\Enums\JalshalaType;
use Illuminate\Support\Str;
use App\Models\EducationBlock;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Traits\InteractsWithBanner;

class CreateJalshala extends Component
{
    use InteractsWithBanner;

    public $district;
    public $block;
    public $scheme;
    public $jalshalaSchools = [];

    public $jalshalaSchemes = [];

    public $school_name;
    public $teacher_name;
    public $phone_number;

    public $scheme_name;

    //  public $educationBlocks = [];
    public $educationBlock;
    public $schools = [];
    public $schoolId;

    public $schemesArray = [];

    public $education_block_id;

    public $educationBlocksArray = [];
    public $jalshala_uin;

    public $type;

    protected $queryString = [
        'type' => [
            'except' => ''
        ]
    ];

    public function mount()
    {
        $this->district = auth()->user()->districts->first()['id'];
    }

    public function save()
    {
        $validated = $this->validate([
            'district' => ['required'],
            //  'block' => ['required'],
            //  'scheme' => ['required'],
            'education_block_id' => ['required'],
            'jalshalaSchools' => ['required', 'array', 'min:1'],
            'jalshala_uin' => ['required', 'unique:jalshalas'],
            'jalshalaSchemes' => ['required', 'array', 'min:1'],
            'type' => ['required', Rule::in(JalshalaType::values())]
        ]);

        try {
            return DB::transaction(function () use ($validated) {
                // dd($validated);

                // $block = EducationBlock::findOrFail($validated['education_block_id']);
                // $existingCount = Jalshala::where('education_block_id', $validated['education_block_id'])->count();
                // $uin = $block->block_code . 'JS' . sprintf('%02d', ($existingCount + 1));

                // 1. Create a Jal Shala
                $jalshala = Jalshala::create([
                    'user_id' => auth()->id(),
                    'district_id' => $validated['district'],
                    // 'block_id' => $validated['block'],
                    //  'education_block_id' => $validated['education_block_id'],
                    'jalshala_uin' => Str::upper($validated['jalshala_uin']),
                    'type' => $validated['type']
                ]);

                // 2. Associated multiple schemes with a Jal Shala
                // $jalshala->schemes()->sync($validated['scheme']);

                $jalshala->schemes()->sync(collect($validated['jalshalaSchemes'])->pluck('scheme'));

                // 3. Associated multiple education blocks with a Jal Shala
                $jalshala->educationBlocks()->sync($validated['education_block_id']);

                // 4. Add multiple schools with a Jal Shala
                foreach ($validated['jalshalaSchools'] as $jalshalaSchool) {
                    $jalshala->jalshalaSchools()->create($jalshalaSchool);
                }

                $this->banner('Jal Shala created.');

                return redirect()->route('jalshalas.index');
            });
        } catch (\Exception $e) {
            $this->notify('Something went wrong. Try again' . $e->getMessage(), 'error');
        }
    }

    public function addScheme()
    {
        $validated = $this->validate([
            'block' => ['required'],
            'scheme' => ['required'],
        ]);

        $validated['id'] = Str::uuid();

        $scheme = Scheme::query()->whereId($validated['scheme'])->first();

        $validated['scheme_name'] = $scheme->name;

        $this->jalshalaSchemes[] = $validated;

        $this->reset(['scheme_name', 'block', 'scheme']);

        $this->dispatchBrowserEvent('hide-modal');
    }

    public function deleteScheme($scheme)
    {
        $this->jalshalaSchemes = collect($this->jalshalaSchemes)->filter(fn ($item) => $item['id'] != $scheme)->all();
    }

    public function addSchool()
    {
        $validated = $this->validate([
            'educationBlock' => ['required'],
            'schoolId' => ['required'],
            'teacher_name' => ['required', 'string'],
            'phone_number' => ['required', 'digits:10'],
        ]);

        $validated['id'] = Str::uuid();

        $school = School::query()->whereId($validated['schoolId'])->first();

        $validated['school_id'] = $validated['schoolId'];

        $validated['school_name'] = $school->school_name;

        $validated['school_code'] = $school->school_code;

        $this->jalshalaSchools[] = $validated;

        $this->reset(['school_name', 'teacher_name', 'phone_number', 'educationBlock', 'schoolId']);

        $this->dispatchBrowserEvent('hide-modal');
    }

    public function deleteSchool($schoolId)
    {
        $this->jalshalaSchools = collect($this->jalshalaSchools)->filter(fn ($item) => $item['id'] != $schoolId)->all();
    }

    public function getDistrictsProperty()
    {
        // return District::orderBy('name')->pluck('name', 'id');
        return auth()->user()->districts->pluck('name', 'id');
    }

    public function virtualSelectSearch($term)
    {
        $schemes = Scheme::whereLike(['name', 'scheme_uin'], $term)
            ->limit(15)
            ->get()
            ->transform(fn ($item) => [
                'value' => $item->id,
                'label' => $item->name
            ])->all();

        $this->emit('result-found', $schemes);
    }

    // public function updatedDistrict($value)
    // {
    //     $this->educationBlocks = EducationBlock::query()->where('district_id', $value)->pluck('block_name', 'id');
    // }

    public function updatedEducationBlock($value)
    {
        $this->schools = School::query()->where('education_block_id', $value)
            ->where('category', '!=', '1 - Primary')
            ->get()
            ->map(fn ($item) => [
                "label" => $item->school_name,
                "value" => $item->id,
            ])->all();
    }

    // public function getJalshalaTypesProperty()
    // {
    //     return JalshalaType::cases();
    // }

    public function render()
    {
        $blocks = Block::where('district_id', $this->district)->pluck('name', 'id');

        $educationBlocks = EducationBlock::query()->where('district_id', $this->district)->pluck('block_name', 'id');

        $this->educationBlocksArray = EducationBlock::query()
            ->where('district_id', $this->district)
            ->get()
            ->transform(fn ($item) => [
                'value' => $item->id,
                'label' => $item->block_name
            ])->all();

        $this->schemesArray = Scheme::query()
            ->where('district_id', $this->district)
            // ->where('block_id', $this->block)
            //  ->limit(15)
            ->whereHas('blocks', function ($q) {
                $q->where('block_id', $this->block);
            })
            ->get()
            ->transform(fn ($item) => [
                'value' => $item->id,
                'label' => $item->name
            ])->all();


        return view('livewire.jalshalas.create-jalshala', [
            'blocks' => $blocks,
            'educationBlocks' => $educationBlocks
        ]);
    }
}
