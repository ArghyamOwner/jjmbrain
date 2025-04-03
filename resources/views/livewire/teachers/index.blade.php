<div>
    <x-slot name="title">All Teachers</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Teachers
            </x-slot>

            <x-slot name="action">
                <x-button tag="a" href="{{ route('teachers.create') }}" with-icon icon="add" with-spinner>New Teacher</x-button>    
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>

        <div class="mb-5">
            <livewire:teachers.stats />
        </div>
     
        @if($teachers->isNotEmpty())
            <div class="mb-5 grid grid-cols-1 md:grid-cols-6 gap-x-4">
                <div class="md:col-span-4">
                    <x-input-search no-margin name="search" wire:model.debounce.500ms="search" placeholder="Search..." />
                </div>
                <x-select no-margin name="gender" wire:model="gender">
                    <option value="all">--Select Gender--</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </x-select>
                <x-select no-margin name="category" wire:model="category">
                    <option value="all">--Select Type--</option>
                    <option value="contractual">Contractual</option>
                    <option value="permanent">Permanent</option>
                </x-select>
            </div>

            <div class="mb-8 space-y-6">
                @foreach($teachers as $teacher)
                    <x-card>
                        <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                            <div>
                                <div class="w-48 h-48 rounded bg-slate-50 overflow-hidden mr-5">
                                    <img src="{{ $teacher->photo_url }}" alt="teacher-photo" class="rounded w-48 h-48 object-fit">
                                </div>
                            </div>
                            <div class="md:col-span-4">
                                <div class="flex space-x-2 items-center mb-2">
                                    <x-heading size="xl">{{ $teacher->name }}</x-heading>
                                    <x-button-icon-edit href="#" />
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                                    <x-description-list size="xs">
                                        <x-description-list.item>
                                            <x-slot name="title">Designation</x-slot>
                                            <x-slot name="description">{{ $teacher->designation }}</x-slot>
                                        </x-description-list.item>
                                        <x-description-list.item>
                                            <x-slot name="title">Email</x-slot>
                                            <x-slot name="description">{{ $teacher->email }}</x-slot>
                                        </x-description-list.item>
                                        <x-description-list.item>
                                            <x-slot name="title">Phone</x-slot>
                                            <x-slot name="description">{{ $teacher->phone }}</x-slot>
                                        </x-description-list.item>
                                        <x-description-list.item>
                                            <x-slot name="title">Gender</x-slot>
                                            <x-slot name="description">{{ $teacher->gender }}</x-slot>
                                        </x-description-list.item>
                                        <x-description-list.item>
                                            <x-slot name="title">Date of Birth</x-slot>
                                            <x-slot name="description">@date($teacher->dob)</x-slot>
                                        </x-description-list.item>
                                    </x-description-list>
                                    <x-description-list size="xs">
                                        <x-description-list.item>
                                            <x-slot name="title">Qualification</x-slot>
                                            <x-slot name="description">{{ $teacher->qualification }}</x-slot>
                                        </x-description-list.item>
                                        <x-description-list.item>
                                            <x-slot name="title">Teacher ID</x-slot>
                                            <x-slot name="description">{{ $teacher->teacher_or_employee_id }}</x-slot>
                                        </x-description-list.item>
                                        <x-description-list.item>
                                            <x-slot name="title">School Code</x-slot>
                                            <x-slot name="description">{{ $teacher->school_code }}</x-slot>
                                        </x-description-list.item>
                                        <x-description-list.item>
                                            <x-slot name="title">Employment Type</x-slot>
                                            <x-slot name="description">{{ $teacher->employment_type }}</x-slot>
                                        </x-description-list.item>
                                    </x-description-list>
                                </div>
                            </div>
                        </div>
                    </x-card>
                @endforeach
            </div>
        @else 
            <x-card-empty class="shadow-none" />
        @endif
        
    </x-section-centered>
</div>