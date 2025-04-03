<div>
    <x-slot name="title">Add Member</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('members') }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Add Member
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card form-action="save">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <x-input label="Name of Member" name="member_name" wire:model.defer="member_name" />

                <x-input-number label="Phone Number" name="member_phone" wire:model.defer="member_phone" />

                <x-select label="Designation" name="designation" wire:model.defer="designation">
                    <option value="">--Select a designation--</option>
                    @foreach ($this->designations as $designationKey => $designationValue)
                        <option value="{{ $designationKey }}">{{ $designationValue }}</option>
                    @endforeach
                </x-select>

                <x-input label="Department Name" name="department" wire:model.defer="department" />        
            </div>

            <x-slot name="footer" class="text-right">
                <div class="mr-4">
                    <x-inline-toastr on="saved">Saved.</x-inline-toastr>
                </div>

                <x-button with-spinner wire:target="save">Save</x-button>
            </x-slot>
        </x-card>

    </x-section-centered>
</div>
