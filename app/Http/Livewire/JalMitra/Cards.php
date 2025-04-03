<?php

namespace App\Http\Livewire\JalMitra;

use App\Models\Scheme;
use App\Models\User;
use Livewire\Component;

class Cards extends Component
{
    public $stats = [];

    public function getStats()
    {
        $jms = User::where('role', 'jal-mitra')->count();
        $handoverSchemes = Scheme::where('work_status', 'handed-over')->count();

        $this->stats = [
            [
                'title' => 'Total Number of Jal-Mitra',
                'value' => $jms,
                'link' => route('jm.users'),
            ],
            [
                'title' => 'Handover Schemes',
                'value' => $handoverSchemes,
                'link' => route('schemes', ['status' => 'handed-over']),
            ],
        ];
    }

    public function render()
    {
        return view('livewire.jal-mitra.cards');
    }
}
