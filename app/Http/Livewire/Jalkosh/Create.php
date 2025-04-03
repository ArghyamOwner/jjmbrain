<?php

namespace App\Http\Livewire\Jalkosh;

use Livewire\Component;
use App\Models\JalkoshLink;
use App\Enums\JalkoshStatus;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Traits\InteractsWithBanner;

class Create extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $type = 'image';
    public $video;
    public $image;
    public $status;

    public function save()
    {
        $validated = $this->validate([
            'type' => ['required'],
            'video' => ['nullable', 'url', 'required_if:image,null'],
            'image' => ['nullable', 'required_if:video,null', 'mimes:jpg,jpeg,png', 'max:2048'],
            'status' => ['required', Rule::in(JalkoshStatus::values())]
        ]);

        $jalkosh =  JalkoshLink::create([
            'link_type' => $validated['type'],
            'external_link' => $validated['video'],
            'status' => $validated['status'],
            'user_id' => auth()->id()
        ]);

        if ($this->image) {
            $jalkosh->update([
                'attachment' => $validated['image']->storePublicly('/', 'uploads'),
            ]);
        }

        $this->banner('Link saved.');
        return redirect()->route('jalkoshlinks');
    }

    public function getTypesProperty()
    {
        return [
            'image' => 'Image',
            'video' => 'Video',
        ];
    }

    public function getStatusesProperty()
    {
        return JalkoshStatus::cases();
    }

    public function render()
    {
        return view('livewire.jalkosh.create');
    }
}
