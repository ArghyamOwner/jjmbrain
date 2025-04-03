<div>
    <x-slot name="title">All Students</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Students
            </x-slot>

            <x-slot name="action">
                <x-button tag="a" href="{{ route('students.create') }}" with-icon icon="add">New Student</x-button>    
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        <div class="mb-5">
            <livewire:students.stats />
        </div>

        <x-card no-padding overflow-hidden>
            <div class="p-3 border-b grid grid-cols-1 md:grid-cols-6 gap-4">
                <div class="md:col-span-2">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search" placeholder="Search..." />
                </div>
                <x-select no-margin name="gender" wire:model="gender">
                    <option value="all">--Select Gender--</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </x-select>
                <x-select no-margin name="class" wire:model="class">
                    <option value="all">--Select Class--</option>
                    @foreach($this->classes as $class)
                    <option value="{{ $class }}">{{ $class }}</option>
                    @endforeach
                </x-select>
                <x-select no-margin name="section" wire:model="section">
                    <option value="all">--Select Section--</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                </x-select>
                <x-select no-margin name="status" wire:model="status">
                    <option value="all">--Select Status--</option>
                    @foreach($this->studentStatuses as $studentStatus)
                    <option value="{{ $studentStatus['value'] }}">{{ $studentStatus['label'] }}</option>
                    @endforeach
                </x-select>
            </div>

            @if($students->isNotEmpty())
                <x-table.table :rounded="false">
                    <thead>
                        <tr>
                            <x-table.thead>Name</x-table.thead>
                            <x-table.thead>Gender</x-table.thead>
                            {{-- <x-table.thead>Affiliated Board</x-table.thead> --}}
                            <x-table.thead>Grade (Section)</x-table.thead>
                            <x-table.thead>Status</x-table.thead>
                            <x-table.thead>Actions</x-table.thead>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($students as $student)
                            <tr>
                                <x-table.tdata>
                                    <div class="flex">
                                        <div class="shrink-0 mr-3">
                                            <img src="{{ $student->photo_url }}" alt="student-photo" class="rounded" width="50px">
                                        </div>
                                        <div>
                                            <div class="font-semibold text-slate-700">{{ $student?->user?->name }}</div>
                                            <div class="text-slate-600 text-sm">{{ $student?->student_code }}</div>
                                            {{-- <div class="flex space-x-1 text-sm">
                                                <div class="text-slate-600">{{ $student->user->phone }}</div>
                                                <div class="text-slate-300">/</div>
                                                <div class="text-slate-600">{{ $student->user->email }}</div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </x-table.tdata>
                                <x-table.tdata>
                                    {{ $student?->user?->gender }}
                                </x-table.tdata>
                                {{-- <x-table.tdata>
                                    {{ $student?->user?->school->affiliated_board }}
                                </x-table.tdata> --}}
                                <x-table.tdata>
                                    {{ $student?->class?->class_grade }} @if($student->section)({{ $student->section }})@endif
                                </x-table.tdata>
                                <x-table.tdata>
                                    <x-badge variant="{{ $student->status_color }}">{{ $student->status }}</x-badge>
                                </x-table.tdata>
                                <x-table.tdata>
                                    <div class="flex space-x-1">
                                        <x-button-icon-show href="{{ route('students.show', $student->id) }}" />
                                        <x-button-icon-edit href="{{ route('students.edit', $student->id) }}" />
                                        <x-button-icon href="{{ route('students.attendances', $student->id) }}" class="text-slate-400" x-data="{ tooltip: 'View attendance' }" x-tooltip="tooltip" x-cloak>
                                            <x-icon-calendar class="w-5 h-5" />
                                        </x-button-icon>
                                    </div>
                                </x-table.tdata>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table.table>
            @else 
                <x-card-empty class="shadow-none" />
            @endif
        </x-card>

        <div class="mt-5">{{ $students->links() }}</div>
    </x-section-centered>
</div>