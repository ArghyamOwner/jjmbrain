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

            @if (count($payments))
            <div>
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Scheme</x-table.thead>
                            <x-table.thead>Consumer No</x-table.thead>
                            <x-table.thead>Total FHTC</x-table.thead>
                            <x-table.thead>Chemical</x-table.thead>
                            <x-table.thead>Electricity</x-table.thead>
                            <x-table.thead>Jalmitra Payment</x-table.thead>
                            <x-table.thead>Maintainance</x-table.thead>
                            <x-table.thead>Other</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $result)
                        <tr>
                            <x-table.tdata>
                                {{ $result['scheme'].' ('.$result['district'].' District)' }}
                                <p class="text-xs">Block : {{ $result['block'] }}</p>
                                <p class="text-xs">Panchayat : {{ $result['panchayat'] }}</p>
                                <p class="space-x-2">  
                                    <x-badge class="mb-2" variant="warning">{{ $result['work_status'] }}</x-badge>
                                    <x-badge class="mb-2" variant="info">{{ $result['operating_status'] }}</x-badge>
                                </p>
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $result['apdcl'] }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $result['fhtc'] }}
                            </x-table.tdata>
                            <x-table.tdata>
                                @if(!isset($result['Chemical_status']))
                                <x-icon-xclose class="text-red-600 w-5" />
                                @else
                                <span class="flex">
                                    <x-icon-check-circle class="text-green-600 w-5" />{{ $result['Chemical_status'] }}
                                </span>
                                <p class="ml-4">Rs. {{ $result['Chemical_amount'] }}</p>
                                @endif
                                {{-- {{ $result['Chemical'] }} --}}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{-- {{ $result['Electricity_Bill'] }} --}}
                                @if(!isset($result['Electricity_Bill_status']))
                                <x-icon-xclose class="text-red-600 w-5" />
                                @else
                                <span class="flex">
                                    <x-icon-check-circle class="text-green-600 w-5" />{{ $result['Electricity_Bill_status'] }}
                                </span>
                                <p class="ml-4">Rs. {{ $result['Electricity_Bill_amount'] }}</p>
                                @endif
                            </x-table.tdata>
                            <x-table.tdata>
                                {{-- {{ $result['Jalmitra_Salary'] }} --}}
                                @if(!isset($result['Jalmitra_Salary_status']))
                                <x-icon-xclose class="text-red-600 w-5" />
                                @else
                                <span class="flex">
                                    <x-icon-check-circle class="text-green-600 w-5" />{{ $result['Jalmitra_Salary_status'] }}
                                </span>
                                <p class="ml-4">Rs. {{ $result['Jalmitra_Salary_amount'] }}</p>
                                @endif
                            </x-table.tdata>
                            <x-table.tdata>
                                {{-- {{ $result['Jalmitra_Salary'] }} --}}
                                @if(!isset($result['Maintenance_status']))
                                <x-icon-xclose class="text-red-600 w-5" />
                                @else
                                <span class="flex">
                                    <x-icon-check-circle class="text-green-600 w-5" />{{ $result['Maintenance_status'] }}
                                </span>
                                <p class="ml-4">Rs. {{ $result['Maintenance_amount'] }}</p>
                                @endif
                            </x-table.tdata>
                            <x-table.tdata>
                                {{-- {{ $result['Jalmitra_Salary'] }} --}}
                                @if(!isset($result['Other_status']))
                                <x-icon-xclose class="text-red-600 w-5" />
                                @else
                                <span class="flex">
                                    <x-icon-check-circle class="text-green-600 w-5" />{{ $result['Other_status'] }}
                                </span>
                                <p class="ml-4">Rs. {{ $result['Other_amount'] }}</p>
                                @endif
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