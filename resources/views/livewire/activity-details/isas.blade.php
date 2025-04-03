<div>
    <x-heading size="md" class="mb-2">ISA(s) associated with this Activity</x-heading>

    <x-card no-padding overflow-hidden>
        @if ($isas->isNotEmpty())
        <x-table.table :table-condensed="true" :rounded="false">
            <thead>
                <tr>
                    <x-table.thead>ISA Name</x-table.thead>
                    <x-table.thead>Type</x-table.thead>
                    <x-table.thead>Villages</x-table.thead>
                    <x-table.thead>Contact Person Name | Phone</x-table.thead>
                </tr>
            </thead>
            <tbody>
                @foreach ($isas as $item)
                <tr>
                    <x-table.tdata>
                        <x-text-link href="{{ route('isa.show', $item->id) }}">
                            {{ $item->name }}
                        </x-text-link>
                    </x-table.tdata>
                    <x-table.tdata>
                        {{ $item->type }}
                    </x-table.tdata>
                    <x-table.tdata>
                        <x-readmore content="{{ $item->village_names ?? '-' }}" limit="20"
                            link-class="text-indigo-600 underline whitespace-normal" />
                    </x-table.tdata>
                    <x-table.tdata>
                        {{ $item->contact_name }} ({{ $item->contact_phone }})
                    </x-table.tdata>
                </tr>
                @endforeach
            </tbody>
        </x-table.table>
        @else
        <x-card-empty class="shadow-none rounded-none" />
        @endif
    </x-card>
</div>