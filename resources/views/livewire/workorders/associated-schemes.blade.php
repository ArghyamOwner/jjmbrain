<div>
    <x-heading size="md" class="mb-2">Schemes associated with this workorder</x-heading>

    <x-card no-padding overflow-hidden>
        @if($schemes->isNotEmpty())
            <div class="text-sm">
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Name</x-table.thead>
                            <x-table.thead>Division</x-table.thead>
                            <x-table.thead>District</x-table.thead>
                            <x-table.thead>Block</x-table.thead>
                            <x-table.thead>Work Status</x-table.thead>
                            <x-table.thead>Operating Status</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($schemes as $scheme)
                            <tr>
                                <x-table.tdata>
                                    <x-text-link href="{{ route('schemes.show', [$scheme->id, 'tab' => 'details']) }}">
                                        {{ $scheme->name }}
                                    </x-text-link>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $scheme->division?->name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $scheme->district?->name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $scheme->block_names }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    @if ($scheme->work_status)
                                    <x-badge variant="{{ $scheme->work_status->color() }}">{{ $scheme->work_status->label() }}</x-badge>
                                    @endif
                                </x-table.tdata>
                                <x-table.tdata>
                                    @if ($scheme->operating_status)
                                    <x-badge variant="{{ $scheme->operating_status->color() }}">{{ $scheme->operating_status?->label() }}</x-badge>
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
</div>
