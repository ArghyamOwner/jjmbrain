<div>
    <x-slot name="title">Update Consumer Details</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('schemes.show', $schemeId) }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Upadte Consumer Details
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card-form form-action="update">
            <x-slot name="title">Update APDCL Consumer Details</x-slot>
            <x-slot name="description">Add the necessary details.</x-slot>

            <x-input type="text" label="Consumer Number" name="consumer_no" wire:model.defer="consumer_no" />

            @if($updateBill)
            <x-filepond accept-files="application/pdf" label="Upload APDCL Bill" name="consumer_bill"
                wire:model.defer="consumer_bill" />
            @endif


            <x-slot name="footer" class="text-right">
                <div class="mr-4">
                    <x-inline-toastr on="updated">Updated.</x-inline-toastr>
                </div>

                <x-button with-spinner wire:target="update">Update</x-button>
            </x-slot>
        </x-card-form>

    </x-section-centered>
</div>