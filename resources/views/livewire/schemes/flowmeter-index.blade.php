<div>
    <x-card no-padding overflow-hidden>


        @if ($flowmeterDetails->isNotEmpty())
        <div>
            <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                <thead>
                    <tr>
                        <x-table.thead>Value</x-table.thead>
                        <x-table.thead>Updated By</x-table.thead>
                        <x-table.thead>Updated At</x-table.thead>
                        <x-table.thead>Action</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($flowmeterDetails as $fmDetails)
                    <tr class="{{ $fmDetails->reset_point ? 'bg-red-100' : '' }}">
                        <x-table.tdata>
                            {{ $fmDetails->value }}
                            @if($fmDetails->reset_point)
                                <p>
                                    Reset By : {{ $fmDetails->flowmeterResetData?->createdBy?->name }}
                                </p>
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $fmDetails?->createdBy?->name }}
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $fmDetails->created_at->format('d-m-Y') }}
                        </x-table.tdata>
                        <x-table.tdata>
                            <div class="flex space-x-1">
                                @if ($loop->last && $showFlowmeterDeleteButton)

                                <x-button-icon-delete href="#" x-data="" x-cloak x-on:click.prevent="$wire.emitTo(
                                    'scheme-flowmeter.delete',
                                    'showDeleteModal',
                                    '{{ $fmDetails->id }}',
                                    'Confirm Deletion',
                                    'Are you sure you want to remove this Flowmeter Reading?',
                                    '{{ $fmDetails->value }}'
                                )" />

                                <x-button-icon-reset href="#" x-data="{ tooltip: 'Reset' }" x-tooltip="tooltip" x-cloak
                                    x-on:click.prevent="$wire.emitTo(
                                            'scheme-flowmeter.reset',
                                            'showDeleteModal',
                                            '{{ $fmDetails->id }}',
                                            'Confirm Reset',
                                            'Are you sure you want to reset this flowmeter?',
                                            '{{ $fmDetails->value }}',
                                            'Yes, Reset'
                                        )" />
                                @else
                                -
                                @endif
                            </div>
                        </x-table.tdata>
                    </tr>
                    @endforeach
                </tbody>
            </x-table.table>
        </div>
        @else
        <x-card-empty variant="">
            <p class="text-center text-slate-500 mb-3 text-sm">No details found.</p>
        </x-card-empty>
        @endif
    </x-card>
    <livewire:scheme-flowmeter.delete />
    <livewire:scheme-flowmeter.reset />
</div>