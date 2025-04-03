<?php

namespace App\Http\Livewire\Galleries;

use App\Models\Gallery;
use App\Http\Livewire\Modal;
use App\Enums\GalleryImageTypes;

class Edit extends Modal
{
    public $galleryId;
    public $caption;
    public $image_type;

    protected $listeners = [
        'showGalleryEdit'
    ];

    public function showGalleryEdit(Gallery $gallery)
    {
        $this->galleryId = $gallery->id;
        $this->caption = $gallery->caption;
        $this->image_type = $gallery->type;

        $this->openModal();
    }

    public function update()
    {
        $validated = $this->validate([
            'caption' => ['required'],
            'image_type' => ['required'],
        ]);
 
        $this->gallery->update([
            'caption' => $validated['caption'],
            'type' => $validated['image_type'] ?? GalleryImageTypes::OTHER,
        ]);
      
        $this->reset(['caption', 'image_type']);

        $this->closeModal();

        $this->emit('refreshData');

        $this->notify('Gallery image updated.');   
    }

    public function getGalleryProperty()
    {
        return Gallery::findOrFail($this->galleryId);
    }

    public function getGalleryTypesProperty()
    {
        return GalleryImageTypes::cases();
    }

    public function render()
    {
        return view('livewire.galleries.edit');
    }
}
