<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\File;

class Holiday extends Component
{
    public function render()
    {
        $holidayListsJson = File::json(public_path('holidays.json'));

        $holidays = collect($holidayListsJson)
            ->map(fn($item) => [
                'date_formatted' => $item['date'],
                'date' => Carbon::parse($item['date'])->format('Y-m-d'),
                'name' => $item['name'],
                'type' => $item['type'],
                'month' => Carbon::parse($item['date'])->format('F'),
                'monthShort' => Carbon::parse($item['date'])->format('M'),
                'dateOnly' => Carbon::parse($item['date'])->format('d'),
            ])
            ->sortBy('date')
            ->groupBy('month');
 
        return view('livewire.holiday', [
            'holidays' => $holidays->all()
        ]);
    }
}
