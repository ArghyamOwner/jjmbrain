<div>
    <x-slot name="title">All Trainers</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                All Trainers
    </x-slot>

    @can('district-jaldoot-cell')
    <x-slot:action>
        <x-button with-icon icon="add" tag="a" href="{{ route('trainers.create') }}">Add
            Trainer</x-button>
        </x-slot>
        @endcan

        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>

            <x-card no-padding overflow-hidden>
                <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-2">
                    <div class="md:col-span-2">
                        <x-input-search no-margin name="search" wire:model.debounce.500ms="search"
                            placeholder="Search..." />
                    </div>

                    @cannot('district-jaldoot-cell')
                    <x-select no-margin name="district" wire:model="district">
                        <option value="all">--Select a district--</option>
                        @foreach ($this->districts as $districtKey => $districtName)
                        <option value="{{ $districtKey }}">{{ $districtName }}</option>
                        @endforeach
                    </x-select>
                    @endcannot

                    <x-select no-margin name="block" wire:model="block">
                        <option value="all">--Select a block--</option>
                        @foreach ($this->educationBlocks as $blockKey => $blockName)
                        <option value="{{ $blockKey }}">{{ $blockName }}</option>
                        @endforeach
                    </x-select>

                    <x-select no-margin name="organisation" wire:model="organisation">
                        <option value="all">--Select a organisation--</option>
                        @foreach ($this->organisations as $organisationObject)
                        <option value="{{ $organisationObject->value }}">{{ $organisationObject->name }}</option>
                        @endforeach
                    </x-select>

                    <div>
                        <div class="space-x-2 items-center">
                            <x-button type="button" color="white" wire:click="resetFilter" wire:target="resetFilter"
                                with-spinner>
                                <x-icon-refresh class="w-4 h-4 mr-1 -ml-1" />Reset all
                            </x-button>
                        </div>
                    </div>

                    @if ($trainers->isNotEmpty())
                    <x-button type="button" color="blue" tag="a" href="{{ route('trainerList.report') }}" with-spinner>
                        Download CSV
                    </x-button>
                    @endif
                </div>


                @if ($trainers->isNotEmpty())
                <div class="my-3">
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>District / Education Block</x-table.thead>
                                <x-table.thead>Trainer Type</x-table.thead>
                                <x-table.thead>Trainer Name / Phone</x-table.thead>
                                <x-table.thead>Organisation</x-table.thead>
                                <x-table.thead>Bank Details</x-table.thead>
                                <x-table.thead>Action</x-table.thead>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($trainers as $trainer)
                            <tr>
                                <x-table.tdata>
                                    {{ $trainer->district?->name }}
                                    <p class="text-sm">{{ $trainer->educationBlock?->block_name }}</p>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ Str::headline($trainer->trainer_type) }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $trainer->trainer_name }}
                                    <p class="text-sm">{{ $trainer->phone_number }}</p>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $trainer->organisation?->name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <p class="text-sm">Bank Name:{{ $trainer->bank_name }}</p>
                                    <p class="text-sm">A/C No:{{ $trainer->account_number }}</p>
                                    <p class="text-sm">IFSC:{{ $trainer->ifsc_code }}</p>
                                </x-table.tdata>
                                <x-table.tdata>
                                    <x-button-icon-delete x-on:click="$wire.emitTo(
                                            'jalshalas.delete-trainer',
                                            'showDeleteModal',
                                            '{{ $trainer->id }}',
                                            'Delete Confirmation',
                                            'Are you sure you want to delete this trainer? You cannot undo this process.'
                                        )" />
                                </x-table.tdata>
                            </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                </div>
                @else
                <x-card-empty />
                @endif
            </x-card>

            @if ($trainers->hasPages())
            <div class="mt-5">{{ $trainers->links() }}</div>
            @endif
        </x-section-centered>
        <livewire:jalshalas.delete-trainer />
</div>