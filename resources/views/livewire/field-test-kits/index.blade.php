<div>
    <x-slot name="title">All FTK's</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                FTK's
    </x-slot>

    <x-slot name="action">
        <x-button tag="a" href="{{ route('fieldtestkits.create') }}" with-icon icon="add">New FTK</x-button>
    </x-slot>
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding overflow-hidden class="mt-5">
            
            @if ($fieldtestkits->isNotEmpty())
                <div>
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>Division</x-table.thead>
                                <x-table.thead>Village</x-table.thead>
                                <x-table.thead>Assigned Person Name / Phone</x-table.thead>
                                <x-table.thead>Brand Name</x-table.thead>
                                <x-table.thead>Issue Date</x-table.thead>
                                <x-table.thead>Actions</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fieldtestkits as $fieldtestkit)
                                <tr>
                                    <x-table.tdata>
                                            {{ $fieldtestkit->division?->name }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $fieldtestkit->village?->village_name }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $fieldtestkit->assigned_person_name }}
                                        <p class="text-sm">{{ $fieldtestkit->assigned_person_phone }}</p>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $fieldtestkit->brand_name }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $fieldtestkit->issue_date }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <x-button-icon-edit href="{{ route('fieldtestkits.edit', $fieldtestkit->id) }}" />
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

        @if ($fieldtestkits->hasPages())
            <div class="mt-5">{{ $fieldtestkits->links() }}</div>
        @endif
    </x-section-centered>
</div>
