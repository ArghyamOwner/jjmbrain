<div>
    <x-slot name="title">Jal Adda Details</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('jaladdas.index') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Jal Adda Details
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        @can('district-jaldoot-cell')
            <div class="text-right mb-4">
                <x-button color="red" href="#" x-data="" x-cloak
                    x-on:click.prevent="$wire.emitTo(
                                                'jal-addas.delete-jaladda',
                                                'showDeleteModal',
                                                '{{ $jaladda->id }}',
                                                'Confirm Deletion',
                                                'Are you sure you want to remove this jaladda?'
                                            )">Delete
                    Jal Adda</x-button>
            </div>
        @endcan

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <x-card>
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg">Details of Jal Adda <x-badge :withdot="false"> {{ $jaladda->type?->name }}</x-badge></x-heading>
                </x-slot>

                <x-description-list size="xs" grid="no-break">
                    <x-description-list.item>
                        <x-slot name="title">District</x-slot>
                        <x-slot name="description">{{ $jaladda->district?->name }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Planned Date</x-slot>
                        <x-slot name="description">{{ $jaladda->day_one?->format('d/m/Y h:i A') }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Venue</x-slot>
                        <x-slot name="description">{{ $jaladda->venue ?? 'n/a' }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Attendee</x-slot>
                        <x-slot name="description">{{ $jaladda->attendee ?? 'n/a' }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Trainer 1 Name</x-slot>
                        <x-slot name="description">{{ $jaladda->trainerOne?->trainer_name }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Trainer 2 Name</x-slot>
                        <x-slot name="description">{{ $jaladda->trainerTwo?->trainer_name ?? 'n/a' }}</x-slot>
                    </x-description-list.item>

                    <x-description-list.item>
                        <x-slot name="title">Created By</x-slot>
                        <x-slot name="description">{{ $jaladda->user?->name }}</x-slot>
                    </x-description-list.item>
                </x-description-list>
            </x-card>
            <x-card overflow-hidden>
                <x-slot:header class="border-b border-slate-100 md:flex md:items-center">
                    <x-heading size="lg">Quick Actions</x-heading>
                </x-slot>
                <div class="grid grid-cols-2 md:grid-cols-1 gap-2">
                    <x-button class="truncate" tag="a" href="{{ route('jaladdas.student', $jaladda->id) }}"
                        color="white" with-icon icon="add">Add Student</x-button>
                    <x-button class="truncate" tag="a" href="{{ route('jaladdas.image', $jaladda->id) }}"
                        color="white" with-icon icon="info-circle">Update Post Jal Adda</x-button>
                </div>
            </x-card>
        </div>
        <div class="mb-6">
            <div class="grid grid-cols-2">
                <x-heading class="m-2" size="lg">For District Co-Ordinator</x-heading>

                <div class="text-right">
                    <x-button color="white" class="py-2 text-indigo-600" with-icon icon="add" type="button"
                        tag="a" href="{{ route('jaladdas.student', $jaladda->id) }}">Add
                        Student</x-button>
                </div>
            </div>

            <x-alertbox variant="error" class="my-3">The district coordinator should click the button and add all
                student data in for this particular Jal Adda.</x-alertbox>
        </div>

        @if ($jaladdaStudents->isNotEmpty())
            <x-table.table>
                <thead>
                    <tr>
                        <x-table.thead>School</x-table.thead>
                        <x-table.thead>Student Name</x-table.thead>
                        <x-table.thead>Jaldoot ID</x-table.thead>
                        <x-table.thead>Gender / Age</x-table.thead>
                        <x-table.thead>Class</x-table.thead>
                        <x-table.thead>Phone Number</x-table.thead>
                        <x-table.thead>Action</x-table.thead>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($jaladdaStudents as $jaladdaStudent)
                        <tr>
                            <x-table.tdata>
                                {{ $jaladdaStudent->school?->school_name }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $jaladdaStudent->student_name }}
                            </x-table.tdata>
                            <x-table.tdata class="uppercase">
                                {{ $jaladdaStudent->jaldoot_uin }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $jaladdaStudent->gender }} ({{ $jaladdaStudent->age }})
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $jaladdaStudent->class }}
                            </x-table.tdata>
                            <x-table.tdata>
                                {{ $jaladdaStudent->student_phone ?? '-' }}
                            </x-table.tdata>
                            <x-table.tdata>
                                <x-button-icon-delete href="#" x-data="" x-cloak x-on:click.prevent="$wire.emitTo(
                                                    'jal-addas.delete-student',
                                                    'showDeleteModal',
                                                    '{{ $jaladdaStudent->id }}',
                                                    'Confirm Deletion',
                                                    'Are you sure you want to remove this student?',
                                                    '{{ $jaladdaStudent->student_name }}'
                                                )">Delete Student</x-button>
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

        <div class="mt-6">
            @if ($jaladda->one_image && $jaladda->two_image)
                <x-card>
                    <x-lightbox>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <x-lightbox.item image-url="{{ $jaladda->dayOneImageUrl }}"
                                image-caption="Jal Shala Day One Image">
                                <img src="{{ $jaladda->dayOneImageUrl }}" alt="Jal Shala Day One Image" loading="lazy"
                                    class="object-fit" />
                            </x-lightbox.item>

                            <x-lightbox.item image-url="{{ $jaladda->dayTwoImageUrl }}"
                                image-caption="Jal Shala Day Two Image">
                                <img src="{{ $jaladda->dayTwoImageUrl }}" alt="Jal Shala Day Two Image" loading="lazy"
                                    class="object-fit" />
                            </x-lightbox.item>
                        </div>
                    </x-lightbox>
                </x-card>
            @else
                <x-card-empty>
                    <x-heading class="mb-4">Update data when Jal Adda is completed</x-heading>
                    <x-button tag="a" href="{{ route('jaladdas.image', $jaladda->id) }}">Update Post Jal Adda
                        Data</x-button>
                </x-card-empty>
            @endif
        </div>
    </x-section-centered>

    <livewire:jal-addas.delete-jaladda />

    <livewire:jal-addas.delete-student />
</div>
