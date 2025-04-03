<div>
    <x-slideovers wire:model="show">
        <x-slot name="header">Edit Student</x-slot>
        
        <div class="py-3 px-6">
            <form wire:submit.prevent="save">
                <x-input 
                    label="Name of the student"
                    name="student_name"
                    wire:model.defer="student_name"
                />

                <x-input 
                    label="Jaldoot UIN"
                    name="jaldoot_uin"
                    wire:model.defer="jaldoot_uin"
                />
        
                <x-select
                    label="Gender"
                    name="gender"
                    wire:model.defer="gender"
                >
                    <option value="">Select an option</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </x-select>

                <x-select
                    label="Class"
                    name="class"
                    wire:model.defer="class"
                >
                    <option value="">Select an option</option>
                    @foreach(range(8,12) as $row)
                    <option value="{{ $row }}">{{ $row }}</option>
                    @endforeach
                </x-select>

                <x-select
                    label="Age"
                    name="age"
                    wire:model.defer="age"
                >
                    <option value="">Select an option</option>
                        @foreach(range(10,20) as $row)
                    <option value="{{ $row }}">{{ $row }}</option>
                    @endforeach
                </x-select>
 
                <x-input-number
                    hint="Enter phone number having whatsapp"
                    label="Phone Number"
                    name="student_phone"
                    wire:model.defer="student_phone"
                />
 
                <div class="flex justify-end space-x-2 items-center">
                    <x-button type="button" with-spinner wire:click="close" wire:target="close" color="white">Cancel</x-button>
                    <x-button with-spinner wire:target="save">Update</x-button>
                </div>
            </form>
        </div>
    </x-slideovers>    
</div>