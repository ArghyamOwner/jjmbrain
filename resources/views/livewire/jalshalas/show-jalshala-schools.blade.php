<div>
    <x-slot name="title">Jal Shala School Student Details</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('jalshalas.show', $jalshalaId) }}">Go Back to Jal Shala</x-text-link>
            </x-slot>

            <x-slot:title>
               Jal Shala School Student Details of {{ $jalshalasSchoolName }}
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        @if ($jaldoots->isNotEmpty())
                {{-- <x-heading size="lg" class="mb-2">Details of student for the Jal Shala ID: {{ $jaldoot->jalshalaSchool?->jalshala?->jalshala_uin }} for the {{ $jaldoot->jalshalaschool?->school_name }}</x-heading> --}}
                <x-table.table>
                    <thead>
                        <tr>
                            <x-table.thead>Jaldoot UIN</x-table.thead>
                            <x-table.thead>Student Name</x-table.thead>
                            <x-table.thead>Gender</x-table.thead>
                            <x-table.thead>Class</x-table.thead>
                            <x-table.thead>Phone Number</x-table.thead>
                            <x-table.thead>Age</x-table.thead>
                            <x-table.thead>Action</x-table.thead>
                        </tr>
                    </thead>
    
                    <tbody>
                        @foreach ($jaldoots as $jaldoot)
                            <tr>
                                <x-table.tdata>
                                    {{ $jaldoot->jaldoot_uin }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $jaldoot->student_name }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $jaldoot->gender }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $jaldoot->class }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $jaldoot->student_phone }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $jaldoot->age }}
                                </x-table.tdata>
                                <x-table.tdata>
                                    <div class="flex">
                                    <x-button-icon-edit 
                                        wire:click.prevent="$emit('openStudentEditSlideover', '{{ $jaldoot->id }}')"
                                        href="#"
                                    />
                                    <x-button-icon-delete href="#" x-data="" x-cloak
                x-on:click.prevent="$wire.emitTo(
                                                'jalshalas.delete-jaldoot',
                                                'showDeleteModal',
                                                '{{ $jaldoot->id }}',
                                                'Confirm Deletion',
                                                'Are you sure you want to remove this jaldoot?',
                                                '{{ $jaldoot->student_name }}'
                                            )">Delete Jaldoot</x-button>
                                    </div>
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            @else
                <x-card-empty>
                    No student details found.
                </x-card-empty>
            @endif
    </x-section-centered>
    <livewire:jalshalas.edit-jalshala-schools-student-slideover />

    <livewire:jalshalas.delete-jaldoot />
</div>