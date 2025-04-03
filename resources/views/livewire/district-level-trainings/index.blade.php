<div>
    <x-slot name="title">District TOT</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                District TOT
            </x-slot>

            @can('district-jaldoot-cell')
                <x-slot name="action">
                    <x-button tag="a" href="{{ route('districtleveltraings.create') }}" with-icon icon="add">New
                        TOT</x-button>
                </x-slot>
            @endcan
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card no-padding overflow-hidden class="mt-5">

            @if ($districtLevelTrainings->isNotEmpty())
                <div>
                    <x-table.table :rounded="false" :with-shadow="false" table-condensed>
                        <thead>
                            <tr>
                                <x-table.thead>District</x-table.thead>
                                <x-table.thead>Day 1 / Day 2</x-table.thead>
                                <x-table.thead>No. of Participants</x-table.thead>
                                <x-table.thead>Trainer 1 / Trainer 2 / Trainer 3</x-table.thead>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($districtLevelTrainings as $districtLevelTraining)
                                <tr>
                                    <x-table.tdata>
                                        {{ $districtLevelTraining->district?->name }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $districtLevelTraining->day_one?->format('d/m/Y h:i A') }}
                                        <p class="text-sm">{{ $districtLevelTraining->day_two?->format('d/m/Y h:i A') }}</p>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $districtLevelTraining->total_participant }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $districtLevelTraining->trainerOne?->trainer_name }}
                                        <p class="text-sm">{{ $districtLevelTraining->trainerTwo?->trainer_name }}</p>
                                        <p class="text-sm">{{ $districtLevelTraining->trainerThree?->trainer_name }}</p>
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

        @if ($districtLevelTrainings->hasPages())
            <div class="mt-5">{{ $districtLevelTrainings->links() }}</div>
        @endif
    </x-section-centered>
</div>
