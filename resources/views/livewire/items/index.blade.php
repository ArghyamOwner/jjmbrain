<div>
    <x-slot name="title">Items</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Items
            </x-slot>

            @cannot('lab-nodal-officer')
            <x-slot:action>
                <x-button with-icon icon="add" tag="a" href="{{ route('items.create') }}">New Item</x-button>
            </x-slot>
            @endcannot
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding overflow-hidden>

            <div class="p-3 border-b grid grid-cols-1 md:grid-cols-4 gap-6">

                <div class="md:col-span-2">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search" placeholder="Search..." />
                </div>

                <x-select no-margin name="category" wire:model="category">
                    <option value="all">--Select a category--</option>
                    @foreach ($this->itemTypes as $itemType)
                        <option value="{{ $itemType->value }}">{{ $itemType->name }}</option>
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

            @if ($items->isNotEmpty())
                <x-table.table :table-condensed="true" :rounded="false">
                    <thead>
                        <tr>
                            <x-table.thead>Item Name</x-table.thead>
                            <x-table.thead>Item Code</x-table.thead>
                            <x-table.thead>Type</x-table.thead>
                            <x-table.thead>Category</x-table.thead>
                            <x-table.thead>Nature of Use</x-table.thead>
                            <x-table.thead>Hazard Level</x-table.thead>
                            <x-table.thead>Unit</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <x-table.tdata>
                                    {{ $item->item_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $item->item_code }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $item->type }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $item->category }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $item->nature_of_use }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $item->hazard_level }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $item->unit }}
                                </x-table.tdata>

                                <x-table.tdata>
                                    <div class="flex space-x-1">

                                        <x-button-icon-add href="{{ route('stocks.create', $item->id) }}" />

                                        @can('lab-ho')
                                            <x-button-icon-edit href="{{ route('items.edit', $item->id) }}" />

                                            <x-button-icon-delete href="#" />
                                        @endcan
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

        @if ($items->hasPages())
            <div class="mt-5">{{ $items->links() }}</div>
        @endif
    </x-section-centered>
</div>
