<?php

namespace App\Http\Livewire\CanalTracking;

use App\Models\Scheme;
use App\Models\SchemePipeNetwork;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadNetworkGeojson extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $scheme;
    public $file;

    public function mount(Scheme $scheme)
    {
        $this->scheme = $scheme;
    }

    public function save()
    {
        $validate = $this->validate([
            'file' => ['required'],
        ]);

        if ($validate['file']) {
            SchemePipeNetwork::create([
                'file' => $validate['file']->storePublicly('/', 'canaltrackingGeoJson'),
                'scheme_id' => $this->scheme->id,
                'created_by' => Auth::id(),
            ]);
        }
        $this->banner('Uploaded Successfully');
        return redirect()->route('schemes.show', [$this->scheme->id, 'tab' => 'pipe-network']);
    }

    public function render()
    {
        return view('livewire.canal-tracking.upload-network-geojson');
    }
}
