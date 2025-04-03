<?php

namespace App\Http\Livewire\Tenants\HomepageSettings;

use Livewire\Component;
use App\Enums\GlobalComponents;
use App\Models\HomepageSetting;
use Illuminate\Validation\Rules\Enum;

class Create extends Component
{
    public $layout;

    public function mount()
    {
        $this->layout = $this->homepageSetting?->content_lists;
    }

    public function getGlobalComponentsProperty()
    {
        return GlobalComponents::toArray();
    }

    public function save()
    {
        $validated = $this->validate([
            'layout' => ['required', 'array'],
            'layout.*'  => [
                'required',
                'string',
                new Enum(GlobalComponents::class)
            ]
        ]);
 
        if ($this->homepageSetting) {
            $this->homepageSetting->update(['content' => collect($validated['layout'])->implode(',')]);
        } else {
            HomepageSetting::create(['content' => collect($validated['layout'])->implode(',')]);
        }

        $this->notify('Layout content saved.');
        $this->emit('$refresh');
    }

    public function getHomepageSettingProperty()
    {
        return HomepageSetting::first();
    }

    public function render()
    {
        return view('livewire.tenants.homepage-settings.create');
    }
}
