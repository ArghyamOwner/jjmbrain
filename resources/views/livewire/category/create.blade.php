<div>
    <x-slot name="title">Create Category</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('categories') }}">Go Back</x-text-link>
    </x-slot>

    <x-slot:title>
        Create Category
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card overflow-hidden form-action="save">

                <x-textarea-simple label="Title" name="name" wire:model.defer="name" />

                <x-slot name="footer" class="text-right">
                    <x-button with-spinner wire:target="save">Save</x-button>
                </x-slot>
            </x-card>
        </x-section-centered>
</div>
