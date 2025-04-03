<?php

namespace App\Http\Livewire\Changelogs;

use App\Models\Changelog;
use App\Traits\InteractsWithBanner;
use Livewire\Component;

class Create extends Component
{
    use InteractsWithBanner;

    public $version;
    public $content;
    public $published_date;

    public function mount()
    {
        $this->published_date = now()->toDateString();
    }

    public function save()
    {
        $validated = $this->validate([
            'version' => ['required'],
            'content' => ['required'],
            'published_date' => ['required'],
        ]);

        Changelog::create([
            'version' => $validated['version'],
            'published_at' => $validated['published_date'],
            'content_md' => $validated['content'],
            'content_html' => $validated['content']
        ]);

        $this->banner('Changelog created.');

        return redirect()->route('changelogs');
    }

    public function render()
    {
        return view('livewire.changelogs.create');
    }
}
