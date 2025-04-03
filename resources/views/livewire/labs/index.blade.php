<div>
    <x-slot name="title">Labs</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Labs
            </x-slot>

            <x-slot:action>
                <x-button with-icon icon="add" tag="a" href="{{ route('labs.create') }}">New Lab</x-button>
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding overflow-hidden>
            @if ($labs->isNotEmpty() || ($labs->isEmpty() && $search))
                <div class="px-4 py-3 border-b">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search" placeholder="Search..." />
                </div>
            @endif

            @if ($labs->isNotEmpty())
                <x-table.table :table-condensed="true" :rounded="false">
                    <thead>
                        <tr>
                            <x-table.thead>Office/Circle</x-table.thead>
                            <x-table.thead>Lab Name</x-table.thead>
                            <x-table.thead>Contact Person</x-table.thead>
                            <x-table.thead>Phone</x-table.thead>
                            <x-table.thead>NABL Certification / Expiry On</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($labs as $lab)
                            <tr>
                                <x-table.tdata>
                                    {{ $lab?->circle?->name ?? '-' }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $lab->lab_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $lab->contact_person }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $lab->phone }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $lab->nabl_certification }}
                                    @if ($lab->nabl_certification_expiry)
                                        <p class="text-sm font-bold text-red-500">{{ $lab->nabl_certification_expiry->format('d/m/Y') }}</p>
                                    @endif
                                </x-table.tdata>
                                <x-table.tdata>
                                    <x-button-icon-edit href="{{ route('labs.edit', $lab->id) }}" />
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            @else
                <x-card-empty class="shadow-none rounded-none" />
            @endif
        </x-card>

        @if ($labs->hasPages())
            <div class="mt-5">{{ $labs->links() }}</div>
        @endif
    </x-section-centered>
</div>
