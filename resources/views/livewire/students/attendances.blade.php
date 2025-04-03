<div>
    <x-slot name="title">Attendances</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('students') }}">Back to students</x-text-link>
            </x-slot>

            <x-slot:title>
                {{ $studentName }} <span class="font-normal">Attendances</span>
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding overflow-hidden>
            <div class="p-3 grid grid-cols-1 md:grid-cols-6 gap-4 items-center">
                <x-select no-margin name="month" wire:model="month">
                    <option value="all">--Select month--</option>
                    @foreach($this->calendar['months'] as $calendarMonthKey => $calendarMonthValue)
                    <option value="{{ $calendarMonthKey }}">{{ $calendarMonthValue }}</option>
                    @endforeach
                </x-select>
            </div>
 
            <div class="-mx-px -mb-px">
                <table class="w-full border-collapse">
                    <thead>
                        <tr>
                            <th class="bg-slate-50 text-sm border px-1.5 py-2 font-medium text-slate-600">Sun</th>
                            <th class="bg-slate-50 text-sm border px-3 py-2 font-medium text-slate-600">Mon</th>
                            <th class="bg-slate-50 text-sm border px-3 py-2 font-medium text-slate-600">Tue</th>
                            <th class="bg-slate-50 text-sm border px-3 py-2 font-medium text-slate-600">Wed</th>
                            <th class="bg-slate-50 text-sm border px-3 py-2 font-medium text-slate-600">Thu</th>
                            <th class="bg-slate-50 text-sm border px-3 py-2 font-medium text-slate-600">Fri</th>
                            <th class="bg-slate-50 text-sm border px-3 py-2 font-medium text-slate-600">Sat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($this->calendar['weeks'] as $days)
                            <tr>
                                @foreach ($days as $day)
                                    <td class="border p-1 text-slate-600" style="width: 14.28%">
                                        <div class="p-2 h-24 rounded relative">
                                            <div
                                                class="{{ ! $day['withinMonth'] ? 'hidden' : '' }}"
                                            >{{ $day['day'] }}</div>
 
                                            @forelse($attendances as $attendance)
                                                @if ($day['formatted'] == $attendance->date->format('Y-m-d'))
                                                    <div class="mx-auto font-bold text-center text-sm p-2 rounded-lg {{ $attendance->status->color() }}">{{ $attendance->status }}</div>  
                                                @endif
                                            @empty
                                            @endforelse
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
 
        </x-card>
    </x-section-centered>
</div>