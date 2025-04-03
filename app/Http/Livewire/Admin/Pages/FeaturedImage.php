<?php

namespace App\Http\Livewire\Admin\Pages;

use App\Models\Page;
use Livewire\Component;
use Livewire\WithFileUploads;

class FeaturedImage extends Component
{
    use WithFileUploads;

    public $pageId;
    public $featuredImage;
    public $featuredImagePath;

    protected $listeners = [
        'refreshFeaturedImagePage' => 'refreshImage'
    ];

    public function mount()
    {
        $this->featuredImagePath = $this->page->featured_image_url;
    }

    public function refreshImage()
    {
        $this->featuredImagePath = $this->page->featured_image_url;
    }

    public function saveFeaturedImage()
    {
        $this->validate([
            'featuredImage' => ['required', 'image', 'max:2024']
        ]);
        
        $this->page->update([
            'featured_image' => $this->featuredImage->store('/', 'public')
        ]);

        $this->page->refresh();

        $this->featuredImagePath = $this->page->featured_image_url;

        $this->emit('refreshFeaturedImagePage');
        $this->notify('Featured image saved.');
    }

    public function getPageProperty()
    {
        return Page::findOrFail($this->pageId);
    }

    public function render()
    {
        return view('livewire.admin.pages.featured-image');
    }
}
