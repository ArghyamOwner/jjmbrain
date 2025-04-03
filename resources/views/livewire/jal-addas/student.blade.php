<div>
    <x-slot name="title">Jal Adda Student</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('jaladdas.show', $jaladdaId) }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        Jal Adda Student
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card card-classes="mb-8" form-action="save">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <x-select label="Education Block" name="educationBlock" wire:model="educationBlock">
                        <option value="">--Select a block--</option>
                        @foreach ($this->educationBlocks as $blockKey => $blockName)
                        <option value="{{ $blockKey }}">{{ $blockName }}</option>
                        @endforeach
                    </x-select>

                    <x-virtual-select label="School" name="schoolId" wire:model="schoolId" :options="[
                    'options' => $this->schools,
                ]" custom-label />

                    <x-input no-margin label="Name of the student" name="student_name"
                        wire:model.defer="student_name" />

                    <x-input no-margin label="Jaldoot ID" name="jaldoot_uin" wire:model.defer="jaldoot_uin"
                        class="uppercase" />

                    <x-select no-margin label="Gender" name="gender" wire:model.defer="gender">
                        <option value="">Select an option</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="others">Others</option>
                    </x-select>

                    <x-select no-margin label="Age" name="age" wire:model.defer="age">
                        <option value="">Select an option</option>
                        @foreach (range(10, 20) as $row)
                        <option value="{{ $row }}">{{ $row }}</option>
                        @endforeach
                    </x-select>

                    <x-select no-margin label="Class" name="class" wire:model.defer="class">
                        <option value="">Select an option</option>
                        @foreach (range(8, 12) as $row)
                        <option value="{{ $row }}">{{ $row }}</option>
                        @endforeach
                    </x-select>

                    <x-input-number no-margin label="Phone Number" name="student_phone" wire:model.defer="student_phone"
                        optional />

                    <div class="md:col-span-2">
                        <x-button class="w-full" with-spinner with-icon icon="add" wire:target="save">Add
                            Student</x-button>
                    </div>
                </div>
            </x-card>

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

        </x-section-centered>

        <livewire:jal-addas.delete-student />
</div>