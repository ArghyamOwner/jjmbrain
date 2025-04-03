<?php

namespace App\Http\Livewire\Issues;

use App\Models\Issue;
use App\Traits\InteractsWithBanner;
use App\Traits\InteractsWithSlideoverModal;
use Livewire\Component;

class Edit extends Component
{
    use InteractsWithSlideoverModal;
    use InteractsWithBanner;

    public $issueName;
    public $issueId;
    public $categoryType;
    public $subCategoryType;

    protected $listeners = [
        'editIssueSlideover' => 'openModal'
    ];

    public function openModal($id)
    {
        $this->resetErrorBag();
        $this->show = true;
        $this->issueId = $id;

        $issueModel = $this->issue->load('category', 'subCategory');

        $this->issueName = $issueModel->issue;
        $this->categoryType = $issueModel->category?->name;
        $this->subCategoryType = $issueModel->subCategory?->name;
    }

    public function update()
    {
        $validated = $this->validate([
            'issueName' => ['required']
        ]);

        $this->issue->update([
            'issue' => $validated['issueName']
        ]);

        $this->reset();
        $this->emit('refreshEditIssue');
        $this->banner('Saved.');
        $this->close();
    }

    public function getIssueProperty()
    {
        return Issue::findOrFail($this->issueId);
    }

    public function render()
    {
        return view('livewire.issues.edit');
    }
}