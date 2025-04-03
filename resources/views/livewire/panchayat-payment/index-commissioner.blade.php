<div>
    <x-slot name="title">Report O&M</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Report O&M
    </x-slot>
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        <x-card no-padding overflow-hidden>

            <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
                <x-select no-margin name="year" wire:model="year">
                    <option value="all">--Select Year--</option>
                    @foreach (range(date('Y'), 2023) as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </x-select>

                <x-select no-margin name="month" wire:model="month">
                    <option value="all">--Select Month--</option>
                    @foreach ($this->months as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </x-select>
                <div></div>
                <div></div>
                <div></div>
                <div class="text-right">
                    <x-button type="button" color="cyan" wire:click="export" wire:target="export" with-spinner>Export</x-button>
                </div>
            </div>

            @if ($districts->isNotEmpty())
            <div>
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>District</x-table.thead>
                            <x-table.thead>Schemes</x-table.thead>
                            <x-table.thead>Handover Schemes</x-table.thead>
                            <x-table.thead>Jalmitra Payment</x-table.thead>
                            <x-table.thead>Electricity Payment</x-table.thead>
                            <x-table.thead>Chemical Payment</x-table.thead>
                            <x-table.thead>Maintenance Payment</x-table.thead>
                            <x-table.thead>Other Payment</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($districts as $result)
                        <tr>
                            <x-table.tdata>
                                <x-text-link href="{{ route('panchayatPayments',['district' => $result->id]) }}">
                                    {{ $result->name }}
                                </x-text-link>
                            </x-table.tdata>
                            <x-table.tdata>
                                {{-- {{ $result->schemes_count }} --}}
                                {{ $result->parent_schemes_count }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $result->parent_handover_schemes_count }}
                                {{-- {{ $result->handover_schemes_count }} --}}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $result->jalmitraPanchayatPayments }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $result->electricalPanchayatPayments }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $result->chemicalPanchayatPayments }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $result->maintenancePanchayatPayments }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $result->otherPanchayatPayments }}
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
    </x-section-centered>
</div>