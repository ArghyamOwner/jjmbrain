<?php

namespace App\Http\Livewire\Jalshalas;

use App\Enums\JalshalaType;
use App\Models\EducationBlock;
use Livewire\Component;

class EducationBlockJalshalaStatistics extends Component
{
    public $district;
    public $type;

    public function mount($district)
    {
        $this->district = $district;
        $this->type = request('type', '');
    }

    public function render()
    {
        $educationblocks = EducationBlock::query()
            ->where('district_id', $this->district)
            ->whereRelation('jalshalas', 'type', $this->type)
            ->withCount([
                $this->type === 'phase_I' ? 'phaseIOrganisedJalshalas' : 'phaseIIOrganisedJalshalas',
                $this->type === 'phase_I' ? 'phaseIPlannedJalshalas' : 'phaseIIPlannedJalshalas',
            ])
            ->with($this->type === 'phase_I' ? 'phaseIOrganisedJalshalas' : 'phaseIIOrganisedJalshalas')
            ->orderBy('block_name')
            ->get();


        return view('livewire.jalshalas.education-block-jalshala-statistics', [
            'educationblocks' => $educationblocks
        ]);
    }
}
