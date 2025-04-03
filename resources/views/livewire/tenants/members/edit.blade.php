<div>
    <x-slot name="title">Edit Member</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('tenant.members.all') }}">Back to members</x-text-link>
            </x-slot>

            <x-slot:title>
                Edit Member
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card form-action="save">
            <x-card-form no-padding :with-shadow="false">
                <x-slot name="title">Edit member details</x-slot>
                <x-slot name="description"></x-slot>

                <x-label for="logo" class="mb-1">Photo</x-label>
                <x-text-hint class="mb-1">Maximum file size: 1 MB. Allowed file types: JPG, PNG</x-text-hint>
                <div class="flex space-x-4">
                    <div class="rounded-lg p-1 w-20 border bg-slate-100 overflow-hidden flex items-center justify-center" style="height: 76px">
                        @if ($photoUrl)
                            <img src="{{ $photoUrl }}" alt="logo" loading="lazy" class="object-fit h-16 rounded-lg w-auto" />
                        @else
                            <x-icon-gallery class="w-12 h-12 mt-4 mx-auto text-slate-200" />
                        @endif
                    </div>

                    <div class="flex-1">
                        <x-filepond
                            name="photo"
                            wire:model.defer="photo"
                        />
                    </div>
                </div>

                <x-select label="Member Type" name="memberType" wire:model.defer="memberType">
                    @if (count($this->memberTypes))
                        @foreach($this->memberTypes as $memberType)
                            <option value="{{ $memberType->value }}">{{ $memberType->name }}</option>
                        @endforeach
                    @endif
                </x-select>

                <x-select label="Designation" name="designation" wire:model.defer="designation">
                    @if (count($this->designationTypes))
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
                <x-button with-spinner wire:target="save,photo">Update</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>
