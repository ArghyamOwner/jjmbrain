<?php

namespace App\Http\Livewire\Meetings;

use Carbon\Carbon;
use App\Models\Meeting;
use Livewire\Component;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\File;

class Calendar extends Component
{
    public $year;
    public $month;
    
    public function mount()
    {
        $this->year = date('Y');
        $this->month = date('m');
    }

    public function getUserProperty()
    {
        return auth()->user();
    }

    public function getCalendarProperty()
    {
        $selectedDate = CarbonImmutable::create($this->year, $this->month);
        $startOfMonth = $selectedDate->startOfMonth();
        $endOfMonth = $selectedDate->endOfMonth();
        $startOfWeek = $startOfMonth->startOfWeek(Carbon::SUNDAY);
        $endOfWeek = $endOfMonth->endOfWeek(Carbon::SATURDAY);

        return [
            'year' => $this->year,
            'weeks' => collect(
                    $startOfWeek->toPeriod($endOfWeek)->toArray()
                )->map(fn ($date) => [
                    'formatted' => $date->format('Y-m-d'),
                    'date' => $date->format('d'),
                    'shortMonth' => $date->format('M'),
                    'shortDay' => $date->format('D'),
                    'day' => $date->day,
                    'isToday' => $date->day == date('d'),
                    'isBirthDay' => $date->format('d-m') == $this->user->dob?->format('d-m'),
                    'withinMonth' => $date->between($startOfMonth, $endOfMonth),
                ])->chunk(7),
            'months' => collect(range(1, 12))
                ->flatMap(fn ($month) => [
                    [
                        "month" => sprintf("%02d", $month),
                        "year" => CarbonImmutable::create($this->year, $month)->startOfMonth()->format('F Y')
                    ]
                ])->all(),
        ];
    }

    public function render()
    {
        $startDate = CarbonImmutable::create($this->year, $this->month)->startOfMonth();
        $endDate = CarbonImmutable::create($this->year, $this->month)->endOfMonth();

        $holidayListsJson = File::json(public_path('holidays.json'));

        $holidays = collect($holidayListsJson)->filter(function ($item) use ($startDate, $endDate) {
                return Carbon::parse($item['date']) >= $startDate && Carbon::parse($item['date']) <= $endDate;
            })
            ->map(fn($item) => [
                'date_formatted' => $item['date'],
                'date' => Carbon::parse($item['date'])->format('Y-m-d'),
                'name' => $item['name'],
                'type' => $item['type'],
                'month' => Carbon::parse($item['date'])->format('M'),
                'dateOnly' => Carbon::parse($item['date'])->format('d'),
            ])
            ->values();

        $meetings = Meeting::query()
            ->whereBetween('date_time', [$startDate, $endDate])
            ->get()
            ->map(fn($meeting) => [
                'date_formatted' => $meeting['date_time']->format('F j, Y'),
                'date' => $meeting['date_time']->format('Y-m-d'),
                'name' => $meeting['title'],
                'venue' => $meeting['venue'],
                'time' => $meeting['date_time']->format('h:i a'),
                'type' => 'meeting',
                'month' => $meeting['date_time']->format('M'),
                'dateOnly' => $meeting['date_time']->format('d'),
            ]);
 
        return view('livewire.meetings.calendar', [
            'events' => $holidays->merge($meetings)->sortBy('date')->values()
        ]);
    }
}
