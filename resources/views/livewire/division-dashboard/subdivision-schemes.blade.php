<div>
    <x-heading size="md" class="mb-2 mt-4">Sub-Division Schemes</x-heading>
    <x-card no-padding overflow-hidden>
        @if ($subdivisions->isNotEmpty())
        <div>
            <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                <thead>
                    <tr>
                        <x-table.thead class="sticky left-0 z-10 text-left whitespace-nowrap">Name</x-table.thead>
                        <x-table.thead>Schemes Count</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subdivisions as $subdiv)
                    <tr>
                        <x-table.tdata
                            class="md:w-1/5 sticky left-0 z-10 bg-white text-left whitespace-nowrap leading-none">
                            <x-text-link href="#">
                                {{ $subdiv->name }}
                            </x-text-link>
                        </x-table.tdata>
                        <x-table.tdata>
                            {{ $subdiv->schemes_count }}
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