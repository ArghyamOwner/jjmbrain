<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Gallery;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Enums\GalleryImageTypes;

class Images extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $schemeId;
    public $caption;
    public $image;
    public $image_type;
    public $tag;

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function save()
    {
        $validated = $this->validate([
            'caption' => ['required'],
            'image' => ['required', 'image', 'max:5048'],
            'image_type' => ['required'],
            'tag' => ['nullable']
        ]);

        $gallery = Gallery::create([
            'user_id' => auth()->id(),
            'scheme_id' => $this->schemeId,
            'scheme_id' => $this->schemeId,
            'caption' => $validated['caption'],
            'tag' => $validated['tag'],
            'type' => $validated['image_type'] ?? GalleryImageTypes::OTHER,
        ]);

        if ($this->image) {
            $gallery->update([
                'image' => $this->image->storePublicly('/', 'uploads'),
            ]);
        }

        $this->reset(['caption', 'image', 'image_type']);

        $this->dispatchBrowserEvent('hide-modal');

        $this->emit('$refresh');

        $this->notify('Gallery image added.');
    }

    public function getGalleryTypesProperty()
    {
        return GalleryImageTypes::cases();
    }

    public function render()
    {
        return view('livewire.schemes.images', [
            'tags' => config('freshman.image_tags'),
            'images' => Gallery::query()
                ->where('scheme_id', $this->schemeId)
                ->latest('id')
                ->fastPaginate()
        ]);
    }
}
