<?php

namespace App\Http\Livewire\PublicGrievances;

use Livewire\Component;
use App\Models\Grievance;

class Track extends Component
{
    public $application;
    public $search;
    public $ref_number;

    protected $queryString = [
        'ref_number' => [
            'except' => ''
        ]
    ];

    public function mount()
    {
        if ($this->ref_number) {
            $this->application = Grievance::query()
                ->select('id', 'reference_no', 'status', 'division_id', 'district_id', 'block_id', 'panchayat_id', 'village_id', 'scheme_id', 'issue_id', 'remarks', 'created_at', 'category_id', 'sub_category_id')
                ->with('division', 'block', 'panchayat', 'village', 'scheme:id,name', 'issue:id,issue', 'category:id,name', 'subCategory:id,name')
                ->where('reference_no', $this->ref_number)
                ->orderBy('created_at', 'desc')
                ->get();

            if (!$this->application) {
                $this->notify('Please Enter Valid Reference Number', 'error');
            }
        }
    }

    public function checkStatus()
    {
        $validatedData = $this->validate([
            'search' => ['required'],
        ]);

        $this->application = Grievance::query()
            ->select('id', 'reference_no', 'status', 'division_id', 'district_id', 'block_id', 'panchayat_id', 'village_id', 'scheme_id', 'issue_id', 'remarks', 'created_at', 'category_id', 'sub_category_id')
            ->with('division', 'block', 'panchayat', 'village', 'scheme:id,name', 'issue:id,issue', 'category:id,name', 'subCategory:id,name')
            ->where('reference_no', $validatedData['search'])
            ->orWhere('citizen_phone', $validatedData['search'])
            ->orWhere('reference_no', $this->ref_number)
            ->orderBy('created_at', 'desc')
            ->get();
        if (!$this->application) {
            $this->notify('Please Enter Valid Reference Number or Phone Number', 'error');
        }
    }

    public function render()
    {
        return view('livewire.public-grievances.track')
            ->layout('layouts.guest');
    }
}
