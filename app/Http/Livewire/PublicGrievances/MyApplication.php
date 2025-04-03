<?php

namespace App\Http\Livewire\PublicGrievances;

use App\Models\Category;
use App\Models\Grievance;
use Livewire\Component;

class MyApplication extends Component
{
    public $ref;
    public $url;
    public $grievance;
    public $citizen_name;
    public $resolvedDays;

    public function mount()
    {
        $grievance = Grievance::find($this->grievance);

        $this->ref = $grievance->reference_no;

        $this->citizen_name = $grievance->citizen_name;

        $this->url =  route('publicGrievance.status', ['ref_number' => $this->ref ]);

        $category = Category::whereId($grievance->category_id)->first();

        if($category){
            $this->resolvedDays = $category->resolved_days;
        }
    }

    public function render()
    {
        return view('livewire.public-grievances.my-application')
        ->layout('layouts.guest');
    }
}
