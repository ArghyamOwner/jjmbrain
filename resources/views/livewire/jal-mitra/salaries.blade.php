<div>
    <x-slot name="title">All Salary</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Salary
    </x-slot>
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        <x-card no-padding overflow-hidden>

            <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
                <div class="md:col-span-2">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search"
                        placeholder="Search by Name / Phone" />
                </div>

                <x-select no-margin name="division" wire:model="division">
                    <option value="all">-- Select division --</option>
                    @foreach ($this->divisions as $divisionKey => $divisionName)
                    <option value="{{ $divisionKey }}">{{ $divisionName }}</option>
                    @endforeach
                </x-select>

                <x-select no-margin name="district" wire:model="district">
                    <option value="all">-- Select district --</option>
                    @foreach ($this->districts as $districtKey => $districtName)
                    <option value="{{ $districtKey }}">{{ $districtName }}</option>
                    @endforeach
                </x-select>

                <x-select no-margin name="year" wire:model="year">
                    <option value="all">--Select year--</option>
                    @foreach (range(date('Y'), 2023) as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                    @endforeach
                </x-select>
            </div>

            @if ($results->isNotEmpty())
            <div>
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Division</x-table.thead>
                            <x-table.thead>District</x-table.thead>
                            <x-table.thead>Name</x-table.thead>
                            <x-table.thead>Phone</x-table.thead>
                            <x-table.thead>DOJ</x-table.thead>
                            <x-table.thead>Year</x-table.thead>
                            @foreach ($this->months as $monthKey => $monthValue)
                            <x-table.thead>{{ $monthValue }}</x-table.thead>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results as $result)
                        <tr>
                            <x-table.tdata>
                                {{ $result->division_name }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $result->district_name }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $result->name }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $result->phone }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $result->doj?->format('d-m-Y') }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $result->year }}
                            </x-table.tdata>

                            @foreach ($this->months as $monthKey => $monthValue)
                            @if($result->year < $result->doj_year)
                                <x-table.tdata>
                                    <div class="mx-auto w-2 h-2 block rounded-full bg-gray-700"></div>
                                </x-table.tdata>
                            @else
                                <x-table.tdata>
                                    @if ($monthKey < $result->doj_month && $result->year <= $result->doj_year)
                                        <div class="mx-auto w-2 h-2 block rounded-full bg-gray-700"></div>
                                    @else
                                        @if ($result->$monthValue === 'success')
                                            <div class="mx-auto w-2 h-2 block rounded-full bg-green-600"></div>
                                        @else
                                            <div class="mx-auto w-2 h-2 block rounded-full bg-red-600"></div>
                                        @endif
                                    @endif
                                </x-table.tdata>
                            @endif
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </div>
            @else
            <x-card-empty class="shadow-none" />
            @endif
        </x-card>

        @if ($results->hasPages())
        <div class="mt-5">{{ $results->links() }}</div>
        @endif
    </x-section-centered>
</div>