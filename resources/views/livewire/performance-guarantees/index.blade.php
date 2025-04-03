<div>

    <x-slot name="title">Details of Performance Guarantees</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Performance Guarantee Dashboard
    </x-slot>
    @if($showAddEditButton)
    <x-slot name="action">
        <x-button tag="a" href="{{ route('pgs.create') }}" with-icon icon="add">New PG</x-button>
    </x-slot>
    @endif
    </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        <div class="mb-8">
            <livewire:performance-guarantees.stats />
        </div>

        <x-heading size="md" class="mb-2">Performance Guarantees</x-heading>

        <x-card card-classes="mb-6">
            <div x-data="{ showFilter: false }" x-cloak>
                <div class="flex space-x-3">
                    <div class="flex-1">
                        <x-input-search no-margin label="Search" name="search" wire:model.debounce.600ms="search"
                            placeholder="Search PG Number.." />
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
                    class="mt-4 grid grid-cols-2 md:grid-cols-4 gap-x-4 sm:px-0 space-y-3">
                    <x-select no-margin name="status" wire:model="status" class="mt-3">
                        <option value="">All status</option>
                        <option value="withdrawn">Withdrawn</option>
                        <option value="not-withdrawn">Not withdrawn</option>
                    </x-select>
                    <x-select no-margin name="type" wire:model="type">
                        <option value="all">All type</option>
                        @foreach($this->performanceGuaranteeTypes as $performanceGuaranteeType)
                        <option value="{{ $performanceGuaranteeType->value }}">{{ $performanceGuaranteeType->name }}
                        </option>
                        @endforeach
                    </x-select>
                    <x-select no-margin name="bank" wire:model="bank">
                        <option value="all">All banks</option>
                        @foreach($this->banks as $bankName)
                        <option value="{{ $bankName }}">{{ $bankName }}</option>
                        @endforeach
                    </x-select>

                    <x-virtual-select name="contractor" wire:model="contractor" :options="[
                            'options' => $this->contractorUsers,
                            'placeholder'=> 'Select Contractor....'
                        ]" custom-label />

                    <x-select no-margin name="expiringDay" wire:model="expiringDay">
                        <option value="">PG Expiring Within</option>
                        @foreach($expiringDays as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </x-select>

                    <div class="flex space-x-2">

                        <div wire:key="isExpired" class="mt-2">
                            <x-checkbox no-margin name="isExpired" wire:model="isExpired" value="isExpired"
                                label="PG Expired" />
                        </div>

                        <div wire:key="isWithdrawn" class="mt-2">
                            <x-checkbox no-margin name="isWithdrawn" wire:model="isWithdrawn" value="isWithdrawn"
                                label="PG Withdrawn" />
                        </div>
                    </div>



                </div>
            </div>
        </x-card>




        <x-card no-padding overflow-hidden>
            {{-- <div class="py-3 px-4 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
                <div class="md:col-span-2">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search"
                        placeholder="Search..." />
                </div>
                <x-select no-margin name="status" wire:model="status">
                    <option value="">All status</option>
                    <option value="withdrawn">Withdrawn</option>
                    <option value="not-withdrawn">Not withdrawn</option>
                </x-select>
                <x-select no-margin name="type" wire:model="type">
                    <option value="all">All type</option>
                    @foreach($this->performanceGuaranteeTypes as $performanceGuaranteeType)
                    <option value="{{ $performanceGuaranteeType->value }}">{{ $performanceGuaranteeType->name }}
                    </option>
                    @endforeach
                </x-select>
                <x-select no-margin name="bank" wire:model="bank">
                    <option value="all">All banks</option>
                    @foreach($this->banks as $bankName)
                    <option value="{{ $bankName }}">{{ $bankName }}</option>
                    @endforeach
                </x-select>
            </div> --}}

            @if($performanceGuarantees->isNotEmpty())
            <div class="text-sm">
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Type</x-table.thead>
                            <x-table.thead>Bank Name / PG Number</x-table.thead>
                            <x-table.thead>PG Amount</x-table.thead>
                            <x-table.thead>PG to be Submitted</x-table.thead>
                            <x-table.thead>Contractor</x-table.thead>
                            <x-table.thead>Expiry Date</x-table.thead>
                            <x-table.thead>Status</x-table.thead>
                            <x-table.thead>Actions</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($performanceGuarantees as $performanceGuarantee)
                        <tr>
                            <x-table.tdata>
                                {{-- <x-text-link href="{{ route('pg.show', $performanceGuarantee->id) }}"> --}}
                                    {{ $performanceGuarantee->pg_type }}
                                    {{-- </x-text-link> --}}
                            </x-table.tdata>
                            <x-table.tdata>
                                <div>{{ $performanceGuarantee->bank_name }}</div>
                                <div>{{ $performanceGuarantee->pg_number }}</div>
                            </x-table.tdata>
                            <x-table.tdata>
                               
                                @if($performanceGuarantee->workorders_sum_workorder_amount)
                                @if($performanceGuarantee->pg_amount <
                                ($performanceGuarantee->workorders_sum_workorder_amount * 0.05))
                                <span class="text-red-600">
                                    {{ Str::money($performanceGuarantee->pg_amount ?? 0) }}
                                </span>
                                @else
                                {{ Str::money($performanceGuarantee->pg_amount ?? 0) }}
                                @endif
                                @else
                                N / A
                                @endif
                                {{-- {{ Str::money($performanceGuarantee->pg_amount ?? 0) }} --}}
                            </x-table.tdata>

                            <x-table.tdata>
                                @if($performanceGuarantee->workorders_sum_workorder_amount)
                                {{-- @if($performanceGuarantee->pg_amount >
                                ($performanceGuarantee->workorders_sum_workorder_amount * 0.05))
                                <span class="text-red-600">
                                    {{ Str::money($performanceGuarantee->workorders_sum_workorder_amount * 0.05) }}
                                </span>
                                @else
                                {{ Str::money($performanceGuarantee->workorders_sum_workorder_amount * 0.05) }}
                                @endif --}}
                                {{ Str::money($performanceGuarantee->workorders_sum_workorder_amount * 0.05) }}
                                @else
                                N / A
                                @endif
                            </x-table.tdata>
                            {{-- <x-table.tdata>
                                @if($performanceGuarantee->workorder?->workorder_number)
                                <x-text-link href="{{ route('workorders.show', $performanceGuarantee->workorder_id) }}">
                                    {{ $performanceGuarantee->workorder?->workorder_number ?? '' }}
                                </x-text-link>
                                @endif
                                <p>
                                    {{ $performanceGuarantee->workorder?->circle?->name ?? 'n/a' }}
                                </p>
                                @if($performanceGuarantee->workorder?->contractor_id)
                                {{ $performanceGuarantee->workorder?->contractor?->name ?? '' }}
                                @endif
                            </x-table.tdata> --}}
                            <x-table.tdata>
                                @if($performanceGuarantee?->contractor)
                                {{ $performanceGuarantee->contractor?->name }}
                                <p>Bid No - {{ $performanceGuarantee->contractor?->contractor?->bid_no }}</p>
                                @else
                                {{ $performanceGuarantee->contractor_name ?? '-' }}
                                @endif
                            </x-table.tdata>
                            <x-table.tdata>
                                @if($performanceGuarantee->expired_date)
                                @if ($performanceGuarantee->expired_status == 'expired')
                                <div class="text-red-600">
                                    @date($performanceGuarantee->expired_date)
                                </div>
                                @else
                                @date($performanceGuarantee->expired_date)
                                @endif
                                @endif
                            </x-table.tdata>
                            <x-table.tdata>
                                @if ($performanceGuarantee->withdraw_status == false)
                                <span class="text-slate-500">Not withdrawn</span>
                                @else
                                <span class="text-green-600">Withdrawn</span>
                                <x-button-icon-delete href="#" x-data="" x-cloak x-on:click.prevent="$wire.emitTo(
                                                    'performance-guarantees.delete',
                                                    'showDeleteModal',
                                                    '{{ $performanceGuarantee->id }}',
                                                    'Confirm Deletion',
                                                    'Are you sure you want to remove this PG ?',
                                                    '{{ $performanceGuarantee->bank_name }}'
                                                )" />
                                @endif
                            </x-table.tdata>
                            <x-table.tdata>
                                <div class="flex space-x-1">
                                    <x-button-icon-show href="{{ route('pg.show', $performanceGuarantee->id)  }}" />
                                    @if($showAddEditButton)
                                    <x-button-icon-edit href="#" />
                                    @endif
                                    <x-button-icon-add href="#" />
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

        @if ($performanceGuarantees->hasPages())
        <div class="mt-5">{{ $performanceGuarantees->links() }}</div>
        @endif
        <livewire:performance-guarantees.delete />
    </x-section-centered>
</div>