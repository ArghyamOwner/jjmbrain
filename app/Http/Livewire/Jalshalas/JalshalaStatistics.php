<?php

namespace App\Http\Livewire\Jalshalas;

use App\Models\EducationBlock;
use App\Models\Jalshala;
use Livewire\Component;

class JalshalaStatistics extends Component
{
    public $educationBlockId;
    public $districtId;
    public $type;

    public function mount(EducationBlock $educationBlock)
    {
        $this->educationBlockId = $educationBlock->id;
        $this->districtId = $educationBlock->district_id;
        $this->type = request('type', '');
    }

    public function render()
    {
        $jalshalas = Jalshala::query()
            ->whereHas('educationBlocks', function ($q) {
                $q->where('education_block_id', $this->educationBlockId);
            })
            ->where('type', $this->type)
           ->withCount(['jalshalaSchools', 'jalshalaSchoolsJaldoots'])
            ->get();

        return view('livewire.jalshalas.jalshala-statistics', [
            'jalshalas' => $jalshalas
        ]);
    }
}
