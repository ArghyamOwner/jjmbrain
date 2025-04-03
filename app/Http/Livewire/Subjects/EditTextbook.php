<?php

namespace App\Http\Livewire\Subjects;

use Livewire\Component;
use App\Models\Textbook;
use App\Traits\WithSlideover;

class EditTextbook extends Component
{
    use WithSlideover;

    public $textbookId;
    public $title;
    public $description;
    public $image;
    public $link;
    public $imageUrl;

    protected $listeners = [
        'showEditTextbookSlideover'
    ];

    public function showEditTextbookSlideover(Textbook $textbook)
    {
        $this->textbookId = $textbook->id;
        $this->title = $textbook->textbook_title;
        $this->description = $textbook->textbook_description;
        $this->imageUrl = $textbook->textbook_image_url;
        $this->link = $textbook->textbook_link;
        
        $this->toggle();
    }

    public function save()
    {
        $validated = $this->validate([
            'title' => ['required'],
            'link' => ['required', 'url'],
            'description' => ['nullable'],
            'image' => ['nullable', 'image', 'max:2024'],
        ]);

        $this->textbook->update([
            'textbook_title' => $validated['title'],
            'textbook_description' => $validated['description'],
            'textbook_link' => $validated['link']
        ]);

        if ($this->image) {
            $this->textbook->update([
                'textbook_image' => $this->image->store('/', 'uploads')
            ]);
        }

        $this->close();

        $this->dispatchBrowserEvent('destroy-filepond');
        $this->bannerMessage('Textbook details updated.');

        $this->emit('refreshData');
    }

    public function getTextbookProperty()
    {
        return Textbook::findOrFail($this->textbookId);
    }
    
    public function render()
    {
        return view('livewire.subjects.edit-textbook');
    }
}
