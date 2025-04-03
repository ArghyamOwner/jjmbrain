<div>
    <x-slot name="title">{{ $name }}</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                {{ $name }}
            </x-slot>

            <x-slot:action>
                <x-button color="indigo" tag="a" href="{{ route('stocks') }}">View All Stocks</x-button>
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden card-classes="mb-5">
            <div class="md:flex">
                <div class="flex-1">
                    <div class="flex flex-col md:flex-row md:items-center relative">
                        <div class="flex-1">
                            <x-heading size="lg" class="mb-1">{{ $name }}</x-heading>
                            <p>Contact Person: {{ Str::title($contact_person) }}</p>
                            <p>Phone: {{ $phone }}</p>
                        </div>
                    </div>
                </div>
                <div>
                    @if ($nabl_certification_expiry)
                        <span class="text-md font-semibold">
                            NABL Certificate Expired on:
                        </span>
                        <p class="text-sm font-bold text-red-500">
                            {{ $nabl_certification_expiry }}</p>
                    @endif
                </div>
            </div>
        </x-card>

        <div class="mt-5">
            <x-card no-padding overflow-hidden>
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="md">Incoming Stocks</x-heading>
                </x-slot>
                @if ($incomingStocks->isNotEmpty())
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>Item Name</x-table.thead>
                                <x-table.thead>Lab Name</x-table.thead>
                                <x-table.thead>Quantity</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($incomingStocks as $data)
                                <tr>
                                    <x-table.tdata>
                                        {{ $data->item->item_name }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $data->destinationLab->lab_name }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $data->quantity }}
                                    </x-table.tdata>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                @else
                    <x-card-empty>No Incoming Stock</x-card-empty>
                @endif
            </x-card>
        </div>

        <div class="mt-5">
            <x-card no-padding overflow-hidden>
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="md">Outgoing Stocks</x-heading>
                </x-slot>
                @if ($outgoingStocks->isNotEmpty())
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>Item Name</x-table.thead>
                                <x-table.thead>Lab Name</x-table.thead>
                                <x-table.thead>Quantity</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($outgoingStocks as $data)
                                <tr>
                                    <x-table.tdata>
                                        {{ $data->item->item_name }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $data->sourceLab->lab_name }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $data->quantity }}
                                    </x-table.tdata>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                @else
                    <x-card-empty>No Outgoing Stock</x-card-empty>
                @endif
            </x-card>
        </div>
    </x-section-centered>
</div>
