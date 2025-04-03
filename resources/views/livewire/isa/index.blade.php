<div>
    <x-slot name="title">ISA</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                ISA
            </x-slot>
            
            @if(auth()->user()->isIsaCoordinator() || auth()->user()->isAdministratorOrSuper())
            <x-slot:action>
                <x-button with-icon icon="add" tag="a" href="{{ route('isa.create') }}">New ISA</x-button>
            </x-slot>
            @endif
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        <div class="mb-8">
            <livewire:isa.stats />
        </div>

        <x-card card-classes="mb-6">
            <div x-data="{ showFilter: false }" x-cloak>
                <div class="flex space-x-3">
                    <div class="flex-1">
                        <x-input-search no-margin label="Search" name="search" wire:model.debounce.600ms="search"
                            placeholder="Search ISA..." />
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

                    <x-select no-margin name="district_id" wire:model="district_id">
                        <option value="all">--Select District--</option>
                        @foreach ($this->districts as $districtKey => $districtName)
                        <option value="{{ $districtKey }}">{{ $districtName }}</option>
                        @endforeach
                    </x-select>

                    <x-select name="block_id" wire:model="block_id">
                        <option value="all">--Select Block--</option>
                        @foreach ($blocks as $blockKey => $blockVal)
                        <option value="{{ $blockKey }}">{{ $blockVal }}</option>
                        @endforeach
                    </x-select>

                    <x-select name="type" wire:model="type">
                        <option value="all">--Select Type--</option>
                        <option value="NGO">NGO</option>
                        <option value="CLF">CLF</option>
                    </x-select>

                </div>
            </div>
        </x-card>

        <x-card no-padding overflow-hidden>
            @if ($isas->isNotEmpty())
            <x-table.table :table-condensed="true" :rounded="false">
                <thead>
                    <tr>
                        <x-table.thead>ISA Name</x-table.thead>
                        <x-table.thead>Type</x-table.thead>
                        <x-table.thead>Block | District</x-table.thead>
                        <x-table.thead>Villages</x-table.thead>
                        <x-table.thead>Contact Person Name | Phone</x-table.thead>
                        <x-table.thead>Actions</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($isas as $item)
                    <tr>
                        <x-table.tdata>
                            <x-text-link href="{{ route('isa.show', $item->id) }}">
                                {{ $item->name }}
                            </x-text-link>
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $item->type }}
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $item?->block?->name ?? 'N/A'}}
                            <p>{{ $item->district?->name ?? 'N/A' }}</p>
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-readmore content="{{ $item->village_names ?? '-' }}" limit="20"
                                link-class="text-indigo-600 underline whitespace-normal" />
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $item->contact_name }} ({{ $item->contact_phone }})
                        </x-table.tdata>
                        <x-table.tdata>
                            <div class="flex space-x-1">
                                <x-button-icon-show href="{{ route('isa.show', $item->id) }}" />
                                @if($showActionButton)
                                <x-button-icon-edit href="{{ route('isa.edit', $item->id) }}" />
                                @endif    
                            </div>
                        </x-table.tdata>
                    </tr>
                    @endforeach
                </tbody>
            </x-table.table>
            @else
            <x-card-empty class="shadow-none rounded-none" />
            @endif
        </x-card>

        @if ($isas->hasPages())
        <div class="mt-5">{{ $isas->links() }}</div>
        @endif
    </x-section-centered>
</div>