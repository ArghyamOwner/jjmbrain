<div>
    <x-section-heading>
        <x-slot:title>
            Campaign Results (Total Response:{{ $resultsCount }})
            </x-slot>
    </x-section-heading>

    <x-card no-padding overflow-hidden>
        @if ($results)
            <x-table.table :rounded="false">

                <thead>
                    <tr>
                        <x-table.thead>Question</x-table.thead>
                        <x-table.thead>Option 1</x-table.thead>
                        <x-table.thead>Option 2</x-table.thead>
                        <x-table.thead>Option 3</x-table.thead>
                        <x-table.thead>Option 4</x-table.thead>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($results as $key => $result)
                        <tr>
                            <x-table.tdata>
                                {{ $key }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ round($result['option_1'], 2) }}%
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ round($result['option_2'], 2) }}%
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ round($result['option_3'], 2) }}%
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ round($result['option_4'], 2) }}%
                            </x-table.tdata>
                        </tr>
                    @endforeach
                </tbody>
            </x-table.table>
        @else
            <x-card-empty class="shadow-none" />
        @endif
    </x-card>
</div>
