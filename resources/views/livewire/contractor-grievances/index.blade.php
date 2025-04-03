<div>
    <x-slot name="title">Contractor Grievances</x-slot>
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Contractor Grievances
    </x-slot>
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card card-classes="mb-6">
            <div x-data="{ showFilter: false }" x-cloak>
                <div class="flex space-x-3">
                    <div class="flex-1">
                        <x-input-search no-margin name="search" wire:model.debounce.600ms="search"
                            placeholder="Search Contractor..." />
                    </div>

                    <div>
                        <div class="space-x-2 items-center">
                            {{-- <x-button type="button" color="white" x-on:click="showFilter = !showFilter">
                                <x-icon-filter class="w-4 h-4 mr-1 -ml-1" />Filter
                            </x-button> --}}
                            <x-button type="button" color="white" wire:click="resetFilter" wire:target="resetFilter"
                                with-spinner>
                                <x-icon-refresh class="w-4 h-4 mr-1 -ml-1" />Reset all
                            </x-button>
                        </div>
                    </div>
                </div>

                {{-- <div x-show="showFilter" x-collapse
                    class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-x-4 gap-y-4 sm:px-0">
                    <x-select no-margin name="division" wire:model="division">
                        <option value="all">Select a Division</option>
                        @foreach($this->divisions as $divisionKey => $divisionName)
                        <option value="{{ $divisionKey }}">{{ $divisionName }}</option>
                        @endforeach
                    </x-select>
                </div> --}}
            </div>
        </x-card>

        @if ($grievances->isNotEmpty())
        <x-card no-padding>
            <x-table.table>
                <thead>
                    <tr>
                        <x-table.thead>Contractor</x-table.thead>
                        <x-table.thead>Workorder</x-table.thead>
                        <x-table.thead>Type</x-table.thead>
                        <x-table.thead>Image</x-table.thead>
                        <x-table.thead>Remarks</x-table.thead>
                        <x-table.thead>Created At</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grievances as $ticket)
                    <tr>
                        <x-table.tdata>
                            @if($ticket?->user)
                            {{ $ticket->user?->name }}
                            <p>Bid No - {{ $ticket->user?->contractor?->bid_no }}</p>
                            @else
                            -
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-text-link href="{{ route('workorders.show', $ticket->workorder_id) }}">
                                {{ $ticket->workorder?->workorder_number }}
                            </x-text-link>
                        </x-table.tdata>
                        <x-table.tdata>
                            <span class="capitalize">{{ $ticket->type }}</span>
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($ticket->image)
                            <x-lightbox>
                                <x-lightbox.item image-url="{{ $ticket->image_url }}">
                                    <x-card no-padding overflow-hidden>
                                        <div class="bg-slate-50 h-20 w-full">
                                            <img src="{{ $ticket->image_url }}"
                                                class="object-fit h-20 mx-auto" loading="lazy">
                                        </div>
                                    </x-card>
                                </x-lightbox.item>
                            </x-lightbox>
                            @else
                            -
                            @endif
                        </x-table.tdata>
                        <x-table.tdata>
                            <x-readmore content="{{ $ticket->remarks ?? '-' }}" limit="15"
                                link-class="text-indigo-600 underline whitespace-normal" />
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $ticket->created_at?->format('j M, Y') ?? '-' }}
                        </x-table.tdata>
                    </tr>
                    @endforeach
                </tbody>
            </x-table.table>
        </x-card>
        @if ($grievances->hasPages())
        <div class="mt-5">{{ $grievances->links() }}</div>
        @endif
        @else
        <x-card-empty />
        @endif
    </x-section-centered>
</div>