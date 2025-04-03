<?php

namespace App\Http\Livewire\Schemes;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class ImisBasicDetails extends Component
{
    public $imis;

    public function mount($imis)
    {
        $this->imis = $imis;
    }

    public function fetchImisDetails()
    {
        if (!$this->imis) {
            return null;
        }
        $apiURL = "http://165.22.213.71:8000/schemes/$this->imis";
        $response = Http::withToken("eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJuYW1lX29mX3VzZXIiOiJzdW1hdG8iLCJpYXQiOjE3MDkwNDU1NDUuMjMxMjA3NH0.UYp50VvWMo4hgbBiT5XoVd2E6AI1u0VI92HS8_P05iQ")
            ->get($apiURL);
        $responseBody = json_decode($response->getBody(), true);
        return $responseBody;
    }

    public function render()
    {
        return view('livewire.schemes.imis-basic-details',[
            'imisDetails' => $this->fetchImisDetails()
        ]);
    }
}
