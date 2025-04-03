<div>
    <x-slot name="title">All workorders</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Workorders
    </x-slot>

    {{-- <x-slot name="action">
        <x-button tag="a" href="{{ route('workorders.create') }}" with-icon icon="add">New workorder</x-button>
    </x-slot> --}}
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        <div class="mb-5">
            <x-alert :close="true" variant="error">Workorders without Workorder Number - {{ $withoutWoNumber }}
            </x-alert>
        </div>

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

                <x-form method="POST" wire:submit.prevent="search">
                    <div x-show="showFilter" x-collapse class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-x-4 sm:px-0">

                        {{-- <x-select no-margin label="Issuing Authority" name="issuingAuthority"
                            wire:model.defer="issuingAuthority">
                            <option value="">--Issuing Authority--</option>
                            @foreach($this->issuingAuthorities as $issuingAuthorityValue)
                            <option value="{{ $issuingAuthorityValue }}">{{ $issuingAuthorityValue }}</option>
                            @endforeach
                        </x-select> --}}

                        <x-virtual-select label="Issuing Authority" name="issuingAuthority"
                            wire:model.defer="issuingAuthority" :options="[
                            'options' => $this->issuingAuthorities,
                        ]" />

                        <x-select no-margin label="Divisions" name="division_id"
                            wire:model.defer="division_id">
                            <option value="">-- Select Division --</option>
                            @foreach($this->divisions as $divId => $divName)
                            <option value="{{ $divId }}">{{ $divName }}</option>
                            @endforeach
                        </x-select>
                        blinking
                        <x-select no-margin label="Scheme Approved" name="SchemeApproved"
                            wire:model.defer="SchemeApproved">
                            <option value="">--Scheme Approved--</option>
                            @foreach($this->schemeApproves as $schemeApproveValue)
                            <option value="{{ $schemeApproveValue }}">{{ $schemeApproveValue }}</option>
                            @endforeach
                        </x-select> 
                        {{-- @json($contractor) --}}
                        <x-virtual-select-remote label="Contractor Name / BID Nos" name="contractor"
                            wire:model.defer="contractor" search-method="searchContractors" custom-label />

                        <x-flatpicker label="Select Dates" name="dateRange" wire:model.defer="dateRange" :options="[
                            'mode' => 'range'
                        ]" />

                        <x-button with-spinner wire:target="search" class="w-40 h-10 mt-6">Search</x-button>
                    </div>
                </x-form>
            </div>
        </x-card>

        <x-card no-padding overflow-hidden>
            @if($workorders->isNotEmpty())
            <div>
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Date | Division</x-table.thead>
                            <x-table.thead>Issuing Authority</x-table.thead>
                            {{-- <x-table.thead>Office</x-table.thead> --}}
                            <x-table.thead>WO Number</x-table.thead>
                            <x-table.thead>Amount | PG Amount</x-table.thead>
                            {{-- <x-table.thead>PG Status</x-table.thead> --}}
                            <x-table.thead>Scheme Name</x-table.thead>
                            <x-table.thead>Contractor Name / Bid No</x-table.thead>
                            <x-table.thead>Workorder Type</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($workorders as $workorder)
                        <tr>
                            <x-table.tdata>
                                {{ $workorder->workorder_estimated_date?->format('j M, Y') ?? '-' }}
                                <p>
                                    <span class="text-sm">{{ $workorder->division?->name ?? '-'}}</span>
                                </p>
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $workorder->issuing_authority }}
                            </x-table.tdata>
                            {{-- <x-table.tdata>
                                {{ $workorder->circle?->name }}
                            </x-table.tdata> --}}
                            <x-table.tdata>
                                {{ $workorder->workorder_number ?? '-'}}
                                <p>
                                    @if($workorder->performance_guarantees_exists)
                                    <x-badge variant="success">Has PG</x-badge>
                                    @else
                                    <x-badge variant="danger">No PG</x-badge>
                                    @endif
                                </p>
                            </x-table.tdata>
                            <x-table.tdata>

                                @if($workorder->workorder_amount)
                                {{ Str::money($workorder->workorder_amount) }}
                                <p>
                                    <x-badge variant="warning">{{ Str::money($workorder->workorder_amount * 0.05) }}
                                    </x-badge>
                                </p>
                                @else
                                -
                                @endif
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-readmore content="{{ $workorder->scheme_names ?? '-' }}" limit="20"
                                    link-class="text-indigo-600 underline whitespace-normal" />
                            </x-table.tdata>
                            {{-- <x-table.tdata>
                                {{ $workorder->pg_percentage ?? 0 }}%
                            </x-table.tdata> --}}
                            <x-table.tdata>
                                {{ $workorder->contractor?->name }}
                                <p>{{ $workorder->contractor?->contractor?->bid_no }}</p>
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-badge variant="{{ $workorder->workorder_type->color() }}">{{
                                    $workorder->workorder_type }}</x-badge>
                            </x-table.tdata>
                            <x-table.tdata>
                                <div class="flex space-x-1">
                                    <x-button-icon-show href="{{ route('workorders.show', $workorder->id) }}" />
                                    {{--
                                    <x-button-icon-edit href="#" /> --}}
                                    {{--
                                    <x-button-icon-delete href="#" x-data="" x-cloak x-on:click.prevent="$wire.emitTo(
                                                    'tasks.delete',
                                                    'showDeleteModal',
                                                    '{{ $tasksFeed->id }}',
                                                    'Confirm Deletion',
                                                    'Are you sure you want to remove this tasks details?',
                                                    '{{ $tasksFeed->title }}'
                                                )" /> --}}
                                </div>
                            </x-table.tdata>
                        </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </div>
            @else
            <x-card-empty class="shadow-none" />
            @endif
        </x-card>

        @if ($workorders->hasPages())
        <div class="mt-5">{{ $workorders->links() }}</div>
        @endif
    </x-section-centered>
</div>