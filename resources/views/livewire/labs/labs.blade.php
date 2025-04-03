<div>
    @if ($labs->isNotEmpty())
        <x-card no-padding overflow-hidden>
            <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="md">All Labs</x-heading>
                </x-slot>

            <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                <thead>
                    <tr>
                        <x-table.thead>Name of Lab</x-table.thead>
                        <x-table.thead>Office / Circle</x-table.thead>
                        <x-table.thead>NABL Certification / Expiry On</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($labs as $lab)
                        <tr>
                            <x-table.tdata>
                                <x-text-link href="{{ route('labs.district', $lab->id) }}">
                                {{ $lab->lab_name }}
                                </x-text-link>
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $lab?->circle?->name ?? '-' }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $lab->nabl_certification }}
                                @if ($lab->nabl_certification_expiry)
                                    <p class="text-sm font-bold text-red-500">
                                        {{ $lab->nabl_certification_expiry->format('d/m/Y') }}</p>
                                @endif
                            </x-table.tdata>
                        </tr>
                    @endforeach
                </tbody>
            </x-table.table>

        </x-card>
    @else
        <x-card-empty />
    @endif
</div>
