<div>
    <x-slot name="title">Post Jal Adda Data</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('jaladdas.show', $jaladdaId) }}">Go Back</x-text-link>
            </x-slot>

            <x-slot:title>
                Post Jal Adda Data
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <x-card form-action="save">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-filepond label="Upload Image 1" name="oneImage" wire:model.defer="oneImage" />
                <x-filepond label="Upload Image 2" name="twoImage" wire:model.defer="twoImage" />
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