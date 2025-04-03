<div>
    <x-heading size="md" class="mb-2 mt-5">O&M Expenses</x-heading>
    <x-card no-padding overflow-hidden>
        @if ($payments->isNotEmpty())
            <div class="text-sm">
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Scheme</x-table.thead>
                            <x-table.thead>Panchayat</x-table.thead>
                            <x-table.thead>Jalmitra</x-table.thead>
                            <x-table.thead>Payment Details</x-table.thead>
                            <x-table.thead>Month / Year</x-table.thead>
                            <x-table.thead>Transaction Id</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <x-table.tdata>
                                    <x-text-link href="{{ route('schemes.show', [$payment->scheme_id, 'tab' => 'details']) }}">
                                        {{ $payment->scheme?->name }}
                                    </x-text-link>
                                    <p class="text-xs">
                                        SMT-ID : {{ $payment->scheme?->old_scheme_id ?? 'N/A' }}
                                    </p>
                                    <p class="text-xs">
                                        IMIS-ID : {{ $payment->scheme?->imis_id ?? 'N/A' }}
                                    </p>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $payment->panchayat?->panchayat_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $payment->jalmitra?->name }}
                                    <p class="text-xs">{{ $payment->jalmitra?->phone }}</p>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $payment->amount_for }}
                                    <p class="text-xs">{{ Str::money($payment->amount_paid ?? 0) }}</p>
                                    <p class="text-xs">Date : {{ $payment->payment_date?->format('d-m-Y') }}</p>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ \Carbon\Carbon::create(null, $payment->month)->monthName.", $payment->year" }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $payment->transaction_id }}
                                </x-table.tdata>
                                {{-- <x-table.tdata>
                                    <div class="flex space-x-1">
                                        <x-button-icon-edit href="#" />
                                        <x-button-icon-delete href="#" x-data="" x-cloak
                                            x-on:click.prevent="$wire.emitTo(
                                                'o-and-m-payments.delete',
                                                'showDeleteModal',
                                                '{{ $payment->id }}',
                                                'Confirm Deletion',
                                                'Are you sure you want to remove this payment?',
                                                '{{ $payment->financialYear->financialYear  }}'
                                            )" />
                                    </div>
                                </x-table.tdata> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            </div>
        @else
            <x-card-empty class="shadow-none rounded-none" />
        @endif
    </x-card>
</div>
