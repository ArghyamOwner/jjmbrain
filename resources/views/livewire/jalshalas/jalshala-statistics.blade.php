<div>
    <x-slot name="title">Jal Shala Statistics</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>

            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('jalshalas.block-statistics', $districtId) }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Jal Shala Statistics
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
            @if ($jalshalas->isNotEmpty())
                <div class="my-3">
                    <x-table.table>
                        <thead>
                            <tr>
                                <x-table.thead>Jal Shala ID</x-table.thead>
                                <x-table.thead>No. of School Participated</x-table.thead>
                                <x-table.thead>No. of Jaldoot Mapped</x-table.thead>
                                <x-table.thead>No. of Jaldoot Participated</x-table.thead>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($jalshalas as $data)
                                <tr>
                                    <x-table.tdata>
                                        <x-text-link href="{{ route('jalshalas.show', $data->id) }}">
                                        {{ $data->jalshala_uin }}
                                        </x-text-link>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $data->jalshala_schools_count }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $data->jalshala_schools_jaldoots_count }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $data->total_student_attended }}
                                    </x-table.tdata>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                </div>
            @else
                <x-card-empty />
            @endif
    </x-section-centered>
</div>
