<div>
    <x-slot name="title">Jal Shala Education Block Statistics</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>

            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('jalshala.dashboard', ['type' => $type]) }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Jal Shala Education Block Statistics
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
            @if ($educationblocks->isNotEmpty())
                @if($type === 'phase_I')
                <div class="my-3">
                    <x-table.table>
                        <thead>
                            <tr>
                                <x-table.thead>Education Block</x-table.thead>
                                <x-table.thead>No. of Jalshala Pending</x-table.thead>
                                <x-table.thead>No. of Jalshala Conducted</x-table.thead>
                                <x-table.thead>No. of Jaldoot Participated</x-table.thead>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($educationblocks as $data)
                                <tr>
                                    <x-table.tdata>
                                        <x-text-link href="{{ route('jalshalas.statistics', ['educationBlock' => $data->id, 'type' => request()->query('type')]) }}">
                                        {{ $data->block_name }}
                                        </x-text-link>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $data->phase_i_planned_jalshalas_count }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $data->phase_i_organised_jalshalas_count }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $data->phaseIOrganisedJalshalas->sum('total_student_attended') }}
                                    </x-table.tdata>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                </div>
                @endif

                @if($type === 'phase_II')
                <div class="my-3">
                    <x-table.table>
                        <thead>
                            <tr>
                                <x-table.thead>Education Block</x-table.thead>
                                <x-table.thead>No. of Jalshala Pending</x-table.thead>
                                <x-table.thead>No. of Jalshala Conducted</x-table.thead>
                                <x-table.thead>No. of Jaldoot Participated</x-table.thead>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($educationblocks as $data)
                                <tr>
                                    <x-table.tdata>
                                        <x-text-link href="{{ route('jalshalas.statistics', ['educationBlock' => $data->id, 'type' => request()->query('type')]) }}">
                                        {{ $data->block_name }}
                                        </x-text-link>
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $data->phase_i_i_planned_jalshalas_count }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $data->phase_i_i_organised_jalshalas_count }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $data->phaseIIOrganisedJalshalas->sum('total_student_attended') }}
                                    </x-table.tdata>
                                </tr>
                            @endforeach
                        </tbody>
                    </x-table.table>
                </div>
                @endif
            @else
                <x-card-empty />
            @endif
    </x-section-centered>
</div>
