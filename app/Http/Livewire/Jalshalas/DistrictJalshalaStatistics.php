<?php

namespace App\Http\Livewire\Jalshalas;

use App\Models\District;
use App\Models\EducationBlock;
use App\Traits\WithExportToCsv;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\Support\Str;

class DistrictJalshalaStatistics extends Component
{
    public $type;

    use WithExportToCsv;

    public function mount()
    {
        $this->type = request('type', '');
    }

    public function generate()
    {
        $data = [];
        $districts = District::with([ $this->type === 'phase_I' ? 'phaseIJalshalaStatics' : 'phaseIIJalshalaStatics'])->groupBy('districts.id')->orderBy('name')->lazy();
        foreach ($districts as $district) {
            $data[] = [
                'district' => $district->name,
                'number_of_Jalshala_Targeted' =>$this->type === 'phase_I' ?  $district->targeted_jalshala : $district->phase2_targeted_jalshala,
                'number_of_Jalshala_Conducted' =>$this->type === 'phase_I' ? $district->phaseIJalshalaStatics?->sum('conducted') : $district->phaseIIJalshalaStatics?->sum('conducted'),
                'number_of_Jalshala_Pending' =>$this->type === 'phase_I' ? $district->phaseIJalshalaStatics?->sum('pending'):$district->phaseIIJalshalaStatics?->sum('pending'),
                'number_of_PWSS_Mapped' =>$this->type === 'phase_I' ?$district->phaseIJalshalaStatics?->sum('pwss_mapped'):$district->phaseIIJalshalaStatics?->sum('pwss_mapped'),
                'number_of_School_Mapped' =>$this->type === 'phase_I' ? $district->phaseIJalshalaStatics?->sum('school_mapped'):$district->phaseIIJalshalaStatics?->sum('school_mapped'),
                'number_of_Jaldoot' =>$this->type === 'phase_I' ? $district->phaseIJalshalaStatics?->sum('jaldoot_mapped'):$district->phaseIIJalshalaStatics?->sum('jaldoot_mapped'),
                'number_of_Jaldoot_Participated' =>$this->type === 'phase_I' ? $district->phaseIJalshalaStatics?->sum('jaldoot_participated'): $district->phaseIIJalshalaStatics?->sum('jaldoot_participated'),
            ];
        }
        if (count($data)) {
            return $this->exportToCsv($data, 'district_jalshala_report.csv');
        } else {
            $this->notify('Data not found', 'error');
            return redirect()->back();
        }
    }

    public function render()
    {
        $districts = District::with([ $this->type === 'phase_I' ? 'phaseIJalshalaStatics' : 'phaseIIJalshalaStatics'])
                     ->groupBy('districts.id')->orderBy('name')->lazy();
        return view('livewire.jalshalas.district-jalshala-statistics', [
            'districts' => $districts,
        ]);
    }
}
