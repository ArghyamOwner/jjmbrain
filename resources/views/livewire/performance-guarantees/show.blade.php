<div>
    <x-slot name="title">PG Details</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-breadcrumb>
                    <x-breadcrumb-item href="{{ route('pg.dashboard') }}">PG Dashboard</x-breadcrumb-item>
                    {{-- <x-breadcrumb-item href="{{ route('workorders.show', $workorderId) }}">Workorder Details
                    </x-breadcrumb-item> --}}
                    <x-breadcrumb-item>{{ $pgNumber }}</x-breadcrumb-item>
                </x-breadcrumb>
            </x-slot>

            <x-slot:title>
                {{ $pgNumber }}
            </x-slot>

            <x-slot name="action">
                <livewire:performance-guarantees.assign-workorders :pg="$pg"/>
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mb-8">
            <x-card>
                <x-description-list size="xs">
                    <x-description-list.item>
                        <x-slot name="title">Contractor</x-slot>
                        <x-slot name="description">
                            {{ $this->contractor }}
                        </x-slot>
                    </x-description-list.item>
                    <x-description-list.item>
                        <x-slot name="title">Type</x-slot>
                        <x-slot name="description">
                            {{ $type }}
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Pledged in favour of</x-slot>
                        <x-slot name="description">{{ $inFavour }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Bank Name</x-slot>
                        <x-slot name="description">{{ $bankName }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Bank Branch</x-slot>
                        <x-slot name="description">{{ $bankBranch }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Account Number</x-slot>
                        <x-slot name="description">{{ $account_no }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">PG Number</x-slot>
                        <x-slot name="description">{{ $pgNumber }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">PG Amount</x-slot>
                        <x-slot name="description">
                            {{ Str::money($pgAmount) ?? 0 }}
                            <div class="text-xs text-slate-500">
                                {{ Str::numberToWords($pgAmount) }}
                            </div>
                        </x-slot>
                    </x-description-list.item>

                    {{-- <x-description-list.item>
                        <x-slot name="title">Workorder Number</x-slot>
                        <x-slot name="description">{{ $workorderNumber }}</x-slot>
                    </x-description-list.item> --}}

                    <x-description-list.item>
                        <x-slot name="title">PG Date</x-slot>
                        <x-slot name="description">@date($pgDate)</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">PG Document</x-slot>
                        <x-slot name="description">
                            @if ($pgCopy)
                            <x-text-link target="_blank" href="{{ $pgCopy }}">
                                <x-icon-download class="mr-4 text-slate-400 w-5 h-5 shrink-0" /> Download
                            </x-text-link>
                            {{-- <img src="{{ $pgCopy }}" alt="pg-copy"
                                class="absolute w-full h-full object-contain" loading="lazy"> --}}
                            @else
                            No PG Copy available.
                            @endif
                        </x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Expiry Date</x-slot>
                        <x-slot name="description">
                            @if($expiryDate)
                            @date($expiryDate) 
                            @endif
                        </x-slot>
                    </x-description-list.item>

                </x-description-list>

                <div class="mt-5">
                    <x-button class="w-full" tag="a" href="{{ route('pg.withdraw', $pgId) }}">Withdraw PG
                        Document</x-button>
                </div>
            </x-card>

            {{-- <x-card>
                <div class="h-96 overflow-hidden relative flex items-center justify-center">
                    @if ($pgCopy)
                    <img src="{{ $pgCopy }}" alt="pg-copy" class="absolute w-full h-full object-contain"
                        loading="lazy">
                    @else
                    No PG Copy available.
                    @endif
                </div>
            </x-card> --}}
        </div>
        <x-heading size="md" class="mb-2">Workorders associated with this PG</x-heading>
        <x-card no-padding overflow-hidden>
            @if($this->pg->workorders->isNotEmpty())
            <div>
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Date</x-table.thead>
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
                        @foreach($this->pg->workorders as $workorder)
                        <tr>
                            <x-table.tdata>
                                {{ $workorder->workorder_estimated_date?->format('j M, Y') }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $workorder->issuing_authority }}
                            </x-table.tdata>
                            {{-- <x-table.tdata>
                                {{ $workorder->circle?->name }}
                            </x-table.tdata> --}}
                            <x-table.tdata>
                                {{ $workorder->workorder_number }}
                            </x-table.tdata>
                            <x-table.tdata>
                                @if($workorder->workorder_amount)    
                                {{ Str::money($workorder->workorder_amount) }}
                                <p>
                                    <x-badge variant="warning">{{ Str::money($workorder->workorder_amount * 0.05) }}</x-badge>
                                </p>
                                @else
                                -
                                @endif
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $workorder->scheme_names }}
                            </x-table.tdata>
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
    </x-section-centered>
</div>