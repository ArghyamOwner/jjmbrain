<div>
    <x-heading size="md" class="mb-2 mt-5">Monthly Expenditures</x-heading>
    @if ($this->wuc->monthlyExpenditures->isNotEmpty())
    <x-table.table :table-condensed="true" :rounded="false">
        <thead>
            <tr>
                <x-table.thead>Category | Date</x-table.thead>
                <x-table.thead>Amount</x-table.thead>
                <x-table.thead>Remarks</x-table.thead>
                {{-- <x-table.thead>Image</x-table.thead> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($this->wuc->monthlyExpenditures as $item)
            <tr>
                <x-table.tdata>
                    {{ $item->expenditureCategory?->name }}
                    <p>
                        {{ $item->expenditure_date?->format('m-d-Y') }}
                    </p>
                </x-table.tdata>
                <x-table.tdata>
                    {{ Str::money($item->amount ?? 0) }}
                </x-table.tdata>
                <x-table.tdata>
                    <x-readmore content="{{ $item->remarks ?? '-' }}" limit="20"
                        link-class="text-indigo-600 underline whitespace-normal" />
                </x-table.tdata>
                {{-- <x-table.tdata>
                    
                </x-table.tdata> --}}
            </tr>
            @endforeach
        </tbody>
    </x-table.table>
    @else
    <x-card-empty class="shadow-none rounded-none" />
    @endif
</div>