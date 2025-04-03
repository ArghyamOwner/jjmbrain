<?php

namespace App\Http\Livewire\JalAddas;

use App\Models\JalAdda;
use App\Traits\InteractsWithBanner;
use Livewire\Component;
use Livewire\WithFileUploads;

class Image extends Component
{
    use InteractsWithBanner;
    use WithFileUploads;

    public $jaladdaId;
    public $oneImage;
    public $twoImage;

    public function mount(JalAdda $jaladda)
    {
        $this->jaladdaId = $jaladda->id; 
    }

    public function save()
    {
        $validated = $this->validate([
            'oneImage' => ['required', 'image', 'max:4048'],
            'twoImage' => ['required', 'image', 'max:4048'],

        ], [], [
            'oneImage' => 'image 1',
            'twoImage' => 'image 2'
        ]);

        if ($validated['oneImage']) {
            $this->jaladda->update([
                'one_image' => $validated['oneImage']->storePublicly('/', 'uploads'),
                'status' => 'completed'
            ]);
        }

        if ($validated['twoImage']) {
            $this->jaladda->update([
                'two_image' => $validated['twoImage']->storePublicly('/', 'uploads')
            ]);
        }

        $this->banner('Post Jal Adda data added.');

        return redirect()->route('jaladdas.show', $this->jaladdaId);
    }

    public function getJaladdaProperty()
    {
        return JalAdda::findOrFail($this->jaladdaId);
    }

    public function render()
    {
        return view('livewire.jal-addas.image');
    }
}
