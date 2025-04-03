<div>
    <x-card no-padding overflow-hidden cardClasses="mt-5" >
        <x-heading size="md" class="p-2">Actors Not Responded</x-heading>
        
        <x-table.table :rounded="false" :with-shadow="false" table-condensed>
            <thead>
                <tr>
                    {{-- <x-table.thead>Scheme</x-table.thead>
                    <x-table.thead>Division</x-table.thead>
                    <x-table.thead>Number of Issues</x-table.thead> --}}
                </tr>
            </thead>
            <tbody>
                @if($actors)
                @foreach($actors as $scheme)
                <tr>
                    <x-table.tdata>
                        <x-text-link href="{{ route('schemes.show', $scheme->id) }}">
                            {{ $scheme->name }}
                        </x-text-link>
                    </x-table.tdata>
                    <x-table.tdata>
                        {{ $scheme->div_name }}
                    </x-table.tdata>
                    <x-table.tdata>
                        {{ $scheme->grievance_count }}
                    </x-table.tdata>
                </tr>
                @endforeach
                @else
                <x-card-empty />
                @endif
            </tbody>
        </x-table.table>

    </x-card>
