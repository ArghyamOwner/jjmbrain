<?php

namespace App\Http\Livewire\Issues;

use App\Models\Issue;
use Livewire\Component;

class Show extends Component
{
    public $issue;

    public function mount(Issue $issue)
    {
        $this->issue = $issue->load('category', 'subCategory');
    }

    public function render()
    {
        return view('livewire.issues.show');
    }
}
