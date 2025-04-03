<div>
    <x-slot name="title">Meter Readings Report</x-slot>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('reports') }}">Go Back</x-text-link>
            </x-slot>
            <x-slot:title>
                Meter Readings Report
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>
    <x-section-centered>
        <x-card card-classes="mb-6">
            <div class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-4 sm:px-0">
                <x-select label="District" name="districtId" wire:model="districtId">
                    <option value="">--Select a district--</option>
                    @foreach ($this->districts as $districtKey => $districtValue)
                        <option value="{{ $districtKey }}">{{ $districtValue }}</option>
                    @endforeach
                </x-select>
                <x-select label="Block" no-margin name="block" wire:model="block">
                    <option value="all">--Select Block--</option>
                    @foreach ($this->blocks as $blockKey => $blockName)
                        <option value="{{ $blockKey }}">{{ $blockName }}</option>
                    @endforeach
                </x-select>
            </div>
        </x-card>
        <x-card no-padding overflow-hidden>
            <div class="text-sm">
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Title</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <x-table.tdata>Weekly Report</x-table.tdata>
                            <x-table.tdata>
                                <x-button type='button' color="white" wire:click="download('weekly')"
                                    wire:target="download('weekly')" with-spinner>Download</x-button>
                            </x-table.tdata>
                        </tr>
                        <tr>
                            <x-table.tdata>Monthly Report</x-table.tdata>
                            <x-table.tdata>
                                <x-button type='button' color="white" wire:click="download('monthly')"
                                        wire:target="download('monthly')" with-spinner>Download</x-button>
                            </x-table.tdata>
                        </tr>
                    </tbody>
                </x-table.table>
            </div>
        </x-card>
    </x-section-centered>
</div>
