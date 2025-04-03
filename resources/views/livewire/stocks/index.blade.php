<div>
    <x-slot name="title">Stocks</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Stocks/Inventory
            </x-slot>

            <x-slot:action>
                <x-button tag="a" with-icon icon="add" href="{{ route('items') }}">New Stock</x-button>
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        <x-card card-classes="mb-6">
            <div x-data="{ showFilter: false }" x-cloak>
                <div class="flex space-x-3">
                    <div class="flex-1">
                        <x-input-search no-margin label="Search" name="search" wire:model.debounce.600ms="search"
                            placeholder="Search Item Name / Code..." />
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

                    <x-select name="category" wire:model="category">
                        <option value="">--Select category--</option>
                        @foreach ($this->itemTypes as $itemType)
                            <option value="{{ $itemType->value }}">{{ $itemType->name }}</option>
                        @endforeach
                    </x-select>

                    <x-select name="item" wire:model="item">
                        <option value="">--Select item--</option>
                        @foreach ($this->items as $itemKey => $itemValue)
                            <option value="{{ $itemKey }}">{{ $itemValue }}</option>
                        @endforeach
                    </x-select>

                    @cannot('lab-nodal-officer')
                    <x-select name="lab" wire:model="lab">
                        <option value="">--Select lab--</option>
                        @foreach ($this->labs as $labKey => $labValue)
                            <option value="{{ $labKey }}">{{ $labValue }}</option>
                        @endforeach
                    </x-select>
                    @endcannot
                </div>
            </div>
        </x-card>

        <x-card no-padding overflow-hidden>
            {{-- @if ($stocks->isNotEmpty() || ($stocks->isEmpty() && $search))
                <div class="px-4 py-3 border-b">
                    <x-input-search 
                        no-margin 
                        name="search" 
                        wire:model.debounce.500ms="search" 
                        placeholder="Search..." 
                    />
                </div>
            @endif --}}

            @if ($stocks->isNotEmpty())
                <x-table.table :table-condensed="true" :rounded="false">
                    <thead>
                        <tr>
                            <x-table.thead>Item Name</x-table.thead>
                            <x-table.thead>Category</x-table.thead>
                            <x-table.thead>Lab Name</x-table.thead>
                            <x-table.thead>Quantity</x-table.thead>
                            <x-table.thead>MFG</x-table.thead>
                            <x-table.thead>Expiry</x-table.thead>
                            <x-table.thead>Stock Flow</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stocks as $stock)
                            <tr>
                                <x-table.tdata>
                                    {{ $stock->item->item_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <x-badge
                                        variant="{{ $stock->item->category->color() }}">{{ $stock->item->category }}</x-badge>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $stock->lab->lab_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $stock->quantity }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $stock->manufacturing_date?->format('d/m/Y') }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $stock->expiry_date?->format('d/m/Y') ?? '-' }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $stock->stock_flow }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <div class="flex space-x-1">
                                        <x-button-icon-edit href="{{ route('stocks.edit', $stock->id) }}" />
                                            @if ($this->isAllowTransfer())
                                            <x-button-icon-transfer href="{{ route('stocks.transfer', $stock->id) }}" />
                                            @endif
                                        <x-button-icon-consume tag="a" href="#"
                                            x-on:click.prevent="Livewire.emit('addStockConsumedSlideover', '{{ $stock->id }}')"
                                            x-cloak />
                                        {{-- <x-button-icon-delete href="#" /> --}}
                                    </div>
                                    {{-- <x-button-icon-delete
                                        x-on:click.prevent="$wire.emitTo(
                                            'water-quality-parameters.delete',
                                            'showDeleteModal',
                                            '{{ $waterparameter->id }}',
                                            'Confirm Deletion',
                                            'Are you sure you want to remove this parameter?',
                                            '{{ $waterparameter->parameter_name }}'
                                        )"
                                    /> --}}
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            @else
                <x-card-empty class="shadow-none rounded-none" />
            @endif
        </x-card>

        @if ($stocks->hasPages())
            <div class="mt-5">{{ $stocks->links() }}</div>
        @endif
    </x-section-centered>

    <livewire:stocks.consume />
</div>
