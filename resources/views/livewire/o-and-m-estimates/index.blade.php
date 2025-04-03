<div>
    <x-heading size="md" class="mb-2 mt-5">O & M Estimate</x-heading>
    <x-card no-padding overflow-hidden>
        @if ($estimates->isNotEmpty())
            <div class="text-sm">
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Financial Year</x-table.thead>
                            <x-table.thead>Manpower</x-table.thead>
                            <x-table.thead>Maintenance</x-table.thead>
                            <x-table.thead>Electricity</x-table.thead>
                            <x-table.thead>Chemical</x-table.thead>
                            <x-table.thead>Total Monthly Estimate</x-table.thead>
                            <x-table.thead>Actions</x-table.thead>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estimates as $estimate)
                            <tr>
                                <x-table.tdata>
                                    {{ $estimate->financialYear->financialYear }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $estimate->manpower }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $estimate->maintenance }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $estimate->electricity }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $estimate->chemical }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $estimate->total_monthly_estimate }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <div class="flex space-x-1">
                                        <x-button-icon-edit href="#" />
                                        <x-button-icon-delete href="#" x-data="" x-cloak
                                            x-on:click.prevent="$wire.emitTo(
                                                'o-and-m-estimates.delete',
                                                'showDeleteModal',
                                                '{{ $estimate->id }}',
                                                'Confirm Deletion',
                                                'Are you sure you want to remove this estimate?',
                                                '{{ $estimate->financialYear->financialYear  }}'
                                            )" />
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
    <livewire:o-and-m-estimates.delete />
</div>
