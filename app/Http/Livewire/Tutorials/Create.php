<?php

namespace App\Http\Livewire\Tutorials;

use App\Models\Tutorial;
use App\Traits\InteractsWithBanner;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    Use InteractsWithBanner;
    
    public $actor;
    public $caption;
    public $instruction_link;
    public $instruction_attachment;

    public function save()
    {
        $validated = $this->validate([
            'actor' => ['required'],
            'caption' => ['nullable'],
            'instruction_link' => ['nullable', 'url', 'required_if:instruction_attachment,null'],
            'instruction_attachment' => ['nullable','required_if:instruction_link,null' , 'mimes:pdf', 'max:2048'],
        ]);

        $tutorial = Tutorial::create([
            'actor' => $validated['actor'],
            'caption' => $validated['caption'],
            'instruction_link' => $validated['instruction_link'],
            'user_id' => auth()->id(),
        ]);

        if ($validated['instruction_attachment']) {

            $tutorial->update([
                'instruction_attachment' => $this->instruction_attachment->storePublicly('/', 'uploads'),
            ]);
        }

        $this->banner('Tutorial saved.');

        return redirect()->route('tutorials');
    }

    public function getActorsProperty()
    {
        return collect(config('freshman.roles'))->filter(function ($item, $key) {
            return $key != 'admin' && $key != 'super-admin';
        });
    }

    public function render()
    {
        return view('livewire.tutorials.create');
    }
}
