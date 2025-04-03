<div>
    <x-slot name="title">Post Jal Shala Data</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('jalshalas.show', $jalshalaId) }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Post Jal Shala Data
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card form-action="save">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <x-input-number label="No. of Boys" name="numberOfBoys" wire:model.defer="numberOfBoys" />
                <x-input-number label="No. of Girls" name="numberOfGirls" wire:model.defer="numberOfGirls" />
                <x-input-number label="No. of Others" name="numberOfOthers" wire:model.defer="numberOfOthers" />
                 
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-filepond label="Upload Day 1 Image" name="dayOneImage" wire:model.defer="dayOneImage" />
                <x-filepond label="Upload Day 2 Image" name="dayTwoImage" wire:model.defer="dayTwoImage" />
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