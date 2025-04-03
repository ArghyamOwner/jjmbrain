<div>
    <x-slot name="title">Stock Alert</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>

            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('labDashboard') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Stock Alert
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card card-classes="mb-6">
            <div x-data="{ showFilter: false }" x-cloak>
                <div class="flex space-x-3">
                    <div class="flex-1">
                        <x-input-search no-margin label="Search" name="search" wire:model.debounce.600ms="search"
                            placeholder="Search..." />
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

                    <x-select no-margin name="lab" wire:model="lab">
                        <option value="all">--Select Lab --</option>
                        @foreach ($this->labs as  $lab)
                        <option value="{{ $lab->id }}">{{ $lab->lab_name }}</option>
                        @endforeach
                    </x-select>

                    <x-select no-margin name="item" wire:model="item">
                        <option value="all">--Select Item --</option>
                        @foreach ($this->items as  $item)
                        <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                        @endforeach
                    </x-select>

                </div>
            </div>
        </x-card>
        @if ($stocks->isNotEmpty())
            <x-card no-padding overflow-hidden>
                <x-heading size="md" class="p-2">Stock Alert <x-icon-exclamation-circle
                        class="inline-block  text-red-600 w-6 h-6" /></x-heading>

                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Item Name</x-table.thead>
                            <x-table.thead>Lab Name</x-table.thead>
                            <x-table.thead>Current Stock</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stocks as $stock)
                            <tr>
                                <x-table.tdata>
                                    {{ $stock->item->item_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $stock->lab->lab_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $stock->quantity }}
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>

            </x-card>
        @else
            <x-card-empty />
        @endif
        @if ($stocks->hasPages())
        <div class="mt-5">{{ $stocks->links() }}</div>
        @endif
    </x-section-centered>
</div>
