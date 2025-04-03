<div>
    <x-slot name="title">New Member</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('tenant.members.all') }}">Back to members</x-text-link>
            </x-slot>

            <x-slot:title>
                New Member
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card form-action="save">
            <x-card-form no-padding :with-shadow="false">
                <x-slot name="title">Create new member</x-slot>
                <x-slot name="description"></x-slot>

                <x-label for="logo" class="mb-1">Photo</x-label>
                <x-text-hint class="mb-1">Maximum file size: 1 MB. Allowed file types: JPG, PNG</x-text-hint>
                <x-filepond
                    name="photo"
                    wire:model.defer="photo"
                />

                <x-select label="Member Type" name="memberType" wire:model.defer="memberType">
                    @if (count($this->memberTypes))
                        <option value="">Select a member type</option>
                        @foreach($this->memberTypes as $memberType)
                            <option value="{{ $memberType->value }}">{{ $memberType->name }}</option>
                        @endforeach
                    @endif
                </x-select>

                <x-select label="Designation" name="designation" wire:model.defer="designation">
                    @if (count($this->designationTypes))
                        <option value="">Select a designation</option>
                        @foreach($this->designationTypes as $designationType)
                            <option value="{{ $designationType->value }}">{{ $designationType->name }}</option>
                        @endforeach
                    @endif
                </x-select>

                <x-input 
                    label="Name"
                    name="name"
                    wire:model.defer="name"
                />

                <x-input-number 
                    label="Phone"
                    name="phone"
                    wire:model.defer="phone"
                    input-mode="numeric"
                    maxlength="10"
                    minlength="10"
                />

                <x-input 
                    optional
                    label="Work Details"
                    name="workDetails"
                    wire:model.defer="workDetails"
                />

                <x-input 
                    optional
                    label="Ward Number"
                    name="wardNumber"
                    wire:model.defer="wardNumber"
                />
            </x-card-form>

            <x-slot name="footer" class="text-right">
                <x-button with-spinner wire:target="save,photo">Create Member</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>
