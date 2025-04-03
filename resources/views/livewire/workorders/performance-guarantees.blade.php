<div>
    <x-heading size="md" class="mb-2">Details of Performance Guarantees</x-heading>

    {{-- @if ($performanceGuarantees->isNotEmpty())
        @if ($workorderStatus === 'PG incomplete')
            <x-alert variant="error" :close="false" class="mb-2">PG amount is not completed for the scheme, please
                submit PG of <strong>{{ Str::money($workorderPgAmount) ?? '0' }}</strong> to complete the process.
            </x-alert>
        @endif
    @endif --}}

    <x-card no-padding overflow-hidden>
        @if ($performanceGuarantees->isNotEmpty() || ($performanceGuarantees->isEmpty() && $search))
            <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
                <div class="md:col-span-2">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search" placeholder="Search..." />
                </div>
                <x-select no-margin name="status" wire:model="status">
                    <option value="">All status</option>
                    <option value="withdrawn">Withdrawn</option>
                    <option value="not-withdrawn">Not withdrawn</option>
                </x-select>
            </div>
        @endif

        @if ($performanceGuarantees->isNotEmpty())

            <div class="text-sm">
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Type</x-table.thead>
                            <x-table.thead>Bank Name / PG Number</x-table.thead>
                            <x-table.thead>Amount</x-table.thead>
                            {{-- <x-table.thead>Worder Order No. / Office</x-table.thead> --}}
                            <x-table.thead>Expiry Date</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($performanceGuarantees as $performanceGuarantee)
                            <tr>
                                <x-table.tdata>
                                    <x-text-link href="{{ route('pg.show', $performanceGuarantee->id) }}">
                                        {{ $performanceGuarantee->pg_type }}</x-text-link>
                                </x-table.tdata>
                                <x-table.tdata>
                                    <div>{{ $performanceGuarantee->bank_name }}</div>
                                    <div>{{ $performanceGuarantee->pg_number }}</div>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ Str::money($performanceGuarantee->pg_amount ?? 0) }}
                                </x-table.tdata>
                                {{-- <x-table.tdata>
                                    <div>{{ $performanceGuarantee->workorder?->workorder_number ?? '' }}</div>
                                    <div>{{ $performanceGuarantee->workorder?->circle?->name ?? 'n/a' }}</div>
                                </x-table.tdata> --}}
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
                                        <div class="flex space-x-2">

                                            <x-text-link href="{{ route('pg.withdraw', $performanceGuarantee->id) }}">
                                                Withdraw |</x-text-link>

                                            <x-button-icon-delete href="#" x-data="" x-cloak
                                                x-on:click.prevent="$wire.emitTo(
                                                'performance-guarantees.delete',
                                                'showDeleteModal',
                                                '{{ $performanceGuarantee->id }}',
                                                'Confirm Deletion',
                                                    'Are you sure you want to remove this PG ?',
                                                    '{{ $performanceGuarantee->bank_name }}'
                                                )" 
                                            />
                                        </div>
                                    @endif
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
    <livewire:performance-guarantees.delete />

    {{-- @if ($performanceGuarantees->hasPages())
        <div class="mt-5">{{ $performanceGuarantees->links() }}</div>
    @endif --}}
</div>
