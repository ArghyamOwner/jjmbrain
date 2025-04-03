<div>
    <x-slot name="title">Stock Transfer</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>

            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('labDashboard') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Stock Transfer
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        @if ($transfers->isNotEmpty())
            <x-card no-padding overflow-hidden>
                <x-heading size="md" class="p-2">Stock Transfer</x-heading>

                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Date</x-table.thead>
                            <x-table.thead>Item Name</x-table.thead>
                            <x-table.thead>Source Lab Name</x-table.thead>
                            <x-table.thead>Destination Lab Name</x-table.thead>
                            <x-table.thead>Quantity</x-table.thead>
                            <x-table.thead>Status</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transfers as $transfer)
                            <tr>
                                <x-table.tdata>
                                    @date($transfer->created_at)
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $transfer->item->item_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $transfer->sourceLab->lab_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $transfer->destinationLab->lab_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $transfer->quantity }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    @if ($transfer->acceptedBy)
                                        Accepted by {{ $transfer->acceptedBy?->name }}
                                        <p class="text-sm">on @date($transfer->updated_at)</p>
                                    @else
                                        <span>Pending</span>
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
    </x-section-centered>
</div>
