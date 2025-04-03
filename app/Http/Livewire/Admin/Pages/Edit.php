<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use App\Enums\GlobalComponents;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class Edit extends Component
{
    public $pageId;
    public $title;
    public $summary;
    public $content;
    public $extraContent;
    public $publishedAt;

    public function mount()
    {
        $page = $this->page;
        
        $this->title = $page->title;
        $this->content = $page->content;
        $this->summary = $page->summary;
        $this->extraContent = $page->extra_content_lists;
        $this->publishedAt = $page->published_at ? 'visible' : 'hidden';
    }

    public function getPageProperty()
    {
        return Page::findOrFail($this->pageId);
    }

    public function getGlobalComponentsProperty()
    {
        return GlobalComponents::toArray();
    }

    public function save()
    {
        $validated = $this->validate([
            'title' => ['required', 'string'],
            'summary' => ['nullable'],
            'content' => ['nullable'],
            'publishedAt' => ['required', Rule::in(['visible', 'hidden'])],
            'extraContent' => ['nullable', 'array'],
            'extraContent.*'  => [
                'required',
                'string',
                new Enum(GlobalComponents::class)
            ]
        ]);

        $this->page->update([
            'title' => $validated['title'],
            'summary' => $validated['summary'],
            'content' => $validated['content'],
            'extra_content' => collect($validated['extraContent'])->implode(','),
            'published_at' => $validated['publishedAt'] === 'visible' ? now() : null,
        ]);

        $this->notify('Page updated.');

        $this->emit('$refresh');
    }

    public function render()
    {
        return view('livewire.admin.pages.edit');
    }
}
