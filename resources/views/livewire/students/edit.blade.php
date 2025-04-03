<div>
    <x-slot name="title">Edit Student</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('students') }}">Back to students</x-text-link>
            </x-slot>

            <x-slot:title>
                Edit Student
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Student Details</x-slot>
                <x-slot name="description">Add name, grade, section of the student</x-slot>

                <div class="mb-5">
                    <x-label for="photo" class="mb-1">Student Photo</x-label>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="w-24 h-24 rounded bg-slate-50 overflow-hidden">
                            <img src="{{ $studentPhoto }}" alt="student-photo" class="rounded w-24 h-24 object-fit">
                        </div>

                        <div class="md:col-span-3">
                            <x-filepond
                                name="photo"
                                wire:model="photo"
                            />
                        </div>
                    </div>
                </div>
                
                <x-input label="Student Name" name="name" wire:model.defer="name" />
                 
                <x-radio-pill 
                    label="Gender" 
                    name="gender" 
                    wire:model.defer="gender"
                    default-value="{{ $gender }}"
                    :options="[
                        ['label' => 'Male', 'value' => 'male'],
                        ['label' => 'Female', 'value' => 'female'],
                    ]" 
                />
                
                <x-input label="Phone" name="phone" wire:model.defer="phone" />
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-select label="Grade" name="grade" wire:model.defer="grade">
                        <option value="">--Select Grade--</option>
                        @foreach($this->classes as $classKey => $classValue)
                            <option value="{{ $classKey }}">{{ $classValue }}</option>
                        @endforeach
                    </x-select>
                    <x-select label="Section" name="section" wire:model.defer="section">
                        <option value="">--Select Section--</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                    </x-select>
                </div>

                <x-input label="Student Code" name="student_code" wire:model.defer="student_code" />
                <x-flatpicker label="Date of Birth" name="dob" wire:model.defer="dob" />

                <x-radio-pill 
                    class="!grid-cols-3"
                    label="Status" 
                    name="status" 
                    wire:model.defer="status"
                    :default-value="$status"
                    :options="$this->studentStatuses" 
                />
            </x-card-form>

            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>