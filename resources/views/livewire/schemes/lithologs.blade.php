<div>
    <x-card no-padding overflow-hidden>
        @if($lithologs->isNotEmpty() || ($lithologs->isEmpty() && $search))
        <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
            <div class="md:col-span-2">
                <x-input-search no-margin name="search" wire:model.debounce.500ms="search"
                    placeholder="Search Well Id..." />
            </div>
        </div>
        @endif

        @if($lithologs->isNotEmpty())
        <div>
            <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                <thead>
                    <tr>
                        <x-table.thead>Well Id</x-table.thead>
                        <x-table.thead>Starting Date</x-table.thead>
                        <x-table.thead>Drilling Type</x-table.thead>
                        <x-table.thead>Driller Details</x-table.thead>
                        <x-table.thead>Drill Vehicle Number</x-table.thead>
                        <x-table.thead>Hole Diameter</x-table.thead>
                        <x-table.thead>Casing Size</x-table.thead>
                        <x-table.thead>Compressor Capacity</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lithologs as $litho)
                    <tr>
                        <x-table.tdata>
                            <x-text-link href="{{ route('lithologs.show', $litho->id) }}">
                                {{ $litho->well_id }}
                            </x-text-link>
                        </x-table.tdata>
                        <x-table.tdata>
                            @date($litho?->starting_date)
                        </x-table.tdata>
                        <x-table.tdata class="capitalize">
                            {{ $litho->drilling_type ?? '-' }}
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $litho->driller_name }}
                            <p>{{ $litho->driller_phone }}</p>
                        </x-table.tdata>
                        <x-table.tdata class="uppercase">
                            {{ $litho->drill_vehicle_number }}
                        </x-table.tdata>
                        <x-table.tdata class="uppercase">
                            {{ $litho->hole_diameter }}
                        </x-table.tdata>
                        <x-table.tdata class="uppercase">
                            {{ $litho->casing_size }}
                        </x-table.tdata>
                        <x-table.tdata class="uppercase">
                            {{ $litho->compressor_capacity }}
                        </x-table.tdata>
                        {{-- <x-table.tdata>
                            <div class="flex space-x-1">
                                <x-button-icon-edit href="{{ route('beneficiaries.edit', $litho->id) }}" />
                                <x-button-icon-delete href="#" x-data="" x-cloak x-on:click.prevent="$wire.emitTo(
                                                'beneficiaries.delete',
                                                'showDeleteModal',
                                                '{{ $litho->id }}',
                                                'Confirm Deletion',
                                                'Are you sure you want to remove this beneficiary?',
                                                '{{ $litho->beneficiary_name }}'
                                            )" />
                            </div>
                        </x-table.tdata> --}}
                    </tr>
                    @endforeach
                </tbody>
            </x-table.table>
        </div>
        @else
        <x-card-empty variant="">
            <p class="text-center text-slate-500 mb-3 text-sm">No Litholog details found.</p>
            {{-- <x-button tag="a" href="{{ route('schemes.beneficiaryCreate', $schemeId) }}" with-icon icon="add">Add New
                Beneficiary</x-button> --}}
        </x-card-empty>
        @endif
    </x-card>

    @if ($lithologs->hasPages())
    <div class="mt-5">{{ $lithologs->links() }}</div>
    @endif

    {{--
    <livewire:beneficiaries.delete /> --}}
</div>