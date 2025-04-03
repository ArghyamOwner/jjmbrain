<div>
    <x-card>
        <div class="flex flex-col md:flex-row md:space-x-4 space-y-2">
            <div class="flex-1  grid grid-cols-2">
                <div class="col-span-1 md:col-span-1 px-4 py-2 border-r">
                    <div class="font-semibold text-gray-500 text-sm truncate">Number of Labs</div>
                    <div class="text-gray-800 font-bold text-lg">{{ $counts->total_labs ?? 'N/A' }}</div>
                </div>

                <div class="col-span-1 md:col-span-1 px-4 py-2">
                    <div class="font-semibold text-gray-500 text-sm truncate">Pending Samples</div>
                    <div class="text-gray-800 font-bold text-lg">-</div>
                </div>

                <div class="col-span-1 px-4 py-2 md:col-span-1 border-r border-t">
                    <div class="font-semibold text-gray-500 text-sm truncate">Water Sample Tested</div>
                    <div class="text-gray-800 font-bold text-lg">-</div>
                </div>

                <div class="col-span-1 px-4 py-2 md:col-span-1 border-t">
                    <div class="font-semibold text-gray-500 text-sm truncate">Total On-Process</div>
                    <div class="text-gray-800 font-bold text-lg">-</div>
                </div>

            </div>
            <div class="w-full md:w-64">
                <img loading="lazy" src="https://sumatoimg.nyc3.digitaloceanspaces.com/jjm/uploads/lab-jjm.png"
                    class="object-contain h-32 mx-auto" />
            </div>
        </div>
    </x-card>

    <div class="mt-5">
        @if ($stocks->isNotEmpty())
            <x-card no-padding overflow-hidden>
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="md">Stock Alert</x-heading>
                </x-slot>

                <x-slot:action>
                    <x-button tag="a" color="white" href="{{ route('stocks.alert') }}"
                        class="py-1 text-indigo-600">View All</x-button>
                </x-slot>

                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Item Name</x-table.thead>
                            <x-table.thead>Lab Name</x-table.thead>
                            <x-table.thead>Current Stock</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stocks as $stock)
                            <tr>
                                <x-table.tdata>
                                    {{ $stock->item->item_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $stock->lab->lab_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $stock->quantity }}
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>

            </x-card>
        @else
            <x-card-empty />
        @endif
    </div>

    <div class="mt-5">
        @if ($transfers->isNotEmpty())
            <x-card no-padding overflow-hidden>
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="md">Latest Transfer</x-heading>
                </x-slot>

                <x-slot:action>
                    <x-button tag="a" color="white" href="{{ route('stocksTransfer.show') }}"
                        class="py-1 text-indigo-600">View All</x-button>
                </x-slot>

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
    </div>
</div>
