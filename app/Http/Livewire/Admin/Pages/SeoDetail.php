<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;

class SeoDetail extends Component
{
    public $pageId;
    public $slugUrl;
    public $metaTitle;
    public $metaDescription;

    public function saveSeoDetails()
    {
        $validated = $this->validate([
            'metaTitle' => ['required', 'string'],
            'metaDescription' => ['required', 'string']
        ]);

        $this->page->update([
            'meta_title' => $validated['metaTitle'],
            'meta_description' => $validated['metaDescription'],
        ]);

        $this->page->refresh();

        $this->notify('Seo details saved.');
        $this->emit('$refresh');
    }

    public function getPageProperty()
    {
        return Page::findOrFail($this->pageId);
    }

    public function render()
    {
        $this->metaTitle = $this->page->meta_title;
        $this->metaDescription = $this->page->meta_description;

        return view('livewire.admin.pages.seo-detail');
    }
}
