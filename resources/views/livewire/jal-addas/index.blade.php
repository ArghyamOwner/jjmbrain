<div>
    <x-slot name="title">All Jal Adda</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Jal Adda Management
            </x-slot>

            {{-- @can('district-jaldoot-cell')
                <x-slot:action>
                    <x-button with-icon icon="add" tag="a" href="{{ route('jaladdas.create') }}">Add Jal
                        Adda</x-button>
                </x-slot>
            @endcan --}}
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <div class="mb-8">
            @livewire('jal-addas.statistics', ['type' => request()->query('type')])
        </div>

        <x-card no-padding overflow-hidden>
            <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
                <div class="md:col-span-2">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search"
                        placeholder="Search ..." />
                </div>

                @can('admin')
                    <x-select no-margin name="district" wire:model="district">
                        <option value="all">--Select a district--</option>
                        @foreach ($this->districts as $districtKey => $districtName)
                            <option value="{{ $districtKey }}">{{ $districtName }}</option>
                        @endforeach
                    </x-select>
                @endcan

                <x-select no-margin name="status" wire:model="status">
                    <option value="all">--Select a status--</option>
                    @foreach ($this->statuses as $statusObject)
                        <option value="{{ $statusObject->value }}">{{ $statusObject->name }}</option>
                    @endforeach
                </x-select>

                <x-select name="type" wire:model="type">
                    <option value="all">--Select a type--</option>
                    @foreach ($this->jalshalaTypes as $typeObject)
                        <option value="{{ $typeObject->value }}">{{ $typeObject->name }}</option>
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
            </div>

            @if ($jaladdas->isNotEmpty())
                <x-table.table>
                    <thead>
                        <tr>
                            <x-table.thead>District</x-table.thead>
                            <x-table.thead>Planned Date</x-table.thead>
                            <x-table.thead>Jaldoots</x-table.thead>
                            <x-table.thead>Status</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($jaladdas as $jaladda)
                            <tr>
                                <x-table.tdata>
                                    {{ $jaladda->district?->name }}
                                    <p class="text-sm">
                                        <x-badge :withdot="false"> {{ $jaladda->type?->name }}</x-badge>
                                    </p>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $jaladda->day_one?->format('d/m/Y h:i A') }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $jaladda->jaladda_students_count }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <x-badge variant="{{ $jaladda->status->color() }}">{{ $jaladda->status }}</x-badge>
                                </x-table.tdata>
                                <x-table.tdata>
                                    <div class="flex">
                                        <x-button-icon-edit href="{{ route('jaladdas.edit', $jaladda->id) }}" />
                                        <x-button-icon-show href="{{ route('jaladdas.show', $jaladda->id) }}" />
                                    </div>
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            @else
                <x-card-empty />
            @endif
        </x-card>

        @if ($jaladdas->hasPages())
            <div class="mt-5">{{ $jaladdas->links() }}</div>
        @endif
    </x-section-centered>
</div>
