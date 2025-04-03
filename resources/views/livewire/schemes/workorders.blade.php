<div>
    <x-card no-padding overflow-hidden>
        {{-- <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
            <div class="md:col-span-2">
                <x-input-search no-margin name="search" wire:model.debounce.500ms="search" placeholder="Search..." />
            </div>
        </div> --}}

        @if($workorders)
        <div>
            <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                <thead>
                    <tr>
                        <x-table.thead>Date</x-table.thead>
                        <x-table.thead>Office</x-table.thead>
                        <x-table.thead>WO Number</x-table.thead>
                        <x-table.thead>Amount</x-table.thead>
                        <x-table.thead>PG Status</x-table.thead>
                        <x-table.thead>Contractor Name</x-table.thead>
                        <x-table.thead>Type</x-table.thead>
                        <x-table.thead>Action</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach($workorders as $workorder)
                    <tr>
                        <x-table.tdata>
                            @date($workorder->created_at)
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $workorder?->circle?->name ?? '-'}}
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $workorder->workorder_number }}
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $workorder->workorder_amount ? Str::money($workorder->workorder_amount) : '-' }}
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $workorder->pg_percentage ?? 0 }}%
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $workorder?->contractor?->name }}
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-badge variant="{{ $workorder->workorder_type->color() }}">{{ $workorder->workorder_type
                                }}</x-badge>
                        </x-table.tdata>
                        <x-table.tdata>
                            <div class="flex space-x-1">
                                @if ($unassignOption)
                                <a class="text-red-500 hover:underline mt-1" href="#"
                                    onclick="confirm('Are you sure you want to unassign the Workorder ?') || event.stopImmediatePropagation()"
                                    wire:click.prevent="removeWorkorder('{{ $workorder->id }}')">
                                    Remove
                                </a>
                                @endif
                                <x-button-icon-show href="{{ route('workorders.show', $workorder->id) }}" />
                                <x-text-link href="{{ route('workorders.progress', $workorder->id) }}">
                                    <x-icon-chart
                                        class="w-5 h-5 rounded-lg hover:bg-gray-100 text-slate-400 hover:text-slate-500 flex items-center justify-center"
                                        x-data="{ tooltip: 'Progress' }" x-tooltip="tooltip" x-cloak />
                                </x-text-link>
                            </div>
                        </x-table.tdata>
                    </tr>
                    @endforeach
                </tbody>
            </x-table.table>
        </div>
        @else
        <x-card-empty class="shadow-none" />
        @endif
    </x-card>
</div>