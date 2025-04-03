<div>
    <x-slot name="title">Attendances</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Attendances
            </x-slot>

            {{-- <x-slot name="action">
                <x-button tag="a" href="#" with-icon icon="add">Take attendance</x-button>    
            </x-slot> --}}
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding overflow-hidden>
            <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4 items-center">
                <div class="leading-none">
                    <div class="text-sm">
                        Total: <strong>{{ count($students) }}</strong> {{ Str::plural('Student', count($students)) }}
                    </div>
                </div>
                <div class="md:col-span-2">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search" placeholder="Search student..." />
                </div>
                <x-select no-margin name="month" wire:model="month">
                    <option value="all">--Select month--</option>
                    @foreach($this->months['months'] as $calendarMonthKey => $calendarMonthValue)
                    <option value="{{ $calendarMonthKey }}">{{ $calendarMonthValue }}</option>
                    @endforeach
                </x-select>
                <x-select no-margin name="grade" wire:model="grade">
                    <option value="all">--Select Class--</option>
                    @foreach($this->classes as $classKey => $classValue)
                    <option value="{{ $classKey }}">Grade {{ $classValue }}</option>
                    @endforeach
                </x-select>
            </div>
        
            @if($students->isNotEmpty())
                <x-table.table :rounded="false" table-bordered-full table-condensed table-sticky-first-column>
                    <thead>
                        <tr>
                            <x-table.thead class="!px-3">Student Name</x-table.thead>
                            
                            {{-- @foreach($monthDates as $monthDate)
                                <x-table.thead class="text-center">
                                    <div class="capitalize text-slate-400 font-normal">{{ now()->format('M') }}</div>
                                    <div class="font-bold">{{ sprintf("%02d", $monthDate) }}</div>
                                    <div class="capitalize text-slate-400 font-normal">{{ \Carbon\Carbon::parse(date('Y-m-'. $monthDate))->format('D') }}</div>
                                </x-table.thead>
                            @endforeach --}}

                            @foreach($this->months['dates'] as $monthDate)
                                <x-table.thead class="text-center">
                                    <div class="capitalize text-slate-400 font-normal">{{ $monthDate['shortMonth'] }}</div>
                                    <div class="font-bold">{{ $monthDate['date'] }}</div>
                                    <div class="capitalize text-slate-400 font-normal">{{ $monthDate['day'] }}</div>
                                </x-table.thead>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <x-table.tdata class="!px-3 text-sm w-32 truncate">
                                    <div class="flex">
                                        <div class="shrink-0 mr-3">
                                            <img src="{{ $student->photo_url }}" alt="student-photo" class="rounded-full" width="40px">
                                        </div>
                                        <div class="flex-1 truncate">
                                            <div class="font-semibold text-slate-700 block truncate">{{ $student->user->name }}</div>
                                            <div class="text-slate-500 text-sm">{{ $student->student_code }}</div>
                                        </div>
                                    </div>
                                </x-table.tdata>
  
                                {{-- @foreach($monthDates as $monthDate) --}}
                                @foreach(collect($this->months['dates'])->pluck('formatted') as $monthDate)
                                    <x-table.tdata>
                                        <div class="w-10">
                                            @forelse($student->attendances as $attendance)
                                                @if ($monthDate == $attendance->date->format('Y-m-d'))
                                                    <div class="mx-auto w-10 font-bold text-center text-sm p-2 rounded-lg {{ $attendance->status->color() }}">{{ $attendance->status->label() }}</div>  
                                                @endif
                                            @empty
                                                <div class="mx-auto w-10 text-center text-sm p-2 rounded-lg bg-slate-100 text-slate-400">&bull;</div>
                                            @endforelse
                                        </div>
                                    </x-table.tdata>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            @else 
                <x-card-empty class="shadow-none" />
            @endif
        </x-card>
    </x-section-centered>
</div>