<div>
    <div class="px-4 py-2 bg-white">
        <div class="flex items-center">
            <div class="shrink-0 mr-3">
                <img src="{{ url('img/jjm-logo.png') }}" alt="jjm-logo" loading="lazy" class="object-fit h-12">
            </div>
            <div class="text-left">
                <div class="leading-5 text-lg font-bold text-sky-600">Jal Jeevan Mission</div>
                <div class="leading-5 text-sm font-medium text-sky-600">PHED Assam</div>
            </div>
        </div>
        <div class="text-center">
            <div class="text-xl font-bold text-sky-600">Jal Shala ID: {{ $jalshalaUin }}</div>
        </div>
    </div>

    {{-- <div class="px-4 py-6 text-center" style="background-color: #0f4497;">
        <x-heading size="xl" class="mb-4 text-white">
            Application Form <br>
            For <br>
            {{ $jalshalaschool->school_name }}
        </x-heading>

        <x-heading size="xl" class="text-white">
            Nodal Teacher Name: {{ $jalshalaschool->teacher_name }}
        </x-heading>
    </div> --}}

    <div class="bg-slate-100 min-h-screen">
        <x-section-centered class="py-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <x-card>
                    <x-description-list size="xs" grid="one-by-two">
                        <x-description-list.item>
                            <x-slot name="title">Jal Shala ID</x-slot>
                            <x-slot name="description">{{ $jalshalaUin }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Day One</x-slot>
                            <x-slot name="description">{{ $dayOne ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Day Two</x-slot>
                            <x-slot name="description">{{ $dayTwo ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Trainer One</x-slot>
                            <x-slot name="description">{{ $trainerOne ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Trainer Two</x-slot>
                            <x-slot name="description">{{ $trainerTwo ?? '-' }}</x-slot>
                        </x-description-list.item>

                        <x-description-list.item>
                            <x-slot name="title">Venue</x-slot>
                            <x-slot name="description">{{ $venue ?? '-' }}</x-slot>
                        </x-description-list.item>
                    </x-description-list>
                </x-card>

                <x-card overflow-hidden>
                    <x-description-list size="xs" grid="one-by-two">

                        @foreach ($jalshalaSchools as $jalshalaSchool)
                            <x-description-list.item>
                                <x-slot name="title">Schools</x-slot>
                                <x-slot
                                    name="description">{{ $jalshalaSchool['school_name'] . ',' . $jalshalaSchool['teacher_name'] . ',' . $jalshalaSchool['phone_number'] }}</x-slot>
                            </x-description-list.item>
                        @endforeach

                        @foreach ($schemeDetails as $schemeDetail)
                            <x-description-list.item>
                                <x-slot name="title">PWSS</x-slot>
                                <x-slot
                                    name="description">{{ $schemeDetail['scheme_name'] . ',' . $schemeDetail['jalmitra_name'] . ',' . $schemeDetail['jalmitra_phone'] }}</x-slot>
                            </x-description-list.item>
                        @endforeach
                    </x-description-list>
                </x-card>
            </div>


            <x-card card-classes="mb-8" form-action="save">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    <div class="md:col-span-2">
                        <x-input no-margin label="Name of the student" name="student_name"
                            wire:model.defer="student_name" />
                    </div>

                    <x-select no-margin label="Scheme" name="scheme_id" wire:model.defer="scheme_id">
                        <option value="">Select an option</option>
                        @foreach ($schemes as $schemeKey => $schemeValue)
                            <option value="{{ $schemeKey }}">{{ $schemeValue }}</option>
                        @endforeach
                    </x-select>

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

                    <x-select label="Select School" name="jalshala_school_id" wire:model.defer="jalshala_school_id">
                        <option value="">--Select School--</option>
                        @foreach ($jalshalaschools as $jalshalaschool)
                            <option value="{{ $jalshalaschool->id }}">{{ $jalshalaschool->school_name }}</option>
                        @endforeach
                    </x-select>

                    <x-select no-margin label="Class" name="class" wire:model.defer="class">
                        <option value="">Select an option</option>
                        @foreach (range(8, 12) as $row)
                            <option value="{{ $row }}">{{ $row }}</option>
                        @endforeach
                    </x-select>

                    <x-input-number placeholder="Enter phone number having whatsapp" no-margin label="Phone Number"
                        name="student_phone" wire:model.defer="student_phone" optional />

                    <div class="md:col-span-4">
                        <x-button class="w-full" with-spinner with-icon icon="add" wire:target="save">Add
                            Student</x-button>
                    </div>
                </div>
            </x-card>

            @if ($jalshalaschools->isNotEmpty())
                <x-table.table>
                    <thead>
                        <tr>
                            <x-table.thead>Scheme</x-table.thead>
                            <x-table.thead>School</x-table.thead>
                            <x-table.thead>Student Name</x-table.thead>
                            <x-table.thead>Jaldoot UIN</x-table.thead>
                            <x-table.thead>Gender / Age</x-table.thead>
                            <x-table.thead>Class</x-table.thead>
                            <x-table.thead>Phone Number</x-table.thead>
                            <x-table.thead>Attendance</x-table.thead>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($jalshalaschools as $jalshalaschool)
                            @foreach ($jalshalaschool->jaldoots as $jaldoot)
                                <tr>
                                    <x-table.tdata>
                                        {{ $jaldoot->scheme?->name ?? '-' }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $jaldoot->jalshalaSchool?->school_name }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $jaldoot->student_name }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $jaldoot->jaldoot_uin }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $jaldoot->gender }} ({{ $jaldoot->age }})
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $jaldoot->class }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        {{ $jaldoot->student_phone ?? '-' }}
                                    </x-table.tdata>
                                    <x-table.tdata>
                                        <x-input-switch wire:click="attendance('{{ $jaldoot->id }}')"
                                            :value="is_null($jaldoot->latestJaldootAttendance) ? 'false' : 'true'" on-value="true" off-value="false" />
                                    </x-table.tdata>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </x-table.table>
            @else
                <x-card-empty>
                    No student details found.
                </x-card-empty>
            @endif

        </x-section-centered>
    </div>
</div>
