<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Traits\InteractsWithBanner;

class Create extends Component
{
    use InteractsWithBanner;

    public $title;
    public $summary;
    public $content;
    public $extraContent;
    public $publishedAt;

    public function mount()
    {
        $this->publishedAt = 'visible';
    }

    public function save()
    {
        $validated = $this->validate([
            'title' => ['required', 'string'],
            'summary' => ['required'],
            'content' => ['required'],
            'publishedAt' => ['required', Rule::in(['visible', 'hidden'])],
        ]);

        Page::create([
            'title' => $validated['title'],
            'summary' => $validated['summary'],
            'content' => $validated['content'],
            'published_at' => $validated['publishedAt'] === 'visible' ? now() : null,
        ]);

        $this->banner('Page created.');

        return redirect()->route('admin.pages');
    }

    public function render()
    {
        return view('livewire.admin.pages.create');
    }
}
