<div>
    <x-slot name="title">Lithologs</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Lithologs
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        {{-- <x-heading size="md" class="mb-2">Schemes
            <div class="flex text-sm font-normal">Note:
                <x-icon-user class="mr-1 ml-1 text-red-600 w-4 h-4" />
                Indicates Jal Mitra is missing from the Handed Over Schemes.
            </div>
            <div class="flex text-sm font-normal">
                <x-icon-building class="mr-1 ml-10 text-red-600 w-4 h-4" />
                Indicates Lithog data for the scheme exists
            </div>
            <div class="flex text-sm font-normal">
                <x-icon-flag class="mr-1 ml-10 text-green-600 w-4 h-4" />
                Indicates Scheme is Verified by Panchayat
            </div>
        </x-heading> --}}

        @if($lithologs->isNotEmpty() || ($lithologs->isEmpty() && $search))
        <x-card card-classes="mb-6">
            <div x-data="{ showFilter: false }" x-cloak>
                <div class="flex space-x-3">
                    <div class="flex-1">
                        <x-input-search no-margin label="Search" name="search" wire:model.debounce.600ms="search"
                            placeholder="Search schemes..." />
                    </div>

                    <div class="pt-6">
                        <div class="space-x-2 items-center">
                            <x-button type="button" color="white" x-on:click="showFilter = !showFilter">
                                <x-icon-filter class="w-4 h-4 mr-1 -ml-1" />Filter
                            </x-button>
                            <x-button type="button" color="white" wire:click="resetFilter" wire:target="resetFilter"
                                with-spinner>
                                <x-icon-refresh class="w-4 h-4 mr-1 -ml-1" />Reset all
                            </x-button>
                        </div>
                    </div>
                </div>
                

                <div x-show="showFilter" x-collapse
                    class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-4 sm:px-0">
                    <x-select no-margin name="division" wire:model="division">
                        <option value="all">--Select Division--</option>
                        @foreach ($this->divisions as $divisionKey => $divisionName)
                        <option value="{{ $divisionKey }}">{{ $divisionName }}</option>
                        @endforeach
                    </x-select>
                    <x-select no-margin name="type" wire:model="type">
                        <option value="all">--Select Type--</option>
                        <option value="complete">Complete</option>
                        <option value="pending">Pending</option>
                    </x-select>
                </div>
            </div>
        </x-card>
        @endif

        <x-card no-padding overflow-hidden>    
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
    </x-section-centered>
</div>