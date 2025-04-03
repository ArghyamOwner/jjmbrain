<div>
    <x-slot name="title">All Logs</x-slot>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('grievanceDashboard') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Logs
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        {{-- <x-card card-classes="mb-6">
            <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
                Count : {{ $count }}
                <div class="md:col-span-2">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search" placeholder="Search..." />
                </div>
                <x-select no-margin name="division" wire:model="division">
                    <option value="all">Select a Division</option>
                    @foreach ($this->divisions as $divisionKey => $divisionName)
                        <option value="{{ $divisionKey }}">{{ $divisionName }}</option>
                    @endforeach
                </x-select>            
            </div>
        </x-card> --}}

        @if ($message)
            <x-card>
                {{ $message }}
            </x-card>
        @else
            @if (count($data))
                <x-card no-padding>
                    <x-table.table>
                        <thead>
                            <tr>
                                <x-table.thead>Caller</x-table.thead>
                                <x-table.thead>Recieved By | Duration</x-table.thead>
                                <x-table.thead>File</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $ticket)
                                <tr>
                                    <x-table.tdata>
                                        {{ $ticket['_source']['caller_number'] ?? '' }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        @if (isset($ticket['_source']['log_details']) && !empty($ticket['_source']['log_details']))
                                            @foreach ($ticket['_source']['log_details'] as $logDetails)
                                                @if (isset($logDetails['received_by']))
                                                    <span class="text-sm capitalize">
                                                        {{ $logDetails['action'] . ' By ' . $logDetails['received_by'][0]['name'] }}
                                                    </span>
                                                @endif
                                                <p class="text-sm">
                                                    {{ $logDetails['duration'] }}
                                                </p>
                                            @endforeach
                                        @else
                                            Missed
                                        @endif
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        @if (isset($ticket['_source']['fileurl']) && !empty($ticket['_source']['fileurl']))
                                            <x-text-link href="{{ $ticket['_source']['fileurl'] }}">
                                                Download Recording
                                            </x-text-link>
                                        @else
                                            -    
                                        @endif
                                    </x-table.tdata>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                </x-card>
            @else
                <x-card-empty />
            @endif
        @endif
    </x-section-centered>
</div>
