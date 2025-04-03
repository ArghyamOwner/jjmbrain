<div>
    <x-slot name="title">Offices</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Offices
    </x-slot>
    {{--
    @if(auth()->user()->isAdministrator())
    <x-slot name="action">
        <x-button tag="a" href="{{ route('schemes.create') }}" with-icon icon="add">New Scheme</x-button>
    </x-slot>
    @endif --}}
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card card-classes="mb-6">
            <div x-data="{ showFilter: false }" x-cloak>
                <div class="flex space-x-3">
                    <div class="flex-1">
                        <x-input-search no-margin label="Search" name="search" wire:model.debounce.600ms="search"
                            placeholder="Search Office..." />
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

                    <x-select no-margin name="type" wire:model="type">
                        <option value="all">-- Select Office Type --</option>
                        @foreach ($officeTypes as $key => $name)
                        <option value="{{ $key }}">{{ $name }}</option>
                        @endforeach
                    </x-select>

                </div>
            </div>
        </x-card>

        <x-card no-padding overflow-hidden>
            @if ($offices->isNotEmpty())
            <div class="text-sm">
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Image</x-table.thead>
                            <x-table.thead>Name</x-table.thead>
                            <x-table.thead>Type</x-table.thead>
                            <x-table.thead>Phone</x-table.thead>
                            <x-table.thead>Address | Location</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offices as $office)
                        <tr>
                            <x-table.tdata>
                                @if($office->image_url)
                                <x-lightbox>
                                    <x-lightbox.item image-url="{{ $office->image_url }}">
                                        <img src="{{ $office->image_url }}" alt="{{ $office->name }}" class="h-16 object-fit" />
                                    </x-lightbox.item>
                                </x-lightbox>
                                @else
                                -
                                @endif
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-text-link href="#">{{ $office->name }}</x-text-link>
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ Str::title( $office->type ) }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $office->phone ?? '-' }}
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-readmore content="{{ $office->address ?? '-' }}" limit="20"
                                    link-class="text-indigo-600 underline whitespace-normal" />
                                <p class="text-xs">
                                    @if($office->latitude && $office->longitude)
                                    {{ "$office->latitude / $office->longitude" }}
                                    @endif
                                </p>    
                            </x-table.tdata>
                            <x-table.tdata>
                                <div class="flex space-x-1">
                                    <x-button-icon-edit href="{{ route('office.edit', $office->id) }}" />
                                </div>
                            </x-table.tdata>
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </div>
            @else
            <x-card-empty class="shadow-none rounded-none" />
            @endif
        </x-card>
        @if ($offices->hasPages())
        <div class="mt-5">{{ $offices->links() }}</div>
        @endif
    </x-section-centered>
</div>