<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Litholog;
use App\Models\Scheme;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Location extends Component
{
    public $schemeId;
    public $latitude;
    public $longitude;

    public function save()
    {
        $validated = $this->validate([
            'latitude' => ['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'longitude' => ['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
        ]);

        $this->scheme->update($validated);

        $elevation = null;
        $responses = Http::get(
            'https://api.open-meteo.com/v1/elevation?latitude=' . $this->scheme->latitude . '&longitude=' . $this->scheme->longitude
        );
        $currentData = json_decode($responses->body(), true);
        if (array_key_exists('elevation', $currentData)) {
            $elevation = collect($currentData['elevation'])->first();
        } else {
            Log::info('ELEVATION_API_ERROR : ' . $currentData['reason']);
        }

        Litholog::where('scheme_id', $this->scheme->id)->update($validated + [
            'elevation' => $elevation,
        ]);

        $scheme = $this->scheme->refresh();

        $this->latitude = $scheme->latitude;
        $this->longitude = $scheme->longitude;

        $this->notify('Scheme location updated.');
    }

    public function getSchemeProperty()
    {
        return Scheme::findOrFail($this->schemeId);
    }

    public function render()
    {
        return view('livewire.schemes.location');
    }
}
