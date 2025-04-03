<?php

namespace App\Http\Livewire\Banner;

use App\Models\Banner;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads, InteractsWithBanner;

    public $app_name;
    public $image;
    public $link;
    public $title;

    public function save()
    {
        $validated = $this->validate([
            'app_name' => ['required'],
            'image' => ['required', 'image', 'max:2048'],
            'link' => ['nullable', 'url'],
            'title' => ['nullable'],
        ]);

        $banner = Banner::create($validated + [
            'created_by' => Auth::id(),
        ]);

        if ($this->image) {
            $banner->update([
                'image' => $this->image->storePublicly('/', 'banner'),
            ]);
        }

        $this->banner('Banner Added Successfully');
        return redirect()->route('banners');
    }

    public function render()
    {
        return view('livewire.banner.create',[
            'appOptions' => config('freshman.apps')
        ]);
    }
}
