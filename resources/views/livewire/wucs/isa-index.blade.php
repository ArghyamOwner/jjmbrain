<div>
    <x-heading size="md" class="mb-2 mt-5">Associated ISA(s)</x-heading>
    @if ($this->wuc->isas->isNotEmpty())
    <x-table.table :table-condensed="true" :rounded="false">
        <thead>
            <tr>
                <x-table.thead>ISA Name</x-table.thead>
                <x-table.thead>Type</x-table.thead>
                <x-table.thead>Block | District</x-table.thead>
                <x-table.thead>Villages</x-table.thead>
                <x-table.thead>Contact Person Name | Phone</x-table.thead>
            </tr>
        </thead>
        <tbody>
            @foreach ($this->wuc->isas as $item)
            <tr>
                <x-table.tdata>
                    {{ $item->name }}
                </x-table.tdata>
                <x-table.tdata>
                    {{ $item->type }}
                </x-table.tdata>
                <x-table.tdata>
                    {{ $item?->block?->name ?? 'N/A'}}
                    <p>{{ $item->district?->name ?? 'N/A' }}</p>
                </x-table.tdata>
                <x-table.tdata>
                    <x-readmore content="{{ $item->village_names ?? '-' }}" limit="20"
                        link-class="text-indigo-600 underline whitespace-normal" />
                </x-table.tdata>
                <x-table.tdata>
                    {{ $item->contact_name }} ({{ $item->contact_phone }})
                </x-table.tdata>
                <x-table.tdata>

                </x-table.tdata>
            </tr>
            @endforeach
        </tbody>
    </x-table.table>
    @else
    <x-card-empty class="shadow-none rounded-none" />
    @endif
</div>