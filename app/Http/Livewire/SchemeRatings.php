<?php

namespace App\Http\Livewire;

use App\Models\Rating;
use Livewire\Component;

class SchemeRatings extends Component
{
    public $schemeId;
    public $isSchemeRated;

    public function save($rating)
    {
        Rating::create([
            'scheme_id' => $this->schemeId,
            'rating' => intval($rating),
            'ip_address' => request()->ip()
        ]);

        $this->isSchemeRated = true;
    }

    public function render()
    {
        return view('livewire.scheme-ratings');
    }
}
