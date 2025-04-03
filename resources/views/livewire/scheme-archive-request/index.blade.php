<div>
    <x-slot name="title">Scheme Archive Requests</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Scheme Archive Requests
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-heading size="md" class="mb-2">Scheme Archive Requests</x-heading>

        <x-card card-classes="mb-6">
            <div x-data="{ showFilter: false }" x-cloak>
                <div class="flex space-x-3">
                    <div class="flex-1">
                        <x-input-search no-margin label="Search Scheme" name="search" wire:model.debounce.600ms="search"
                            placeholder="Search SMT ID / IMIS ID / Scheme Name..." />
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
                    <x-select no-margin name="division" wire:model="division">
                        <option value="all">--Select Division--</option>
                        @foreach ($this->divisions as $divisionKey => $divisionName)
                        <option value="{{ $divisionKey }}">{{ $divisionName }}</option>
                        @endforeach
                    </x-select>
                    <x-select no-margin name="status" wire:model="status">
                        <option value="all">--Select Status--</option>
                        @foreach ($statusOptions as $statusKey => $statusName)
                        <option value="{{ $statusKey }}">{!! $statusName !!}</option>
                        @endforeach
                    </x-select>
                </div>
            </div>
        </x-card>

        <x-card no-padding overflow-hidden>
            @if ($requests->isNotEmpty())
            <div class="text-sm">
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Scheme Name</x-table.thead>
                            <x-table.thead>Division</x-table.thead>
                            <x-table.thead>Status</x-table.thead>
                            <x-table.thead>Checked By</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- {{ dd($requests) }} --}}
                        @foreach ($requests as $request)
                        <tr>
                            <x-table.tdata>
                                <x-text-link href="{{ route('archiveRequests.show', $request->id) }}">
                                    {{ $request->scheme_name }}
                                </x-text-link>
                                <p class="text-xs">
                                    IMIS : {{ $request->imis_id ?? 'N/A' }} | SMT : {{ $request->smt_id ?? 'N/A'
                                    }}
                                </p>
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $request->division?->name }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {!! $request->status_name !!}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $request->checkedBy?->name ?? '-'}}
                            </x-table.tdata>

                            <x-table.tdata>
                                <div class="flex space-x-1">
                                    <x-button-icon-show href="{{ route('archiveRequests.show', $request->id) }}" />
                                    @if($request->status != 'archived')
                                    <x-button-icon-transfer tooltipTitle="View Scheme" href="{{ route('schemes.show', $request->scheme_id) }}" />
                                    @endif
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
        @if ($requests->hasPages())
        <div class="mt-5">{{ $requests->links() }}</div>
        @endif
    </x-section-centered>
</div>