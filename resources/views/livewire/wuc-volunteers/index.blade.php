<div>
    <x-heading size="md" class="mb-2 mt-5">Volunteers</x-heading>
    <x-card no-padding overflow-hidden>
        @if ($volunteers->isNotEmpty())
            <div class="text-sm">
                <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                    <thead>
                        <tr>
                            <x-table.thead>Volunteers Name | Phone</x-table.thead>
                            <x-table.thead>Nature</x-table.thead>
                            <x-table.thead>No. of Trainings</x-table.thead>
                            <x-table.thead>Training Days</x-table.thead>
                            <x-table.thead>Description</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($volunteers as $vol)
                            <tr>
                                <x-table.tdata>
                                    {{ $vol->name }}
                                    <p>{{ $vol->phone }}</p>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $vol->nature }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $vol->no_of_trainings }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $vol->training_days }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $vol->training_description }}
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
</div>
