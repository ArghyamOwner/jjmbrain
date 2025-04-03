<div>
    <x-card no-padding overflow-hidden>
        @if ($floodinfoscheme->isNotEmpty() || ($floodinfoscheme->isEmpty() && $search))
            <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
                <div class="md:col-span-5">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search"
                        placeholder="Search Flood Info" />
                </div>
                <div class="md:col-span-1">
                    <x-button tag="a" color="red" href="{{ route('schemes.floodInfoCreate', $schemeId) }}"
                        with-icon icon="add">Add New Flood Info
                    </x-button>
                </div>
            </div>
        @endif
        @if ($floodinfoscheme->isNotEmpty())
            <div>
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Inundation Start Date</x-table.thead>
                            <x-table.thead>Water Stagnation Period (in days)</x-table.thead>
                            <x-table.thead>Inundated Infrastructure</x-table.thead>
                            <x-table.thead>Severity</x-table.thead>
                            <x-table.thead>Partial Damage</x-table.thead>
                            <x-table.thead>Approx Inundation Height (in Meter)</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($floodinfoscheme as $floodInfo)
                            <tr>
                                <x-table.tdata>
                                    {{ $floodInfo->start_date }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $floodInfo->water_stagnation_period }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <x-readmore content="{{ $floodInfo->inundated_infrastructure ?? '-' }}"
                                        limit="15" link-class="text-indigo-600 underline whitespace-normal" />
                                </x-table.tdata>
                                <x-table.tdata>
                                    @if (Str::lower($floodInfo->severity) == 'high')
                                        <x-badge variant="danger">{{ $floodInfo->severity }}</x-badge>
                                    @elseif (Str::lower($floodInfo->severity) == 'medium')
                                        <x-badge variant="warning">{{ $floodInfo->severity }}</x-badge>
                                    @else
                                        <x-badge variant="success">{{ $floodInfo->severity }}</x-badge>
                                    @endif
                                </x-table.tdata>
                                <x-table.tdata>
                                    <span class="uppercase"> {{ $floodInfo->partial_damage }}</span>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $floodInfo->approx_inundation_height }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <div class="flex space-x-1">
                                        {{-- <x-button-icon-edit href="{{ route('schemes.floodInfoCreate', $schemeId) }}" /> --}}
                                        <x-button-icon-delete href="#" x-data="" x-cloak
                                            x-on:click.prevent="$wire.emitTo(
                                                'flood.delete',
                                                'showDeleteModal',
                                                '{{ $floodInfo->id }}',
                                                'Confirm Deletion',
                                                'Are you sure you want to remove this Flood Info?',
                                           )" />
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </div>
        @else
            <x-card-empty variant="">
                <p class="text-center text-slate-500 mb-3 text-sm">No Flood Info found.</p>
                <x-button tag="a" href="{{ route('schemes.floodInfoCreate', $schemeId) }}" with-icon
                    icon="add">Add New Flood Info</x-button>
            </x-card-empty>
        @endif
    </x-card>
    @if ($floodinfoscheme->hasPages())
        <div class="mt-5">{{ $floodinfoscheme->links() }}</div>
    @endif
    {{-- <livewire:assets.delete /> --}}
    <livewire:flood.delete />
</div>
