<div>
    <div class="flex justify-between items-center space-x-2 mb-1">
        <x-heading size="md" class="mb-1">Holidays &amp; Events</x-heading>
        <div class="px-4">
            <x-text-link href="{{ route('holidays') }}" class="text-sm">View all</x-text-link>
        </div>
    </div>
    
    <x-card no-padding overflow-hidden>
        <div class="px-3 py-2 flex space-x-2 items-center">
            <div class="flex-1">
                <x-select no-margin name="month" wire:model="month" class="py-1.5">
                    <option value="all">--Select month--</option>
                    @foreach($this->calendar['months'] as $calendar)
                        <option value="{{ $calendar['month'] }}">{{ $calendar['year'] }}</option>
                    @endforeach
                </x-select>
            </div>
            <x-button color="white" tag="a" href="{{ route('meetings.create') }}" with-icon icon="add" class="py-1.5">New meeting</x-button>
        </div>

        <div class="-mx-px -mb-px">
            <table class="w-full border-collapse">
                <thead>
                    <tr>
                        <th class="bg-slate-50 text-sm border px-1.5 py-1 font-medium text-slate-600">Sun</th>
                        <th class="bg-slate-50 text-sm border px-3 py-1 font-medium text-slate-600">Mon</th>
                        <th class="bg-slate-50 text-sm border px-3 py-1 font-medium text-slate-600">Tue</th>
                        <th class="bg-slate-50 text-sm border px-3 py-1 font-medium text-slate-600">Wed</th>
                        <th class="bg-slate-50 text-sm border px-3 py-1 font-medium text-slate-600">Thu</th>
                        <th class="bg-slate-50 text-sm border px-3 py-1 font-medium text-slate-600">Fri</th>
                        <th class="bg-slate-50 text-sm border px-3 py-1 font-medium text-slate-600">Sat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->calendar['weeks'] as $days)
                        <tr>
                            @foreach ($days as $day)
                                <td class="border p-1 text-slate-600" style="width: 14.28%">
                                    <div class="px-1 pt-1 pb-2 relative text-sm">
                                        <div
                                            @class([
                                                'hidden' => ! $day['withinMonth']
                                            ])
                                        >
                                            <span 
                                                @class([
                                                    'bg-indigo-500 text-white rounded-full w-6 h-6 inline-block py-0.5 px-1 font-medium text-center' => $day['isToday']
                                                ])
                                            >{{ $day['day'] }}</span>

                                            @if ($day['isBirthDay'])
                                                <div x-data="{ tooltip: 'Happy Birthday {{ auth()->user()->name }}!'}" x-cloak
                                                    x-tooltip="tooltip" class="absolute top-0 flex items-end right-0 text-center">
                                                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#d41c1c" viewBox="0 0 256 256"><path d="M232,112a24,24,0,0,0-24-24H136V79a32.06,32.06,0,0,0,24-31c0-28-26.44-45.91-27.56-46.66a8,8,0,0,0-8.88,0C122.44,2.09,96,20,96,48a32.06,32.06,0,0,0,24,31v9H48a24,24,0,0,0-24,24v23.33a40.84,40.84,0,0,0,8,24.24V200a24,24,0,0,0,24,24H200a24,24,0,0,0,24-24V159.57a40.84,40.84,0,0,0,8-24.24ZM112,48c0-13.57,10-24.46,16-29.79,6,5.33,16,16.22,16,29.79a16,16,0,0,1-32,0ZM40,112a8,8,0,0,1,8-8H208a8,8,0,0,1,8,8v23.33c0,13.25-10.46,24.31-23.32,24.66A24,24,0,0,1,168,136a8,8,0,0,0-16,0,24,24,0,0,1-48,0,8,8,0,0,0-16,0,24,24,0,0,1-24.68,24C50.46,159.64,40,148.58,40,135.33Zm160,96H56a8,8,0,0,1-8-8V172.56A38.77,38.77,0,0,0,62.88,176a39.69,39.69,0,0,0,29-11.31A40.36,40.36,0,0,0,96,160a40,40,0,0,0,64,0,40.36,40.36,0,0,0,4.13,4.67A39.67,39.67,0,0,0,192,176c.38,0,.76,0,1.14,0A38.77,38.77,0,0,0,208,172.56V200A8,8,0,0,1,200,208Z"></path></svg>
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div class="absolute left-0 right-0 bottom-0 flex items-center w-8 mx-auto justify-center">
                                            @forelse($events as $event)
                                                <div x-data="{ tooltip: '{{ $event['name'] }}' }">
                                                    @if ($day['formatted'] == $event['date']) 
                                                        @if($event['type'] === 'meeting')
                                                            <div x-tooltip="tooltip" x-cloak class="mr-0.5 h-1.5 w-1.5 bg-blue-600 rounded-full"></div> 
                                                        @elseif($event['type'] === 'Restricted Holiday')
                                                            <div x-tooltip="tooltip" x-cloak class="mr-0.5 h-1.5 w-1.5 bg-yellow-500 rounded-full"></div>
                                                        @else
                                                            <div x-tooltip="tooltip" x-cloak class="mr-0.5 h-1.5 w-1.5 bg-red-600 rounded-full"></div> 
                                                        @endif
                                                    @else
                                                    @endif
                                                </div>
                                            @empty
                                            @endforelse
                                        </div>
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-card>
    
    <div class="flex space-x-2 mt-2 justify-end">
        <div class="flex space-x-1 items-center">
            <div class="h-1.5 w-1.5 bg-blue-600 rounded-full"></div> 
            <div class="text-xs">Meetings</div>
        </div>
        <div class="flex space-x-1 items-center">
            <div class="h-1.5 w-1.5 bg-yellow-500 rounded-full"></div> 
            <div class="text-xs">Restricted Holidays</div>
        </div>
        <div class="flex space-x-1 items-center">
            <div class="h-1.5 w-1.5 bg-red-600 rounded-full"></div> 
            <div class="text-xs">Holidays</div>
        </div>
    </div>

    <div class="space-y-2 mt-4">
        @forelse($events as $event)
            @if($event['type'] === 'meeting')
                <x-alertbox class="text-sm !pt-1 !pb-1.5 !pl-6">
                    <div class="flex items-center flex-wrap">
                        <div class="shrink-0 border rounded-lg w-10 mr-4">
                            <div class="font-bold text-center text-slate-800 text-md border-b px-1">{{ $event['dateOnly'] }}</div>
                            <div class="p-0.5 text-center text-xs text-slate-500 uppercase tracking-wide">{{ $event['month'] }}</div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="text-xs text-slate-600">{{ Str::title($event['type']) }} at {{ $event['time'] }}</div>
                            <div class="font-medium text-blue-700 truncate">{{ $event['name'] }}</div>
                            <div class="text-xs text-slate-500">{{ $event['venue'] }}</div>
                        </div>
                    </div>
                </x-alertbox>
            @elseif($event['type'] === 'Restricted Holiday')
                <x-alertbox variant="warning" class="text-sm !pt-1 !pb-1.5 !pl-6">
                    <div class="flex items-center flex-wrap">
                        <div class="shrink-0 border rounded-lg w-10 mr-4">
                            <div class="font-bold text-center text-slate-800 text-md border-b px-1">{{ $event['dateOnly'] }}</div>
                            <div class="p-0.5 text-center text-xs text-slate-500 uppercase tracking-wide">{{ $event['month'] }}</div>
                        </div>
                        <div class="flex-1 w-full">
                            <div class="text-xs text-slate-600">{{ Str::title($event['type']) }}</div>
                            <div>{{ $event['name'] }}</div>
                        </div>
                    </div>
                </x-alertbox>
            @else
                <x-alertbox variant="error" class="text-sm !pt-1 !pb-1.5 !pl-6">
                    <div class="flex items-center flex-wrap">
                        <div class="shrink-0 border rounded-lg w-10 mr-4">
                            <div class="font-bold text-center text-slate-800 text-md border-b px-1">{{ $event['dateOnly'] }}</div>
                            <div class="p-0.5 text-center text-xs text-slate-500 uppercase tracking-wide">{{ $event['month'] }}</div>
                        </div>
                        <div class="flex-1">
                            <div class="text-xs text-slate-600">{{ Str::title($event['type']) }}</div>
                            <div>{{ $event['name'] }}</div>
                        </div>
                    </div>
                </x-alertbox>
            @endif
        @empty
            <x-card-empty />
        @endforelse
    </div>
</div>