<?php

namespace App\Http\Livewire\Issues;

use App\Models\Category;
use App\Models\Issue;
use App\Models\SubCategory;
use App\Traits\InteractsWithBanner;
use Livewire\Component;

class Create extends Component
{
    use InteractsWithBanner;

    public $issue;
    // public $type;
    public $category_id;
    public $sub_category_id;
    public $subCatOptions = [];
    public $sla;
    // public $has_escalation;

    public function getCategoriesProperty()
    {
        return Category::orderBy('name')->pluck('name', 'id')->all();
    }

    public function updatedCategoryId()
    {
        $this->subCatOptions = SubCategory::where('category_id', $this->category_id)->pluck('name', 'id')->all();
    }

    public function save()
    {
        $validatedData = $this->validate([
            'issue' => ['required'],
            'category_id' => ['required'],
            'sub_category_id' => ['required'],
            // 'type' => ['required'],
            // 'sla' => ['required'],
        ]);

        $issue = Issue::create($validatedData);
        $this->banner('Issue Created Successfully. Please Add Escalation Matrix Details Below.');
        return redirect()->route('issues.show', $issue->id);
    }

    public function render()
    {
        return view('livewire.issues.create', [
            'types' => Issue::getTypeOptions(),
            'escalation' => Issue::getEscalationOptions(),
        ]);
    }
}
