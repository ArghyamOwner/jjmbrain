<div>
    <x-slot name="title">All Jal Shala</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Jal Shala Management
            </x-slot>

            {{-- @can('district-jaldoot-cell')
                <x-slot:action>
                    <x-button with-icon icon="add" tag="a" href="{{ route('jalshalas.create') }}">Add Jal
                        Shala</x-button>
                </x-slot>
            @endcan --}}
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        <x-card no-padding overflow-hidden>
            <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
                <div class="md:col-span-2">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search" placeholder="Search by Jal Shala Id ..." />
                </div>

                <x-select no-margin name="district" wire:model="district">
                    <option value="all">--Select a district--</option>
                    @foreach ($this->districts as $districtKey => $districtName)
                        <option value="{{ $districtKey }}">{{ $districtName }}</option>
                    @endforeach
                </x-select>

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

            @if ($jalshalas->isNotEmpty())
                <div class="my-3">
                    <x-table.table>
                        <thead>
                            <tr>
                                <x-table.thead>Jal Shala ID</x-table.thead>
                                <x-table.thead>District</x-table.thead>
                                <x-table.thead>PWSS</x-table.thead>
                                <x-table.thead>Education Block</x-table.thead>
                                <x-table.thead>Planned Date</x-table.thead>
                                <x-table.thead>Scheme</x-table.thead>
                                <x-table.thead>School</x-table.thead>
                                <x-table.thead>Jaldoot</x-table.thead>
                                <x-table.thead>Status</x-table.thead>
                                <x-table.thead>Action</x-table.thead>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($jalshalas as $jalshala)
                                <tr>
                                    <x-table.tdata>
                                        {{ $jalshala->jalshala_uin }}
                                        <p class="text-sm">
                                            <x-badge :withdot="false"> {{ $jalshala->type?->name }}</x-badge>
                                        </p>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $jalshala->district?->name }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <x-readmore content="{{ $jalshala->schemes?->pluck('name')->join(', ') }}"
                                            limit="20" link-class="text-indigo-600 underline whitespace-normal" />
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <x-readmore content="{{ $jalshala->educationBlocks?->pluck('block_name')->join(', ') }}"
                                            limit="20" link-class="text-indigo-600 underline whitespace-normal" />
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $jalshala->day_one?->format('d/m/Y h:i A') }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $jalshala->schemes_count }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $jalshala->jalshala_schools_count }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $jalshala->jalshala_schools_jaldoots_count }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <x-badge
                                            variant="{{ $jalshala->status->color() }}">{{ $jalshala->status }}</x-badge>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <x-button-icon-show href="{{ route('jalshalas.show', $jalshala->id) }}" />
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

        @if ($jalshalas->hasPages())
            <div class="mt-5">{{ $jalshalas->links() }}</div>
        @endif
    </x-section-centered>
</div>
