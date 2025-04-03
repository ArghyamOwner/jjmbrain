<?php

namespace App\Http\Livewire\Banner;

use App\Models\Banner;
use Livewire\Component;

class Archive extends Component
{
    public $archive;
    public $bannerId;

    public function mount()
    {
        $this->archive = $this->banner->status;
    }

    public function updatedArchive($value)
    {
        if ($value === "Archive") {
            $this->banner->update([
                'status' => 'Archive'
            ]);

            $this->notify('Banner Archived.', 'error');
        } else {
            $this->banner->update([
                'status' => 'Active'
            ]);
            $this->notify('Banner Active.');
        }
        $this->emit('refreshData');
    }

    public function getBannerProperty()
    {
        return Banner::findOrFail($this->bannerId);
    }

    public function render()
    {
        return view('livewire.banner.archive');
    }
}
