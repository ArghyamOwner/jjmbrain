<div>
    <x-slot name="title">Edit ISA</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('isa', $isa->id) }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Edit ISA Details
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card form-action="update">
            <x-card-form :with-shadow="false" no-padding>
                <x-slot name="title">ISA Details</x-slot>
                <x-slot name="description">Add the necessary details of the ISA.</x-slot>

                <x-input label="ISA Name" name="name" wire:model.defer="name" />
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                    <x-input label="Contact Name" name="contact_name" wire:model.defer="contact_name" />

                    <x-input-number maxlength="10" minlength="10" input-mode="numeric" label="Phone"
                        name="contact_phone" wire:model.defer="contact_phone" placeholder="eg. 7896XXXXXX" />
                </div>
            </x-card-form>

            <x-slot name="footer" class="text-right">
                <div class="mr-4">
                    <x-inline-toastr on="updated">Updated.</x-inline-toastr>
                </div>

                <x-button with-spinner wire:target="update">Update</x-button>
            </x-slot>
        </x-card>
    </x-section-centered>
</div>
