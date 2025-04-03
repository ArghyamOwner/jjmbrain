<div>
    <x-slot name="title">Create Teacher</x-slot>
 
    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('teachers') }}">Back to teachers</x-text-link>
            </x-slot>

            <x-slot:title>
                Create new teacher
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card overflow-hidden form-action="save">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">Teacher Details</x-slot>
                <x-slot name="description">Add the necessary details of a teacher.</x-slot>

                <x-input label="Name" name="name" wire:model.defer="name" />
                <x-input label="Email" type="email" name="email" wire:model.defer="email" />
        
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-radio-pill 
                            class="!grid !grid-cols-3"
                            label="Gender" 
                            name="gender" 
                            wire:model.defer="genderType"
                            :default-value="$genderType"
                            :options="[
                                ['label' => 'Male', 'value' => 'male'],
                                ['label' => 'Female', 'value' => 'female'],
                            ]" 
                        />
                    </div>
            
                    <x-input-number maxlength="10" minlength="10" input-mode="numeric" label="Phone" name="phone" wire:model.defer="phone" placeholder="eg. 7896XXXXXX" />
                </div>
        
                {{-- <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input label="Designation" name="designation" wire:model.defer="designation" />
                </div> --}}
        
                <x-input label="Qualification" name="qualification" wire:model.defer="qualification" />
        
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <x-radio-pill 
                            class="!grid !grid-cols-2"
                            label="Employment Type" 
                            name="employmentType" 
                            wire:model.defer="employmentType"
                            :default-value="$employmentType"
                            :options="[
                                ['label' => 'Contractual', 'value' => 'contractual'],
                                ['label' => 'Permanent', 'value' => 'permanent'],
                            ]" 
                        />
                    </div>
                    <x-flatpicker label="Date of Birth" name="dob" wire:model.defer="dob" />
                </div>
        
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input label="Teacher ID" name="teacherId" wire:model.defer="teacherId" />
                    <x-input label="School Code" name="schoolCode" wire:model.defer="schoolCode" />
                </div>
            </x-card-form>

            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save,photo">Save</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>